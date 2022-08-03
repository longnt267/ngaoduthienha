<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmailVerifyAccount;
use App\Mail\ResetCodeEmail;
use App\Mail\ResendCode;
use App\Models\User;
use Mail;

class SendEmailApiJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $code;
    protected $type; // type = 0 Verify Account, type = 1 Forgot Password, type = 2 Resend code


    public function __construct($email, $code, $type)
    {
        $this->email = $email;
        $this->code = $code;
        $this->type = $type;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->type == User::FORGOT_PASSWORD_TYPE) {
            Mail::to($this->email)->send(new ResetCodeEmail($this->email, $this->code));
        }
        else if ($this->type == User::RESEND_CODE_TYPE) {
            Mail::to($this->email)->send(new ResendCode($this->email, $this->code));
        }
        else {
            Mail::to($this->email)->send(new SendEmailVerifyAccount($this->email, $this->code));
        }

    }
}
