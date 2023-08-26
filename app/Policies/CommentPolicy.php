<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        return $comment->user()->is($user);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->update($user, $comment); // reuso, mas nada impede de criar regras para essa acao
    }
}
