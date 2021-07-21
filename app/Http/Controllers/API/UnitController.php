<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Services\UnitService;
use App\Http\Resources\UnitResource;

class UnitController extends Controller
{
    public function __construct(UnitService $unitService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->unitService = $unitService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->unitService->getAll();
        if(!$data){
            return $this->httpResponseUtility->successResponse(null,config('httpCode.ok'),trans('message.noContent'));
        }
        return $this->httpResponseUtility->successResponse(UnitResource::collection($data));
    }
}
