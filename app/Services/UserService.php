<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface UserService
{
    public function getAll(): Collection;
}
