<?php

namespace App\DTO;

class UserDto
{
    public int $id;
    public string $name;
    public ?AutoDto $auto = null;

    /**
     * @param int $id
     * @param string $name
     * @param AutoDto|null $auto
     */
    public function __construct(int $id, string $name, ?AutoDto $auto)
    {
        $this->id = $id;
        $this->name = $name;
        $this->auto = $auto;
    }
}
