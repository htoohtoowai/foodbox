<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Services\DoneeService;
use App\Http\Resources\DoneeResource;
use App\Http\Requests\DoneeRequest;
use App\Http\Requests\DoneeUpdateRequest;
use App\Http\Resources\DoneeResourceCollection;
use App\Http\Filters\DoneeFliter;

class DoneeController extends Controller
{
    public function __construct(DoneeService $doneeService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->doneeService = $doneeService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DoneeFliter $filter, Request $request)
    {
        $data = $this->doneeService->getAllByNextId($filter, $request->nextId);
        if (empty($data)) {
            $donees = new DoneeResourceCollection($data, $this->nextId);
        } else {
            $donees = new DoneeResourceCollection($data['data'], $data['nextId']);
        }
        return $this->httpResponseUtility->successResponse($donees);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoneeRequest $request)
    {
        if (!$this->doneeService->store($request)) {
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
        return $this->httpResponseUtility->successResponse(new DoneeResource($this->doneeService->detail($id)));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoneeUpdateRequest $request, $id)
    {
        if (!$this->doneeService->update($request,$id)) {
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

        if (!$this->doneeService->delete($request,$id)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->deleteResponse();
    }

    public function changeStatus(Request  $request,$id,$status)
    {
        if (!$this->doneeService->changeStatus($request,$id,$status)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->successResponse();
    }
}
