<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class EloquentUserService implements UserService
{
    public function getAll(): Collection
    {
        return User::all();
    }
}
