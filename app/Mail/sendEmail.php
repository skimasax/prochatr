<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var JSC Email Mailable
     */
    public $mail;
 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($thisMail)
    {
        $this->mail = $thisMail;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if($this->mail->purpose == "invite"){
        return $this->subject(ucwords(session('prochatr_firstname').' a '.$this->mail->profession.' at '.$this->mail->company.' is inviting you to chat on prochatr'))->view('mails.invite')
                    ->with('maildata', $this->mail);
        }            
        if($this->mail->purpose == "inviteAdded"){
        return $this->subject($this->mail->subject)->view('mails.inviteconnection')
                    ->with('maildata', $this->mail);
        }        
        if($this->mail->purpose == "subscribe"){
        return $this->subject('Thanks For Subscribing To our Newsletter')->view('mails.subscribe')
                    ->with('maildata', $this->mail);
        }          
        if($this->mail->purpose == "welcome"){
        return $this->subject('Welcome to Prochatr. Start new conversation with other professionals!')->view('mails.welcome')
                    ->with('maildata', $this->mail);
        }         
        if($this->mail->purpose == "contact"){
        return $this->subject(ucwords($this->mail->name).': '.$this->mail->subject)->view('mails.contact')
                    ->with('maildata', $this->mail);
        }         
        if($this->mail->purpose == "resetlink"){
        return $this->subject('Prochatr Password Reset Link')->view('mails.reset')
                    ->with('maildata', $this->mail);
        }        
        if($this->mail->purpose == "reset"){
        return $this->subject('Prochatr Password Reset Success')->view('mails.doreset')
                    ->with('maildata', $this->mail);
        }        
        if($this->mail->purpose == "sendMessage"){
        return $this->subject('New Message From '.ucwords($this->mail->from))->view('mails.sendMessage')
                    ->with('maildata', $this->mail);
        }         
        if($this->mail->purpose == "alternate_email"){
        return $this->subject('Altername Email Update')->view('mails.alternate_email')
                    ->with('maildata', $this->mail);
        }     
    }
}