<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\MailtoTicketReply;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessMailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $message_body;
    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message_body,$email)
    {
        $this->email = $email;
        $this->message_body = $message_body;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new MailtoTicketReply($this->message_body));
    }
}
