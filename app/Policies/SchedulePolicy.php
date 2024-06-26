<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SchedulePolicy
{

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

    public function store(User $user): bool
    {
        return $user->role == "admin";
    }
}
