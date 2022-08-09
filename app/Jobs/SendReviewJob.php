<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendReviewMail;
use Illuminate\Support\Facades\Mail;
class SendReviewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $booking;
    protected $url;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($booking, $url)
    {
        $this->booking = $booking;
        $this->url = $url;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new SendReviewMail($this->booking, $this->url);
        Mail::to($this->booking->email)->send($mail);
    }
}
