<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;

class ShortUrlPolicy
{
    /**
     * Determine whether the user can view any short URLs
     */
    public function viewAny(User $user): bool
    {
        // ❌ SuperAdmin cannot view short URLs
        if ($user->role->name === 'SuperAdmin') {
            return false;
        }

        // ✅ Admin & Member allowed (with conditions in controller/query)
        return in_array($user->role->name, ['Admin', 'Member']);
    }

    /**
     * Determine whether the user can view a specific short URL
     */
    public function view(User $user, ShortUrl $shortUrl): bool
    {
        // ❌ SuperAdmin blocked
        if ($user->role->name === 'SuperAdmin') {
            return false;
        }

        // ✅ Admin: cannot view URLs from own company
        if ($user->role->name === 'Admin') {
            return $shortUrl->user->company_id !== $user->company_id;
        }

        // ✅ Member: cannot view URLs created by self
        if ($user->role->name === 'Member') {
            return $shortUrl->user_id !== $user->id;
        }

        return false;
    }

    /**
     * Determine whether the user can create short URLs
     * ❌ Nobody can create
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the short URL
     */
    public function update(User $user, ShortUrl $shortUrl): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the short URL
     */
    public function delete(User $user, ShortUrl $shortUrl): bool
    {
        return false;
    }

    /**
     * Determine whether the user can resolve short URLs publicly
     */
    public function resolve(?User $user, ShortUrl $shortUrl): bool
    {
        // ❌ Short URLs are not publicly resolvable
        return false;
    }
}
