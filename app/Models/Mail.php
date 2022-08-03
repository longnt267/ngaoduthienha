<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\SendEmailJob;


class Mail extends Model
{
    use HasFactory;

    protected $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    public function sendMail()
    {
        $sendMailJob = new SendEmailJob($this->booking);
        dispatch($sendMailJob);
    }
}
