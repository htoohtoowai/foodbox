<?php
namespace App\Http\Utilities;

class HttpResponseUtility
{
    public function jsonResponse($data, $code,$isSuccess, $message)
    {
        return response()->json([
            'success' => $isSuccess,
            'message'=> $message,
            'data' => $data,
        ], $code);
    }

    public function successResponse($data = null, $statusCode = null, $message = null)
    {
        return $this->jsonResponse($data, $statusCode ?? config('httpCode.ok'),true, $message ?? trans('message.ok'));
    }

    public function badRequestResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.badRequest'),false, $message ?? trans('message.badRequest'));
    }

    public function notFoundResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.badRequest'),false, $message ?? trans('message.notFound'));
    }

    public function unauthorizedResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.unauthorized'),false, $message ?? trans('message.unauthorised'));
    }

    public function createResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.created'),true, $message ?? trans('message.created'));
    }

    public function updateResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.ok'),true, $message ?? trans('message.update'));
    }

    public function deleteResponse($data = null, $message = null)
    {
        return $this->jsonResponse($data, config('httpCode.ok'),true, $message ?? trans('message.delete'));
    }

}
