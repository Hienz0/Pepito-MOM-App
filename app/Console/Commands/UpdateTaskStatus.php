<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notulen;
use App\Models\NotulenTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminder;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class UpdateTaskStatus extends Command
{
    protected $signature = 'tasks:update-status';
    protected $description = 'Update task statuses based on due dates and send reminder emails for every notulen';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Fetch all notulens and iterate over them
        $notulens = Notulen::with('tasks.user')
        ->where('status', '!=', 'inactive') 
        ->get(); // Ensure that each notulen loads its tasks and their associated users
        
        $now = Carbon::now();
        $threeDaysFromNow = $now->copy()->addDays(3);
    
        foreach ($notulens as $notulen) {
            // Iterate through each task associated with the current notulen
            foreach ($notulen->tasks as $task) {
                $dueDate = Carbon::parse($task->task_due_date);

                if ($task->status !== 'Complete') {
                    if ($dueDate->isToday()) {
                        $task->status = 'Due Today';
                        $this->sendReminderEmails($task, 'due today');
                    } elseif ($dueDate->copy()->addDay()->isSameDay($now)) {
                        $task->status = 'Past Due';
                        $this->sendReminderEmails($task, 'past due');
                    } else {
                        if ($task->attachment) {
                            $task->status = 'In Progress';
                        } else {
                            $task->status = 'Pending';
                        }
                    }

                    $task->save();

                    // Check if the due date is in 3 days
                    if ($dueDate->isSameDay($threeDaysFromNow)) {
                        $this->sendReminderEmails($task, 'due in 3 days');
                    }
                }
            }
        }

        $this->info('Task statuses have been updated and reminder emails sent successfully.');
    }

    protected function sendReminderEmails($task, $reminderType)
    {
        // Decode the JSON string to an array
        $taskPics = json_decode($task->task_pic, true);

        // Check if task_pic is not empty and contains valid user IDs
        if (is_array($taskPics) && !empty($taskPics)) {
            $users = User::whereIn('id', $taskPics)->get();

            // Log user details
            Log::info("Sending {$reminderType} reminder for task ID {$task->id} to users: " . $users->pluck('email')->join(', '));

            foreach ($users as $user) {
                Mail::to($user->email)->send(new TaskReminder($task, $reminderType));

                // Log each email sent
                Log::info("Sent {$reminderType} reminder for task ID {$task->id} to user: {$user->email}");
            }
        } else {
            // Log if no valid users found
            Log::warning("No valid users found in task_pic for task ID {$task->id}");
        }
    }
}
