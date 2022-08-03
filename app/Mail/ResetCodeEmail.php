<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ResetCodeEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $code;
    protected $user;

    public function __construct($email, $code)
    {
        $this->email = $email;
        $this->code = $code;
        $this->user = new User();
    }

    public function build()
    {
        $user = $this->user->getUserByEmail($this->email);
        $name = $user->name;
        $code = $this->code;

        return $this->subject(__('api.subject_forgot_password_email.name'))
                    ->from('support@adamodigital.com', 'Training')
                    ->view('mail.reset_verify', compact('name', 'code'));    
    }
}
