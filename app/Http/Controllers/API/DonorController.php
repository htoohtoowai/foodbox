<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Services\DonorService;
use App\Http\Resources\DonorResource;
use App\Http\Requests\DonorRequest;
use App\Http\Requests\DonorUpdateRequest;
use App\Http\Resources\DonorResourceCollection;
use App\Http\Filters\DonorFliter;

class DonorController extends Controller
{
    public function __construct(DonorService $donorService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->donorService = $donorService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DonorFliter $filter, Request $request)
    {
        $data = $this->donorService->getAllByNextId($filter, $request->nextId);
        if (empty($data)) {
            $donors = new DonorResourceCollection($data, $this->nextId);
        } else {
            $donors = new DonorResourceCollection($data['data'], $data['nextId']);
        }
        return $this->httpResponseUtility->successResponse($donors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DonorRequest $request)
    {
        if (!$this->donorService->store($request)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->createResponse();    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->httpResponseUtility->successResponse(new DonorResource($this->donorService->detail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DonorUpdateRequest $request, $id)
    {
        if (!$this->donorService->update($request,$id)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->updateResponse();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request  $request,$id)
    {

        if (!$this->donorService->delete($request,$id)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->deleteResponse();
    }

    public function changeStatus(Request  $request,$id,$status)
    {
        if (!$this->donorService->changeStatus($request,$id,$status)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->successResponse();
    }
}
