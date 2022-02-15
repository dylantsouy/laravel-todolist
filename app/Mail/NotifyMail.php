<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $todo;
    protected $num;
    public function __construct($num, $todo)
    {
        $this->todo = $todo;
        $this->num = $num;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.demoMail')->with([
            'num' => $this->num,
            'user_name' => $this->todo->user_name,
            'todo_name' => $this->todo->name,
            'deadline' => $this->todo->deadline,
        ]);
    }
}
