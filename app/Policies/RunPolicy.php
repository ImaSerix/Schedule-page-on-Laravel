<?php

namespace App\Policies;

use App\Models\Run;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RunPolicy
{
    public function store(User $user): bool
    {
        return $user->role == "admin";
    }

    public function create(User $user): bool
    {
        return $user->role == "admin";
    }

    public function update(User $user): bool
    {
        return $user->role == "admin";
    }

    public function delete(User $user): bool
    {
        return $user->role == "admin";
    }
}
