<?php

declare(strict_types=1);

namespace App\Listeners;

use App\Events\CommentCreatedEvent;
use App\Models\User;
use App\Notifications\NewCommentNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCommentCreatedNotifications implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(CommentCreatedEvent $event): void
    {
        // serve para remover o criador do comentario assim ele nao recebe a notificao
        foreach (User::whereNot('id', $event->comment->user_id)->cursor() as $user) { // cursor: serve para paginar os registro do banco para nao sobrecarregar a aplicacao
            $user->notify(new NewCommentNotification($event->comment));
        }
    }
}
