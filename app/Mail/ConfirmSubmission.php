<?php

namespace App\Mail;

use App\Classes\Common;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmSubmission extends Mailable
{
    use Queueable, SerializesModels;

    protected $id, $email, $name, $section;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id, $email, $name, $section)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
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
        $section = $common->getLink($this->section);
        return $this->view('mail.confirmsubmision')
                    ->with([
                        'email'=>$this->email, 
                        'id'=>$this->id, 
                        'name'=>$this->name,
                        'year'=>$common->getYear($section),
                    ])
                    ->attach($_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $this->id . '_pdf.pdf')
                    ->subject("Form Submitted - S. Thomas' College");
    }
}
