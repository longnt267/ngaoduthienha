<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendReviewMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $booking;
    protected $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($booking, $url)
    {
        $this->booking = $booking;
        $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $booking = $this->booking;
        $url = $this->url;
        return $this->view('mail.mail_review_booking', compact('booking', 'url'));
    }
}
