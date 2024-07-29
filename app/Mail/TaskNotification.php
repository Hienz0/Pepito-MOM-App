<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $notulen;
    public $task;
    public $notulenUrl;

    public function __construct($notulen, $task)
    {
        $this->notulen = $notulen;
        $this->task = $task;
        $this->notulenUrl = route('notulens.show', ['id' => $notulen->id]);
    }

    public function build()
    {
        return $this->view('emails.task_notification')
                    ->subject('New Task Assigned: ' . $this->task['task_topic'])
                    ->with([
                        'notulen' => $this->notulen,
                        'task' => $this->task,
                        'notulenUrl' => $this->notulenUrl,
                    ]);
    }
}
