<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Services\MemberService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class MemberController extends Controller
{
    public function __construct(MemberService $memberService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->memberService = $memberService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $this->memberService->register($request);
        if (!$data) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->successResponse($request->all());
    }
    public function login(LoginRequest $request)
    {
        return $this->httpResponseUtility->successResponse($this->memberService->login($request));

    }
}
