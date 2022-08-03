<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class SendEmailVerifyAccount extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $code;
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
        $this->user = new User();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user->getUserByEmail($this->email);
        $name = $user->name;
        $code = $this->code;
        return $this->subject(__('api.subject_verify_email.name'))
                    ->from('support@adamodigital.com', 'Training')
                    ->view('mail.verify_user', compact('name', 'code')); 
    }
}
