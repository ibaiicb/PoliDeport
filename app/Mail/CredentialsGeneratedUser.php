<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredentialsGeneratedUser extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, String  $password)
    {
        $this->user = $user;
        $this->password =  $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.credentialsUserGenerated');
    }
}
