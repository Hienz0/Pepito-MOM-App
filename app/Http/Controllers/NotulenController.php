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
            'department' => 'required|string',
            'meeting_date' => 'required|date',
            'meeting_time' => 'required|date_format:H:i',
            'meeting_location' => 'required|string',
            'participants' => 'required|array|min:1',
            'agenda' => 'required|string',
            'discussion' => 'required|string',
            'decisions' => 'required|string',
            'action_items' => 'required|string',
            'tasks' => 'required|string',
            'guests' => 'nullable|string', // Validate guests as a JSON string
        ]);

        try {

            $user = Auth::user();

            $notulen = Notulen::create([
                'meeting_title' => $request->meeting_title,
                'meeting_date' => $request->meeting_date,
                'department' => $request->department,
                'meeting_time' => $request->meeting_time,
                'meeting_location' => $request->meeting_location,
                'agenda' => $request->agenda,
                'discussion' => $request->discussion,
                'decisions' => $request->decisions,
                'action_items' => $request->action_items,
                'scripter_id' => $user->id,
            ]);

            $participants = json_decode($request->participants[0], true);
            $notulen->participants()->attach($participants);

            Log::info('Notulen created, attaching tasks', ['notulen_id' => $notulen->id]);

            $tasks = json_decode($request->tasks, true);
            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception('Invalid JSON in tasks field');
            }
            
            foreach ($tasks as $task) {
                $taskPics = array_map(function($taskPic) {
                    return $taskPic['id'];
                }, $task['task_pics']);
            
                // Create the task with task_pic as an array
                $createdTask = $notulen->tasks()->create([
                    'task_topic' => $task['task_topic'],
                    'task_pic' => json_encode($taskPics),
                    'task_due_date' => $task['task_due_date'],
                    'status' => $task['status'] ?? 'Pending',
                    'description' => $task['description'] ?? null,
                    'attachment' => $task['attachment'] ?? null,
                ]);
            
                // Send email to each PIC in the task
                foreach ($task['task_pics'] as $taskPic) {
                    $pic = User::find($taskPic['id']);
                    if ($pic) {
                        Mail::to($pic->email)->send(new TaskNotification($notulen, $createdTask));
                    }
                }
            }
            
            

            
            


            Log::info('Tasks attached successfully', ['tasks' => $tasks]);

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

    
    


    public function updateTask(Request $request, $id)
    {
        try {
            $task = NotulenTask::findOrFail($id);
            $task->description = $request->description;

            // Check if 'complete' checkbox is checked
            if ($request->has('complete')) {
                $task->status = 'Complete';
            } else {
                $task->status = 'In Progress'; // Default status if not complete
            }

            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                $task->attachment = $attachmentPath;
            }

            $task->save();

            // Return a redirect response after saving the task
            return redirect()->back()->with('success', 'Task updated successfully.');
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}
