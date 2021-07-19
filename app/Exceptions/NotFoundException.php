<?php

namespace App\Exceptions;

use Exception;

class NotFoundException extends Exception
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
