<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function delete(User $user)
    {
        return $user->email === "shohel@gmail.com";
    }

    public function edit(User $user)
    {
        return $user->email === "shohel@gmail.com" || $user->email === 'rana@gmail.com';
    }
}
