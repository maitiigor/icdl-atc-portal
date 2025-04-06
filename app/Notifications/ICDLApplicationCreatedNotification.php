<?php


namespace App\Notifications;

use App\Models\ICDLApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use App\Models\ICDLModule;

class ICDLApplicationCreatedNotification extends Notification
{

    use Queueable;


    public $icdlApplication;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ICDLApplication $iCDLApplication)
    {
        $this->icdlApplication = $iCDLApplication;
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
        return (new MailMessage)->subject('Application recieved')
                                ->markdown(
                                    'mail.icdl_applications.created',
                                    ['icdlApplication' => $this->icdlApplication]
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
