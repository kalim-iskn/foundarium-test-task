<?php

namespace App\Services;

use App\DTO\Requests\SetAutoRequest;
use App\DTO\UserDto;

interface UserService
{
    /**
     * @return array<UserDto>
     */
    public function getAll(): array;

    /**
     * @param SetAutoRequest $request
     * @return UserDto
     */
    public function setAuto(SetAutoRequest $request): UserDto;

    /**
     * @param int $autoId
     * @return void
     */
    public function freeAuto(int $autoId): void;
}
