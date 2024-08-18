<?php

namespace App\Mail;

use App\Classes\Common;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Applicant;

class RegisterApplicant extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    protected $password;
    protected $section;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $password, $section)
    {
        $this->id = $id;
        $this->password = $password;
        $this->section = $section;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $applicant = Applicant::find($this->id);
        $common = new Common();
        return $this->markdown('mail.register')
                    ->with([
                        'applicant'=>$applicant, 
                        'password'=>$this->password,
                        'year'=>$common->getYear($common->getLink($this->section)),
                        'section'=>$common->getName($this->section),
                    ])
                    ->subject("Login details - S. Thomas' College");
    }
}
