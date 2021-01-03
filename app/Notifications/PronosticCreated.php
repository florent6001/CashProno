<?php

namespace App\Notifications;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class PronosticCreated extends Notification
{
    use Queueable;

    public function via($notifiable): array
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        $url = url('/pronostic/' . $notifiable->id);

        return TelegramMessage::create()
            // Optional recipient user id.
            ->to('-1001476149651')
            ->content("Salut tout le monde!\nUn nouveau pronostic vient d'être *publié* sur CashProno !")
            ->button('Voir le pronostic', $url);
    }

}
