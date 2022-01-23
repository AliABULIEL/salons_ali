<?php

namespace App\Notifications;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Benwilkins\FCM\FcmMessage;

class OrderCanceled extends Notification
{
    public $order;
    
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'fcm'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        app()->setLocale($notifiable->locale);
        
        return $this->order->details();
    }

    public function toFcm($notifiable) 
    {
        app()->setLocale($notifiable->locale);
        
        $details = $this->order->details();

        $message = new FcmMessage();

        $title = __('words.reservation_canceled');
        $content = __('words.reservation_canceled_content', [
                   'name' => $details['name'],
                 ]);

        $message->content([
            'title'        => $title, 
            'body'         => $content,
            'sound'        => '', // Optional 
            'icon'         => '', // Optional
            'click_action' => '' // Optional
        ])->data([
            'order_id' => $details['id'] // Optional
        ])->priority(FcmMessage::PRIORITY_HIGH); // Optional - Default is 'normal'.
        

        return $message;
    }
}
