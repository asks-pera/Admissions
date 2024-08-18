<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use App\Models\Applicant;

class Paid extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $applicant = Applicant::find($this->id);
        return $this->view('mail.paid')
                    ->with(['applicant'=>$applicant])
                    ->subject("Payment Receipt - S. Thomas' College");
    }
}
