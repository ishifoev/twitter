<?php

namespace App\Notifications\Tweets;

use Illuminate\Notifications\Notification;
use ReflectionClass;

class DatabaseNotificationChannel
{
      /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return array
     */
    public function send($notifiable, Notification $notification)
    {
        $data = $notification->toArray($notifiable);
        return $notifiable->routeNotificationFor('database')->create([
            'id' => $notification->id,
            'type' =>(new ReflectionClass($notification))->getShortName(),
            'data' => $data,
            'read_at' => null,
        ]);
    }
}