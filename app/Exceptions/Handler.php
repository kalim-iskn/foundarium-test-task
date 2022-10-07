<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    public function render($request, Throwable $e)
    {
        $data = [
            "status" => "error"
        ];

        if ($e instanceof HttpException) {
            $data["message"] = $e->getMessage();
            $code = $e->getStatusCode();
        } else if ($e instanceof ValidationException) {
            $data["message"] = $e->errors();
            $data["status"] = "validation_error";
            $code = 422;
        } else {
            $data["message"] = "Undefined error";
            $code = 500;
        }

        return response()->json(["data" => $data], $code);
    }
}
