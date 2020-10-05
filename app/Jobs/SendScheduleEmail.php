<?php

namespace App\Jobs;

use App\Mail\Email\SendEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendScheduleEmail implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

        protected $emailDetails;

    public function __construct($emailDetails)
    {

        $this->emailDetails = $emailDetails;
      //  dd($this->emailDetails);
    }

    public function handle(AudioProcessor $processor)
    {
        $email = new SendEmail();
        Mail::to($this->emailDetails['email'])->send($email);
    }
}
