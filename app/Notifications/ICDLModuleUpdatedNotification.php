<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\ICDLModule;

class ICDLModuleUpdatedNotification extends Notification
{

    use Queueable;


    public $icdlModule;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ICDLModule $icdlModule)
    {
        $this->icdlModule = $icdlModule;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->subject('ICDLModule created successfully')
                                ->markdown(
                                    'mail.ICDLModules.created',
                                    ['ICDLModule' => $this->icdlModule]
                                );
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [];
    }

}
