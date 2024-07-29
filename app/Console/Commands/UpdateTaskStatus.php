<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\NotulenTask;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskReminder;

class UpdateTaskStatus extends Command
{
    protected $signature = 'tasks:update-status';
    protected $description = 'Update task statuses based on due dates and send reminder emails';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $tasks = NotulenTask::all();
        $now = Carbon::now();
        $threeDaysFromNow = $now->copy()->addDays(3);

        foreach ($tasks as $task) {
            $dueDate = Carbon::parse($task->task_due_date);
            if ($task->status !== 'Complete') {
                if ($dueDate->isToday()) {
                    $task->status = 'Due Today';
                    // Send reminder email for due today
                    Mail::to($task->user->email)->send(new TaskReminder($task, 'due today'));
                } elseif ($dueDate->isPast()) {
                    $task->status = 'Past Due';
                    // Send reminder email for past due
                    Mail::to($task->user->email)->send(new TaskReminder($task, 'past due'));
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
                    // Send reminder email for due in 3 days
                    Mail::to($task->user->email)->send(new TaskReminder($task, 'due in 3 days'));
                }
            }
        }

        $this->info('Task statuses have been updated and reminder emails sent successfully.');
    }
}
