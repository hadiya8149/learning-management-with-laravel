<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    private $url;
    public $rememberToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $token)
    {
        $this->name = $name;
        $this->rememberToken = $token;
        $this->url = env('BASE_URL').'/set-password/?token='.$this->rememberToken;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Set Password',
        );
    }


    public function build()
{
    return $this->view('emails.setpassword')
                    ->with([
                        'name' => $this->name,
                        'setPasswordUrl'=>$this->url,
                    ]);
 
}
    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
