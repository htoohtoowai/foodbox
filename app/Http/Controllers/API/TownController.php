<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Http\Resources\TownResource;
use App\Services\TownService;

class TownController extends Controller
{
    public function __construct(TownService $townService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->townService = $townService;
    }

    public function index($pcode)
    {
        $data = $this->townService->getByStateRegionPcode($pcode);
        if(!$data){
            return $this->httpResponseUtility->successResponse(null,config('httpCode.ok'),trans('message.noContent'));
        }
        return $this->httpResponseUtility->successResponse(TownResource::collection($data));
    }


}
