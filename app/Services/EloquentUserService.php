<?php

namespace App\Services;

use App\DTO\Requests\SetAutoRequest;
use App\DTO\UserDto;
use App\Exceptions\AutoAlreadyFreeException;
use App\Exceptions\AutoAlreadyTakenException;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EloquentUserService implements UserService
{
    public function getAll(): array
    {
        $users = User::all()->sort();
        $dtoUsers = [];

        foreach ($users as $user) {
            $dtoUsers[] = $user->toDto();
        }

        return $dtoUsers;
    }

    /**
     * @throws ValidationException
     */
    public function setAuto(SetAutoRequest $request): UserDto
    {
        $this->validate((array) $request);

        if (User::where("auto_id", $request->autoId)->exists()) {
            throw new AutoAlreadyTakenException();
        }

        User::where("id", $request->userId)
            ->update(["auto_id" => $request->autoId]);

        $user = User::find($request->userId);

        return $user->toDto();
    }

    /**
     * @throws ValidationException
     */
    public function freeAuto(int $autoId): void
    {
        $this->validate(["autoId" => $autoId]);

        $user = User::where("auto_id", $autoId)->first();

        if ($user == null) {
            throw new AutoAlreadyFreeException();
        }

        $user->auto_id = null;

        $user->save();
    }

    /**
     * @throws ValidationException
     */
    public function validate(array $data): void
    {
        Validator::make($data, [
            "userId" => "exists:users,id",
            "autoId" => "exists:autos,id"
        ])->validate();
    }
}
