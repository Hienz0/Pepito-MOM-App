<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notulen;
use App\Models\NotulenTask;
use App\Models\User;
use App\Models\Guest;
use App\Models\TaskLog;
use App\Models\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotulenAdded;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskNotification;
use App\Mail\GuestNotification;
use App\Mail\MoMDetailsMail;
use App\Mail\MomInactivatedMail;
use Carbon\Carbon;

use Exception;

class NotulenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notulens = Notulen::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('participants', 'tasks.user')
            ->orderBy('created_at', 'desc') // Order by created_at in descending order
            ->get();

        return view('notulens.index', compact('notulens'));
    }

    public function create()
    {
        $users = User::all();
        $scripter = Auth::user();
        return view('notulens.create', compact('users', 'scripter'));
    }

    public function store(Request $request)
    {
        Log::info('Store method called', ['request_data' => $request->all()]);


        $request->validate([
            'meeting_title' => 'required|string',
            'department' => 'required|array|min:1',
            'department.*' => 'string', // Validate each department as a string
            'meeting_date' => 'required|date',
            'meeting_time' => 'required|date_format:H:i',
            'meeting_location' => 'required|string',
            'participants' => 'required|array|min:1',
            'agenda' => 'required|string',
            'discussion' => 'required|string',
            'decisions' => 'nullable|string',
            'tasks' => 'nullable|string',
            'guests' => 'nullable|string', // Validate guests as a JSON string
        ]);

        try {

            $user = Auth::user();

            $notulen = Notulen::create([
                'meeting_title' => $request->meeting_title,
                'meeting_date' => $request->meeting_date,
                'department' => json_encode($request->department), // Store as JSON
                'meeting_time' => $request->meeting_time,
                'meeting_location' => $request->meeting_location,
                'agenda' => $request->agenda,
                'discussion' => $request->discussion,
                'decisions' => $request->decisions,
                'scripter_id' => $user->id,
                'status' => $request['status'] ?? 'Open',
            ]);

            $participants = json_decode($request->participants[0], true);
            $notulen->participants()->attach($participants);

            Log::info('Notulen created, attaching tasks', ['notulen_id' => $notulen->id]);

            // Initialize attachment paths
            // Initialize attachment paths with indices
            $attachmentPaths = [];

            if ($request->hasFile('attachments')) {
                Log::info('Attachments found in request.');
                foreach ($request->file('attachments') as $index => $file) {
                    if ($file->isValid()) {
                        try {
                            $path = $file->store('attachments', 'public');
                            $attachmentPaths[$index] = $path; // Use index for correct mapping
                            Log::info('Attachment uploaded successfully', ['path' => $path]);
                        } catch (\Exception $e) {
                            Log::error('Failed to upload attachment', ['error' => $e->getMessage()]);
                        }
                    } else {
                        Log::info('Attachment is not valid', ['file' => $file->getClientOriginalName()]);
                    }
                }
            } else {
                Log::info('No attachments found in request');
            }

            $guestIds = [];
            // Log if guests field is present or not
            if ($request->filled('guests')) {
                Log::info('Guests field is present', ['guests_raw' => $request->guests]);

                $guests = json_decode($request->guests, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    Log::error('Invalid JSON in guests field', ['guests_data' => $request->guests]);
                    throw new \Exception('Invalid JSON in guests field');
                }

                Log::info('Processing guests', ['guests' => $guests]);

                foreach ($guests as $guest) {
                    $createdGuest = Guest::create([
                        'notulen_id' => $notulen->id,
                        'name' => $guest['name'],
                        'email' => $guest['email'],
                    ]);
                    // Store guest details in an associative array
                    $guestIds[$guest['email']] = [
                        'id' => $createdGuest->id,
                        'name' => $guest['name'],
                        'email' => $guest['email'],
                    ];
                    // Add guest email to send later
                    $emailsToSend[] = [
                        'recipient' => $guest['email'],
                        'mail_class' => new GuestNotification($notulen),
                    ];
                }
            } else {
                Log::info('Guests field is not present');
            }

            if ($request->filled('tasks')) {
                $tasks = json_decode($request->tasks, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON in tasks field');
                }

                foreach ($tasks as $index => $task) {
                    // Separate PICs and Guests
                    $taskPics = array_filter($task['task_pics'], function ($pic) {
                        return strpos($pic['name'], '(PIC)') !== false;
                    });

                    $taskGuestPics = array_filter($task['task_pics'], function ($pic) {
                        return strpos($pic['name'], '(Guest)') !== false;
                    });


                    Log::info('Filtered task PICs', ['taskPics' => $taskPics]);
                    Log::info('Filtered task guest PICs', ['taskGuestPics' => $taskGuestPics]);

                    // Store only IDs
                    $taskPicIds = array_column($taskPics, 'id');
                    Log::info('Task PIC IDs', ['taskPicIds' => $taskPicIds]);
                    $taskGuestPicIds = array_map(function ($guestPic) use ($guestIds) {
                        $email = $guestPic['id'];
                        $guest = $guestIds[$email] ?? null;
                        return $guest ? (string)$guest['id'] : null; // Ensure IDs are stored as strings
                    }, $taskGuestPics);

                    // Filter out null values
                    $taskGuestPicIds = array_filter($taskGuestPicIds);

                    // Ensure the IDs are stored as an indexed array
                    $taskGuestPicIds = array_values($taskGuestPicIds);

                    Log::info('Filtered task guest PIC IDs', ['taskGuestPicIds' => $taskGuestPicIds]);


                    $taskAttachmentPath = $attachmentPaths[$index] ?? null; // Assign attachment path based on index

                    $taskGuestPics = array_map(function ($guestPic) use ($guestIds) {
                        // Assuming guestPic['id'] refers to the ID to be found in the $guestIds array
                        return in_array($guestPic['id'], $guestIds) ? $guestPic['id'] : null;
                    }, $task['guest_pics'] ?? []);


                    $createdTask = $notulen->tasks()->create([
                        'task_topic' => $task['task_topic'],
                        'task_pic' => json_encode($taskPicIds),
                        'guest_pic' => json_encode($taskGuestPicIds),
                        'task_due_date' => $task['task_due_date'],
                        'status' => $task['task_status'] ?? 'Pending',
                        'completion' => $task['task_completion'] ?? '0%',
                        'description' => $task['task_description'] ?? null,
                        'attachment' => $taskAttachmentPath, // Can be null if no attachment
                    ]);

                    // Send email to each PIC in the task
                    foreach ($task['task_pics'] as $taskPic) {
                        $pic = User::find($taskPic['id']);
                        if ($pic) {
                            // Create a notification for the PIC
                            Notification::create([
                                'user_id' => $pic->id,
                                'notification_topic' => 'New Task Assigned', // Use the correct column name
                                'notification_message' => 'You have been assigned to the task "' . $createdTask->task_name . '" in "' . $notulen->meeting_title . '" MoM.',
                                'read_status' => false,
                                'task_id' => $createdTask->id, // Assuming you have a task_id column in the notifications table
                                'notulen_id' => $notulen->id,
                            ]);
                            $emailsToSend[] = [
                                'recipient' => $pic->email,
                                'mail_class' => new TaskNotification($notulen, $createdTask),
                            ];
                        }
                    }

                    // Send email to each guest PIC
                    foreach ($taskGuestPics as $guestPicId) {
                        $guest = Guest::find($guestPicId);
                        if ($guest) {
                            $emailsToSend[] = [
                                'recipient' => $guest->email,
                                'mail_class' => new TaskNotification($notulen, $createdTask),
                            ];
                        }
                    }
                }
            }


            Log::info('Tasks attached successfully', ['tasks' => $tasks ?? 'No tasks']);



            // Send email to participants
            foreach ($participants as $participantId) {
                $participant = User::find($participantId);
                Notification::create([
                    'user_id' => $participant->id,
                    'notification_topic' => 'New MoM Added', // Use the correct column name
                    'notification_message' => 'You have been added to "' . $notulen->meeting_title . '" MoM.',
                    'read_status' => false,
                    'notulen_id' => $notulen->id,
                ]);

                $emailsToSend[] = [
                    'recipient' => $participant->email,
                    'mail_class' => new NotulenAdded($notulen),
                ];
            }
        } catch (\Exception $e) {
            Log::error('Error creating notulen', ['exception' => $e->getMessage(), 'request_data' => $request->all()]);
            return redirect()->route('notulens.create')->with('error', 'Failed to create notulen.');
        }

            // Send all the emails at the end
    foreach ($emailsToSend as $email) {
        Mail::to($email['recipient'])->send($email['mail_class']);
    }

        return redirect()->route('notulens.index')->with('success', 'Notulen created successfully.');
    }

    public function show($id)
    {
        $notulen = Notulen::with('participants', 'tasks.user', 'guests')->findOrFail($id);
        $user = Auth::user();
        $userTasks = $notulen->tasks->filter(function ($task) use ($user) {
            return in_array($user->id, json_decode($task->task_pic, true));
        });

        // Fetch guest PICs for each task
        foreach ($notulen->tasks as $task) {
            $guestPicIds = json_decode($task->guest_pic, true);
            $task->guestPicNames = Guest::whereIn('id', $guestPicIds)->pluck('name')->toArray();
        }

        return view('notulens.show', compact('notulen', 'userTasks'));
    }


    // edit and update notulen

    public function edit($id)
    {
        Log::info('Edit method called for Notulen', ['id' => $id, 'user_id' => Auth::id()]);

        $notulen = Notulen::with('participants', 'tasks', 'guests')->findOrFail($id);

        // Ensure the authenticated user is the scripter
        if (Auth::user()->id != $notulen->scripter_id) {
            Log::warning('Unauthorized access attempt', ['notulen_id' => $id, 'user_id' => Auth::id()]);
            return redirect()->route('notulens.index')->with('error', 'You do not have permission to edit this notulen.');
        }

        $users = User::all(); // To populate participant and task PIC select options

        Log::info('Notulen data loaded for editing', ['notulen_id' => $id, 'participants' => $notulen->participants->pluck('id'), 'tasks' => $notulen->tasks->pluck('id'), 'guests' => $notulen->guests->pluck('id')]);

        return view('notulens.edit', compact('notulen', 'users'));
    }

    public function update(Request $request, $id)
    {

        // Fix the meeting_time format if needed
        // Get the current meeting_time from the request
        $meeting_time = $request->input('meeting_time');

        // Check if meeting_time does not have seconds part
        if (strpos($meeting_time, ':') !== false && substr_count($meeting_time, ':') == 1) {
            $meeting_time .= ':00';
        }

        // Log information for debugging
        Log::info('Update method called for Notulen', [
            'id' => $id,
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        // Merge the modified meeting_time back into the request
        $request->merge(['meeting_time' => $meeting_time]);


        Log::info('Update method called for Notulen', ['id' => $id, 'user_id' => Auth::id(), 'request_data' => $request->all()]);
        Log::info('Tasks data received', ['tasks' => $request->input('tasks')]);

        Log::info('Meeting time value', ['meeting_time' => $request->input('meeting_time')]);



        $notulen = Notulen::findOrFail($id);

        // Ensure the authenticated user is the scripter
        if (Auth::user()->id != $notulen->scripter_id) {
            Log::warning('Unauthorized update attempt', ['notulen_id' => $id, 'user_id' => Auth::id()]);
            return redirect()->route('notulens.index')->with('error', 'You do not have permission to update this notulen.');
        }
        Log::info('Participants data before validation', ['participants' => $request->input('participants')]);

        Log::info('Guests data before validation', ['guests' => $request->input('guests')]);


        try {
            // Validate the request data
            $validatedData = $request->validate([
                'meeting_title' => 'required|string|max:255',
                'department' => 'required|array',
                'department.*' => 'string', // Validate each department as a string
                'meeting_date' => 'required|date',
                'meeting_time' => 'required|date_format:H:i:s',
                'meeting_location' => 'required|string',
                'agenda' => 'required|string',
                'discussion' => 'nullable|string',
                'decisions' => 'nullable|string',
                'tasks' => 'nullable|array',
                'tasks.*.task_id' => 'nullable|integer', // Validate task_id
                'tasks.*.task_topic' => 'required_with:tasks|string',
                'tasks.*.task_due_date' => 'required_with:tasks|date',
                'tasks.*.task_pic' => 'nullable|array',
                'tasks.*.task_pic.*' => ['nullable', function ($attribute, $value, $fail) {
                    // Validate that the value is either an integer or a string starting with 'g_'
                    if (!is_numeric($value) && strpos($value, 'g_') !== 0) {
                        $fail('The ' . $attribute . ' must be a valid participant or guest ID.');
                    }
                }],
                'tasks.*.description' => 'nullable|string',
                'tasks.*.attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx', // Size limit removed
                'tasks.*.task_completion' => 'nullable|string',
                // Add validation for the completion field
                'guests' => 'nullable|array',
                'guests.*.name' => 'required|string',
                'guests.*.email' => 'required|email',
                'status' => 'nullable|string',
            ]);
            // Handle the department array and convert it to JSON
            $validatedData['department'] = json_encode($request->department);
            Log::info('Validated data for update', ['validated_data' => $validatedData]);

            // Update the notulen
            $notulen->update($validatedData);

            // Update participants
            if ($request->has('participants')) {
                $participants = $request->input('participants');
                Log::info('Updating participants', ['participants' => $participants]);
                $notulen->participants()->sync($participants);
            }

            // Update guests
            if ($request->has('guests')) {
                $guests = $validatedData['guests'];

                foreach ($guests as $guestData) {
                    // Check if a guest with the same email exists in the current notulen
                    $existingGuest = $notulen->guests()->where('email', $guestData['email'])->first();

                    if (!$existingGuest) {
                        // Create a new guest if no existing guest found for this notulen
                        Guest::create([
                            'notulen_id' => $notulen->id,
                            'name' => $guestData['name'],
                            'email' => $guestData['email'],
                        ]);
                    } else {
                        // Optionally, update guest information here if necessary
                    }
                }
            }

            // Update tasks
            if ($request->has('tasks')) {
                // $tasks = $request->input('tasks');
                $tasks = $validatedData['tasks']; // Use validated data for tasks
                Log::info('Tasks data received', ['tasks' => $tasks]);

                $requestTaskIds = array_filter(array_column($tasks, 'task_id'));
                Log::info('Extracted task IDs from request', ['requestTaskIds' => $requestTaskIds]);

                // Find tasks that are no longer in the request and delete them
                $tasksToDelete = $notulen->tasks()->whereNotIn('id', $requestTaskIds)->get();
                Log::info('Tasks to be deleted', ['task_ids' => $tasksToDelete->pluck('id')]);

                foreach ($tasksToDelete as $taskToDelete) {
                    $taskToDelete->delete();
                }

                // Clear existing tasks
                // $notulen->tasks()->delete();

                foreach ($tasks as $task) {
                    Log::info('Task completion values:', ['completion' => $request->input('tasks.*.task_completion')]);

                    $taskPics = [];
                    $guestPics = [];

                    // Separate task_pic into taskPics and guestPics
                    // Separate task_pic into taskPics and guestPics
                    foreach ($task['task_pic'] as $picId) {
                        Log::info('Processing picId', ['picId' => $picId]);

                        if (strpos($picId, 'g_') === 0) {
                            // This is a guest ID or email
                            $guestId = substr($picId, 2); // Remove the 'g_' prefix

                            if (is_numeric($guestId)) {
                                // It's a numeric ID
                                $guestPics[] = $guestId;
                            } else {
                                // Handle email or invalid guestId
                                Log::info('Guest ID is not numeric, checking current notulen', ['guestId' => $guestId]);

                                $guest = $notulen->guests()->where('email', $guestId)->first();

                                if ($guest) {
                                    // Replace email with guest's actual ID
                                    $guestPics[] = $guest->id;
                                    Log::info('Guest found and ID added', ['guestId' => $guestId, 'guestIdInDb' => $guest->id]);
                                } else {
                                    // If no guest is found, log the case
                                    Log::warning('Guest with email not found in notulen', ['email' => $guestId]);
                                    $guestPics[] = $guestId; // Keep email if guest not found
                                }
                            }
                        } else {
                            // This is a user ID
                            $taskPics[] = $picId;
                        }
                    }

                    // After the loop, ensure both taskPics and guestPics are converted to arrays
                    $task['task_pic'] = json_encode($taskPics);
                    $task['guest_pic'] = json_encode($guestPics);

                    $attachmentPath = null;

                    // Find existing task by topic or create a new one
                    $existingTask = $notulen->tasks()->where('id', $task['task_id'])->first();

                    if (isset($task['attachment']) && $task['attachment'] instanceof \Illuminate\Http\UploadedFile) {
                        $attachmentPath = $task['attachment']->store('attachments', 'public');
                        Log::info('New file uploaded, storing attachment', ['attachment_path' => $attachmentPath]);
                    } elseif ($existingTask) {
                        $attachmentPath = $existingTask->attachment;
                        Log::info('No new file uploaded, using existing attachment', ['existing_attachment' => $attachmentPath]);
                    }

                    // Determine the task status based on the completion percentage
                    $completion = $task['task_completion'] ?? '0%';
                    $status = 'Pending'; // Default to Pending

                    // Update the status based on the completion percentage
                    if ($completion === '100%') {
                        $status = 'Complete';
                    } elseif ($completion !== '0%') {
                        $status = 'In Progress';
                    }


                    // Prepare data for task creation
                    $taskData = [
                        'task_topic' => $task['task_topic'],
                        'task_pic' => json_encode($taskPics),
                        'guest_pic' => json_encode($guestPics), // Store guest IDs separately
                        'task_due_date' => $task['task_due_date'],
                        'completion' => $task['task_completion'] ?? '0%', // Save completion percentage
                        'status' => $task['task_completion'] === '100%' ? 'Complete' : ($task['task_completion'] !== '0%' ? 'In Progress' : 'Pending'),
                        'description' => $task['description'] ?? null,
                    ];

                    // Log attachment status
                    if ($attachmentPath) {
                        $taskData['attachment'] = $attachmentPath;
                        Log::info('Adding attachment to task', ['attachment' => $attachmentPath]);
                    } else {
                        Log::info('No attachment found, skipping attachment in task data');
                    }


                    // Log the final task data before creation
                    Log::info('Final task data before creation', $taskData);

                    // Update existing task or create new one
                    if ($existingTask) {
                        $existingTask->update($taskData);
                    } else {
                        $notulen->tasks()->create($taskData);
                    }
                }
            }



            Log::info('Notulen updated successfully', ['notulen_id' => $id]);

            return redirect()->route('notulens.index')->with('success', 'Notulen updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating notulen', ['exception' => $e->getMessage()]);
            return redirect()->route('notulens.edit', $id)->with('error', 'Failed to update notulen.');
        }
    }








    public function updateTask(Request $request, $id)
    {
        try {
            $task = NotulenTask::findOrFail($id);
            $task->description = $request->description;

            // Update task completion
            $completion = $request->input('completion', '0%'); // Default to '0%' if no completion is provided
            $task->completion = $completion;

            // Determine the task status based on the completion percentage
            if ($completion === '100%') {
                $task->status = 'Complete';
                Log::info('Task marked as complete', ['id' => $id]);
            } elseif ($completion === '0%') {
                $task->status = 'Pending';
                Log::info('Task marked as pending', ['id' => $id]);
            } else {
                $task->status = 'In Progress';
                Log::info('Task marked as in progress', ['id' => $id]);
            }
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                $task->attachment = $attachmentPath;
                Log::info('Attachment uploded', ['id' => $id, 'attachment path' => $attachmentPath]);
            }

            $task->save();

            try {
                $taskLog = TaskLog::create([
                    'task_id' => $task->id,
                    'update_description' => 'Task updated: ' . $request->description,
                    'updated_by' => auth()->id(),
                ]);
            } catch (\Exception $e) {
                Log::error('Failed to create task log', ['error' => $e->getMessage()]);
                return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
            }


            Log::info('Task updated successfully', ['id' => $id]);

            // Return a redirect response after saving the task
            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function getTaskLogs($id)
    {
        $logs = TaskLog::where('task_id', $id)
            ->with('user')
            ->orderBy('updated_at', 'desc') // Order by updated_at in descending order
            ->get()
            ->map(function ($log) {
                return [
                    'update_description' => $log->update_description,
                    'updated_at' => $log->updated_at->format('Y-m-d H:i:s'),
                    'user_name' => $log->user->name,
                ];
            });

        return response()->json(['logs' => $logs]);
    }




    public function distribute(Request $request, $id)
    {
        Log::info('Distribute method called', ['request_data' => $request->all()]);


        $notulen = Notulen::findOrFail($id); // Use route parameter `$id`
        $participants = $notulen->participants; // If `participants` is a relationship
        // Adjust according to how you manage participants
        $guests = $notulen->guests;

        $notulenUrl = route('notulens.show', ['id' => $notulen->id]); // Adjust route name as needed


        foreach ($participants as $participant) {
            Mail::to($participant->email)->send(new MoMDetailsMail($notulen, $notulenUrl));
        }
        foreach ($guests as $guest) {
            Mail::to($guest->email)->send(new MoMDetailsMail($notulen, $notulenUrl));
        }
        // Update the status of the notulen to 'Distributed'
        $notulen->status = 'Distributed';
        $notulen->save();

        return redirect()->back()->with('success', 'MoM details have been sent.');
    }

    public function inactivate(Request $request, $id)
    {
        $notulen = Notulen::findOrFail($id);
        $notulen->status = 'Inactive';
        $notulen->save();

        $meetingDetailsUrl = route('notulens.show', ['id' => $notulen->id]);

        // Get participants)
        $participants = $notulen->participants;

        foreach ($participants as $participant) {
            // Create a notification for the participant
            Notification::create([
                'user_id' => $participant->id,
                'notification_topic' => 'MoM Inactivated', // Use the correct column name
                'notification_message' => 'The MoM titled "' . $notulen->meeting_title . '" has been inactivated.',
                'read_status' => false,
                'notulen_id' => $notulen->id,
            ]);
            Mail::to($participant->email)->send(new MomInactivatedMail($notulen, $meetingDetailsUrl));
        }

        return redirect()->back()->with('success', 'MoM has been inactivated and participants have been notified.');
    }

    public function getNotifications()
    {
        $user = Auth::user();
        $now = Carbon::now();
        $oneDayAgo = $now->copy()->subDay();

        // Get all notifications for the logged-in user
        $notifications = Notification::where('user_id', $user->id)
            ->get()
            ->map(function ($notification) use ($now, $oneDayAgo) {
                // Determine if the notification should be highlighted
                $isHighlighted = !$notification->read_status;

                // Convert read_time to Carbon instance, if it's not null
                $readTime = $notification->read_time ? Carbon::parse($notification->read_time) : null;

                // Determine if the notification should be shown (if read, only show for one day)
                $shouldShow = !$notification->read_status || ($readTime && $readTime->greaterThan($oneDayAgo));

                $link = $notification->notulen_id ? route('notulens.show', $notification->notulen_id) : '#';
                $isHighlighted = !$notification->read_status;

                return [
                    'id' => $notification->id,
                    'notification_topic' => $notification->notification_topic,
                    'notification_message' => $notification->notification_message,
                    'isHighlighted' => $isHighlighted,
                    'shouldShow' => $shouldShow,
                    'read_time' => $notification->read_time, // For reference
                    'created_at' => $notification->created_at, // Required for sorting
                    'link' => $link,
                    'isHighlighted' => $isHighlighted,
                ];
            })
            ->filter(function ($notification) {
                // Fixing the key from 'should_show' to 'shouldShow'
                return $notification['shouldShow'];
            })
            ->sortByDesc('created_at') // Sort notifications by created_at in descending order
            ->values(); // Re-index the array

        // Count unread notifications
        $unreadCount = $notifications->where('isHighlighted', true)->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadCount,
        ]);
    }





    public function markAllAsRead()
    {
        $user = Auth::user();

        // Mark all unread notifications for the logged-in user as read
        Notification::where('user_id', $user->id)
            ->where('read_status', false)
            ->update([
                'read_status' => true,
                'read_time' => now(), // Set read_time
            ]);

        return response()->json(['status' => 'success']);
    }
}
