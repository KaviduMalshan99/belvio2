<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ContactFormMail extends Mailable
{
    public $author;
    public $email;
    public $subject;
    public $message;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(Request $request)
    {
        $this->author = $request->input('author');
        $this->email = $request->input('email');
        $this->subject = $request->input('subject');
        $this->message = $request->input('message');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Belvio - Contact Form Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function build()
    // {
    //     // Debugging output
    //     Log::info('Author: ' . gettype($this->author));
    //     Log::info('Email: ' . gettype($this->email));
    //     Log::info('Subject: ' . gettype($this->subject));
    //     Log::info('Message: ' . gettype($this->message));

    //     return $this->view('emails.contactform')
    //         ->subject($this->subject)
    //         ->with([
    //             'author' => $this->author,
    //             'email' => $this->email,
    //             'message' => $this->message,
    //         ]);
    // }

    public function content(): Content
    {
        if (!is_string($this->email)) {
            throw new \InvalidArgumentException('Email must be a string.');
        }
        
        // Assuming $message is an instance of Illuminate\Mail\Message
        if ($this->message instanceof \Illuminate\Mail\Message) {
            // Extract the body content from the message
            $messageContent = $this->message->getBody(); 
        
            // If no body is set, provide a fallback
            if (empty($messageContent)) {
                $messageContent = 'No content provided in the message body.';
            }
        } elseif (!is_string($this->message)) {
            throw new \InvalidArgumentException('Message must be a string or an instance of Illuminate\Mail\Message.');
        } else {
            $messageContent = $this->message;
        }
        
        // dd($messageContent);
        return new Content(
            view: 'emails.contactform', // The view to be rendered
            with: [
                'author' => $this->author,
                'email' => $this->email,
                'subject' => $this->subject,
                'messageContent' => $messageContent,
            ],
        );
    }

    public function build()
    {
        $email = Auth::check() ? Auth::user()->email : env('MAIL_FROM_ADDRESS', 'example@example.com');
        $name = Auth::check() ? Auth::user()->name : env('MAIL_FROM_NAME', 'Example');

        return $this->from($email, $name)
                    ->subject('Your Email Subject')
                    ->view('emails.your-template');
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
