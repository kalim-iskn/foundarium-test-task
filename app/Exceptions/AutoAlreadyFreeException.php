<?php

namespace App\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class AutoAlreadyFreeException extends UnprocessableEntityHttpException
{
    public function __construct(\Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct('Auto is already free', $previous, $code, $headers);
    }
}
