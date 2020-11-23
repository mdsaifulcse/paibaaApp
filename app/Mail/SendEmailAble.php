<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmailAble extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $goodMsg;
    public function __construct($dataMsg)
    {
        $this->goodMsg=$dataMsg;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $infoMsg=$this->goodMsg;
        return $this->view('mail.index',compact('infoMsg'));
    }
}
