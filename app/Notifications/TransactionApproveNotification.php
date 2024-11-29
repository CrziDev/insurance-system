<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransactionApproveNotification extends Notification
{
    use Queueable;
    public $requestor;
    public $type;
    public $renew;
    /**
     * Create a new notification instance.
     */
    public function __construct($requestor,$type,$renew)
    {
        $this->requestor = $requestor;
        $this->type = $type;
        $this->renew = $renew;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        if($this->renew){
            return [
                'event' => 'Request was Renew by admin',
                'date' => now(),
                'type' => $this->type,
                'requestor' => $this->requestor
            ];
        }else{
            return [
                'event' => 'Request was Approved by admin',
                'date' => now(),
                'type' => $this->type,
                'requestor' => $this->requestor
            ];
        }
    }
}
