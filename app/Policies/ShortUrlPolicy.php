<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlPolicy
{

    public function viewAny(User $user): bool
    {

        if ($user->role->name === 'SuperAdmin') {
            return false;
        }


        return in_array($user->role->name, ['Admin', 'Member']);
    }


    public function view(User $user, ShortUrl $shortUrl): bool
    {

        if ($user->role->name === 'SuperAdmin') {
            return false;
        }


        if ($user->role->name === 'Admin') {
            return $shortUrl->user->company_id !== $user->company_id;
        }


        if ($user->role->name === 'Member') {
            return $shortUrl->user_id !== $user->id;
        }

        return false;
    }


    public function create(User $user): bool
    {
        return false;
    }


    public function update(User $user, ShortUrl $shortUrl): bool
    {
        return false;
    }


    public function delete(User $user, ShortUrl $shortUrl): bool
    {
        return false;
    }


    public function resolve(?User $user, ShortUrl $shortUrl): bool
    {

        return false;
    }
}
