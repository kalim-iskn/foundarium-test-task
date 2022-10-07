<?php

namespace App\DTO\Requests;

class SetAutoRequest
{
    public int $userId;
    public int $autoId;

    /**
     * @param int $userId
     * @param int $autoId
     */
    public function __construct(int $userId, int $autoId)
    {
        $this->userId = $userId;
        $this->autoId = $autoId;
    }
}
