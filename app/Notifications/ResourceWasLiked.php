<?php

namespace App\Notifications;

use App\Models\Video;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResourceWasLiked extends Notification
{
    use Queueable;

    private $resource;
    private $likingName;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($resource, $likingName)
    {
        $this->resource = $resource;
        $this->likingName = $likingName;
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
        if ($this->resource instanceof (new Video)) {
            $resourceName = 'ویدئو';
        } else if ($this->resource instanceof (new Comment)) {
            $resourceName = 'دیدگاه';
        }
        return (new MailMessage)
                    ->greeting('سلام!')
                    ->line($notifiable->name . ' عزیز!  '. $resourceName . '  شما توسط   '. $this->likingName . ' پسندیده شد. ' )
                    ->line($this->resource->name ?? '')
                    ->line($this->resource->body ?? '');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
