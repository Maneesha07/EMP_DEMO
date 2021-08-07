<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmpSignup extends Mailable
{
    use Queueable, SerializesModels;
    protected $details;

    /**
     * Create a new message instance.
     *
     * @param  mixed $details :details
     * 
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = $this->details;
        $view = $this->view('emails.signup')->with([
            'name'      => $data['name'],
            'email'      => $data['email'],
            'password'  => $data['password'],
        ]);
        return $view->subject($data['subject']);
    }
}
