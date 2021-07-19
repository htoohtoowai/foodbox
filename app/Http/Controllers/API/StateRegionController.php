<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Http\Resources\StateRegionResource;
use App\Services\StateRegionService;

class StateRegionController extends Controller
{
    public function __construct(StateRegionService $stateRegionService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->stateRegionService = $stateRegionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->stateRegionService->getAll();
        if(!$data){
            return $this->httpResponseUtility->successResponse(null,config('httpCode.ok'),trans('message.noContent'));
        }
        return $this->httpResponseUtility->successResponse(StateRegionResource::collection($data));
    }




}
