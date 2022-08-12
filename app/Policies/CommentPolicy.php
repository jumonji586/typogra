<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function deleteComment(User $user,int $commentUserId)
    {
        return $user->id === $commentUserId || $user->role === "admin";
    }

    public function deleteSubComment(User $user,int $SubCommentUserId)
    {
        return $user->id === $SubCommentUserId || $user->role === "admin";
        // return false;
    }
}
