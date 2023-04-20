<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListSent extends Mailable
{
    use Queueable, SerializesModels;

    protected $todolists;

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('listsent',
        ['todolists' => $this->todolists])
            ->from('000776331@mohawkcollege.ca')
            ->subject('Here Is Your TODO List!!');
    }
      /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($todolists)
    {
        $this->todolists = $todolists;
    }
    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope();
    }
    

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content(): Content
    {
        return new Content($this->view('listsent'));
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

