<?php

namespace App\Exceptions;

use Exception;

class BadRequestException extends Exception
{
    public function render($request)
    {
        return response()->json([
            'success' => false,
            'message'=> $this->getMessage(),
            'data' => null,
        ], config('http_status.badRequest'));
    }
}
