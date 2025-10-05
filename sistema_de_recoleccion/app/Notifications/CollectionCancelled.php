<?php

namespace App\Notifications;

use App\Models\Collection;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CollectionCancelled extends Notification
{
    use Queueable;

    protected $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Recolección cancelada #'.$this->collection->id)
                    ->line('La recolección #' . $this->collection->id . ' ha sido cancelada por el usuario: ' . $this->collection->user->name)
                    ->action('Ver recolección', url(route('collections.show', $this->collection)))
                    ->line('Estado actual: ' . $this->collection->status);
    }
}
