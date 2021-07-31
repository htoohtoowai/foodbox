<?php

namespace App\Repositories;

use App\Models\Members\Member;
use Illuminate\Support\Facades\Hash;

class MemberRepository extends BaseRepository
{
    public function __construct(Member $model)
    {
       $this->model = $model;
       $this->level = config('enum.member.levelOne');
    }

    public function register($request)
    {
      return $this->model->create([
            'username'=>$request->username,
            'name'=>$request->name,
            'level'=>$this->level,
            'town_pcode'=>$request->townPcode,
            'password'=> Hash::make($request->password),
            'is_verified'=>true,
        ]);
    }
    public function isExistRegister($request)
    {
        return $this->model->where('username',$request->username)->first();
    }
    public function login($request,$member)
    {
      $token = $member->createToken($request->deviceName)->plainTextToken;
      return [
          [
            'id'=>$member->id,
            'username'=>$member->username,
            'name'=>$member->name,
            'level'=>$member->level,
            'townPcode'=>$member->town_pcode
          ]
          ,$token];
    }
}
