<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $message;

    public function __construct($task, $message)
    {
        $this->task = $task;
        $this->message = $message;
    }

    public function build()
    {
        return $this->subject('Task Notification')
                    ->view('emails.taskNotification')
                    ->with([
                        'task' => $this->task,
                        'message' => $this->message,
                    ]);
    }
}
