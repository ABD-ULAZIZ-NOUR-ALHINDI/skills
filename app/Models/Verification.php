<?php

namespace App\Models;

use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Verification extends Model
{
    use Notifiable;

    protected $table = 'verifications';
    public $timestamps = false;
    protected $dateFormat = 'U';
    protected $guarded = ['id'];

    const EXPIRE_TIME = 3600; // second => 1 hour

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sendEmailCode()
    {
        $transport = (new Swift_SmtpTransport(\env('MAIL_HOST'), env('MAIL_PORT')))
        ->setUsername(env('MAIL_USERNAME'))
        ->setPassword(env('MAIL_PASSWORD'))
        ->setEncryption(env('MAIL_ENCRYPTION'));

        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);

        // Create a message
        $message = (new Swift_Message("This is test"))
        ->setFrom(env('MAIL_FROM_ADDRESS'))
        ->setTo([$this->email])
        ->setSubject(trans('auth.email_confirmation'))
        ->setBody('<p>You registered an account on '.ucfirst(env('APP_NAME')).', before being able to use your account you need to verify that this is your email address with code '.$this->code.'.</p>
        <p><br></p>
        <p>Kind Regards, '.ucfirst(env('APP_NAME')).'</p>','text/html');

        // Send the message
        $result = $mailer->send($message);
    }

    public function sendSMSCode()
    {
        $this->notify(new SendVerificationSMSCode($this));
    }
}
