<?php

namespace App\Mail;

use App\Classes\Common;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;
    protected $section;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $section)
    {
        $this->email = $email;
        $this->section = $section;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $common = new Common();
        return $this->markdown('mail.confirmemail')
                    ->with([
                        'link'=>"https://admissions.stcmount.com/register?email=" . $this->email . "&section=" . $this->section,
                        'year'=>$common->getYear($this->section),
                        'section'=>$common->getName($this->section),
                    ])
                    ->subject("Email Verification - S. Thomas' College");
    }
}
