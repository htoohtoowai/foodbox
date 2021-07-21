<?php

namespace App\Services;

use App\Repositories\MemberRepository;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\NotFoundException;

class MemberService
{

    public function __construct(MemberRepository $memberRepo)
    {
        $this->memberRepo = $memberRepo;
    }
    public function register($request)
    {
        if($this->memberRepo->isExistRegister($request)){
            throw new BadRequestException(trans('message.alreadyRegister'));
        }
        return $this->memberRepo->register($request);
    }

    public function login($request)
    {
        $member =$this->memberRepo->isExistRegister($request);
        if(!$member){
            throw new NotFoundException(trans('message.notFound'));
        }
        if (! Hash::check($request->password, $member->password)) {
            throw ValidationException::withMessages([
                'username' => ['The provided credentials are incorrect.'],
            ]);
        }
        return $this->memberRepo->login($request,$member);

    }

}
