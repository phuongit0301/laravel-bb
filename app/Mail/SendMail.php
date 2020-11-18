<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    use Queueable, SerializesModels;
    public $title;
    public $image;
    public $realPath;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($title, $image, $realPath)
    {
        $this->title = $title;
        $this->image = $image;
        $this->realPath = $realPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->title)
                    ->attach($this->realPath,
                    [
                        'as' => $this->image->getClientOriginalName(),
                        'mime' => $this->image->getClientMimeType(),
                    ])
                    ->view('qrcode');
    }
}
