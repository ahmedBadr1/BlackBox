<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BusinessInvitationNotification extends Notification
{
    use Queueable;

    public $userName ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( $userName)
    {
        $this->userName = $userName ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('you have been invited by '.$this->userName. ' to join his business')
                    ->action('Join Us', url('/'))
                    ->line('Hope this mail find you well');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'from' => config('app.name'),
            'msg'=> $this->userName .' invite you to join his business',
            'url' => '/setting',
        ];
    }
}
