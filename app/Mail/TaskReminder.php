<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\NotulenTask;

class TaskReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $reminderType;
    public $notulenUrl;

    public function __construct(NotulenTask $task, $reminderType)
    {
        $this->task = $task;
        $this->reminderType = $reminderType;
        $this->notulenUrl = route('notulens.show', ['id' => $task->notulen->id]);
    }

    public function build()
    {
        $notulenId = $this->task->notulen_id; // assuming your task has a notulen_id field

        return $this->view('emails.task_reminder')
                    ->subject('Task Reminder: ' . ucfirst($this->reminderType))
                    ->with([
                        'task' => $this->task,
                        'reminderType' => $this->reminderType,
                        'notulenUrl' => $this->notulenUrl,
                    ]);
    }
}
