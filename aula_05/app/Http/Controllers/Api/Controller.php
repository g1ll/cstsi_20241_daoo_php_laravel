<?php

namespace App\Http\Controllers\Api;

use Exception;

abstract class Controller
{
    //

    protected function errorHandler(string $message, Exception $error, int $statusHttp)
    {
        $responseError = [
            'message' => $message,
            'exception' => $error->getMessage(),
            'error'=>$error
        ];

        $statusHttp = 500;

        if (env('APP_DEBUG'))
            $responseError = [
                ...$responseError,
                'trace' => $error->getTrace()
            ];

        return response()->json($responseError, $statusHttp);
    }
}
