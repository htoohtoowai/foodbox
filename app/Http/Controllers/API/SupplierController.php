<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Http\Resources\SupplierResourceCollection;
use App\Services\SupplierService;
use App\Http\Filters\SupplierFliter;

class SupplierController extends Controller
{
    public function __construct(SupplierService $suppliersService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->suppliersService = $suppliersService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SupplierFliter $filter, Request $request)
    {
        $data = $this->suppliersService->getAllByNextId($filter, $request->nextId);
        if (empty($data)) {
            $suppliers = new SupplierResourceCollection($data, $this->nextId);
        } else {
            $suppliers = new SupplierResourceCollection($data['data'], $data['nextId']);
        }
        return $this->httpResponseUtility->successResponse($suppliers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
