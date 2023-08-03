<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Mail\MailtoTicketSender;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class NewTicketJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    public $ticket_no;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $ticket_no)
    {
        $this->ticket_no = $ticket_no;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)->send(new MailtoTicketSender($this->email,$this->ticket_no));
    }
}
