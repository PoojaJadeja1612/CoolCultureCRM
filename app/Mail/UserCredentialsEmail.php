<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCredentialsEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $emailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($emailData)
    {
        $this->emailData = $emailData;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_credentials', [
            'userId' => $this->emailData['userId'],
            'password' => $this->emailData['password'],
        ])->subject('Your User Credentials');
    }
}
