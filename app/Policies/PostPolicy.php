<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user){
        return true;
    }

    public function view(User $user, Post $post){
        return $user->level == User::DEFAULT_LEVEL && $user->id == $post->user_id || $user->level == User::ADMIN_LEVEL;
    }

    public function create(User $user){
        return true;
    }

    public function update(User $user, Post $post){
        if (!$post->exists){
            return $user->level >= User::DEFAULT_LEVEL;
        } else {
            return $user->level == User::DEFAULT_LEVEL && $user->id == $post->user_id
                || $user->level == User::ADMIN_LEVEL && $post->exists;
        }
    }

    public function delete(User $user, Post $post){
        return $user->level == User::DEFAULT_LEVEL && $user->id == $post->user_id
        || $user->level == User::ADMIN_LEVEL && $post->exists;
    }

    public function restore(User $user, User $model){
        return true;
    }

    public function deleteAny(User $user)
    {
        return $user->level >= User::DEFAULT_LEVEL;
    }

}
