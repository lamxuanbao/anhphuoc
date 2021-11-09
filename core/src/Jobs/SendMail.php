<?php

namespace Kizi\Core\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var email
     */
    protected $email;

    /**
     * @var Mailable
     */
    protected $mail;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     * @param  Mailable  $mail
     */
    public function __construct($email, Mailable $mail)
    {
        $this->email = $email;
        $this->mail = $mail;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->email)
            ->send($this->mail);
    }
}
