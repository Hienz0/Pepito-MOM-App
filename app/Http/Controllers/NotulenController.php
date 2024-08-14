<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notulen;
use App\Models\NotulenTask;
use App\Models\User; 
use App\Models\Guest; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Mail\NotulenAdded;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskNotification;
use App\Mail\GuestNotification;
use Exception;

class NotulenController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $notulens = Notulen::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->with('participants', 'tasks.user')->get();

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
            'decisions' => 'required|string',
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

            if ($request->filled('tasks')) {
                $tasks = json_decode($request->tasks, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON in tasks field');
                }
                
    
                foreach ($tasks as $task) {
                    $taskPics = array_map(function($taskPic) {
                        return $taskPic['id'];
                    }, $task['task_pics']);
                    // Initialize attachmentPath
                    $attachmentPath = null;

                    if ($request->hasFile('attachment')) {
                        Log::info('Attachment found in request.');
                        if ($request->file('attachment')->isValid()) {
                            try {
                                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                                Log::info('Attachment uploaded successfully', ['path' => $attachmentPath]);
                            } catch (\Exception $e) {
                                Log::error('Failed to upload attachment', ['error' => $e->getMessage()]);
                            }
                        } else {
                            Log::info('Attachment is not valid');
                        }
                    } else {
                        Log::info('No attachment found in request');
                    }
                                    
                     
    
                    // Create the task with task_pic as an array
                    $createdTask = $notulen->tasks()->create([
                        'task_topic' => $task['task_topic'],
                        'task_pic' => json_encode($taskPics),
                        'task_due_date' => $task['task_due_date'],
                        'status' => $task['task_status'] ?? 'Pending',
                        'description' => $task['description'] ?? null,
                        'attachment' => $attachmentPath,
                    ]);
    
                    // Send email to each PIC in the task
                    foreach ($task['task_pics'] as $taskPic) {
                        $pic = User::find($taskPic['id']);
                        if ($pic) {
                            Mail::to($pic->email)->send(new TaskNotification($notulen, $createdTask));
                        }
                    }
                }
            }
    
            Log::info('Tasks attached successfully', ['tasks' => $tasks ?? 'No tasks']);

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
                Guest::create([
                    'notulen_id' => $notulen->id,
                    'name' => $guest['name'],
                    'email' => $guest['email'],
                ]);
                // Store or use the guest data as needed
                // For example, you can send a notification to the guests
                // Send email with attachment
                Mail::to($guest['email'])->send(new GuestNotification($notulen));
            }
        } else {
            Log::info('Guests field is not present');
        }

            // Send email to participants
            foreach ($participants as $participantId) {
                $participant = User::find($participantId);
                Mail::to($participant->email)->send(new NotulenAdded($notulen));
            }
        } catch (\Exception $e) {
            Log::error('Error creating notulen', ['exception' => $e->getMessage(), 'request_data' => $request->all()]);
            return redirect()->route('notulens.create')->with('error', 'Failed to create notulen.');
        }

        return redirect()->route('notulens.index')->with('success', 'Notulen created successfully.');
    }

    public function show($id)
    {
        $notulen = Notulen::with('participants', 'tasks.user', 'guests')->findOrFail($id);
        $user = Auth::user();
        $userTasks = $notulen->tasks->filter(function($task) use ($user) {
            return in_array($user->id, json_decode($task->task_pic, true));
        });
    
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
                'tasks.*.task_topic' => 'required_with:tasks|string',
                'tasks.*.task_due_date' => 'required_with:tasks|date',
                'tasks.*.task_pic' => 'nullable|array',
                'tasks.*.task_pic.*' => 'nullable|integer',
                'tasks.*.description' => 'nullable|string',
                'tasks.*.attachment' => 'nullable|file|mimes:jpeg,png,jpg,pdf,doc,docx|max:2048', // Adjust as needed
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
    
            // Update tasks
            if ($request->has('tasks')) {
                $tasks = $validatedData['tasks']; // Use validated data for tasks
                Log::info('Updating tasks', ['tasks' => $tasks]);
    
                // Clear existing tasks
                $notulen->tasks()->delete();
    
                foreach ($tasks as $task) {
                    $taskPics = $task['task_pic']; // task_pic is already an array of IDs, no need to map
                    $attachmentPath = null;
                    if (isset($task['attachment']) && $task['attachment'] instanceof \Illuminate\Http\UploadedFile) {
                        // Generate a unique file name and store the file
                        $attachmentPath = $task['attachment']->store('attachments', 'public');
                    }
                    
                    $notulen->tasks()->create([
                        'task_topic' => $task['task_topic'],
                        'task_pic' => json_encode($taskPics),
                        'task_due_date' => $task['task_due_date'],
                        'status' => $task['task_status'] ?? 'Pending',
                        'description' => $task['description'] ?? null,
                        'attachment' => $attachmentPath,
                    ]);
                }
                
            }
    
            // Update guests
            if ($request->has('guests')) {
                $guests = $validatedData['guests']; // Use validated data for guests
                Log::info('Updating guests', ['guests' => $guests]);
    
                // Clear existing guests
                $notulen->guests()->delete();
    
                foreach ($guests as $guest) {
                    Guest::create([
                        'notulen_id' => $notulen->id,
                        'name' => $guest['name'],
                        'email' => $guest['email'],
                    ]);
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

            // Check if 'complete' checkbox is checked
            if ($request->has('complete')) {
                $task->status = 'Complete';
                log::info('Task marked as complete', ['id' => $id]);
            } else {
                $task->status = 'In Progress'; // Default status if not complete
                log::info('Task marked as in progress', ['id' => $id]);
            }

            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                $task->attachment = $attachmentPath;
                Log::info('Attachment uploded', ['id' => $id, 'attachment path' => $attachmentPath]);
            }

            $task->save();
            Log::info('Task updated successfully', ['id' => $id]);

            // Return a redirect response after saving the task
            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
