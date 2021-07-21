<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Utilities\HttpResponseUtility;
use App\Services\SupplierAddressService;
use App\Http\Requests\SupplierAddressUpdateRequest;

class SupplierAddressController extends Controller
{
    public function __construct(SupplierAddressService $suppliersAddressService, HttpResponseUtility $httpResponseUtility)
    {
        $this->httpResponseUtility = $httpResponseUtility;
        $this->suppliersAddressService = $suppliersAddressService;
    }
    public function update(SupplierAddressUpdateRequest $request, $id)
    {
        if (!$this->suppliersAddressService->update($request->all(),$id)) {
            return $this->httpResponseUtility->badRequestResponse();
        }
        return $this->httpResponseUtility->updateResponse();
    }


}
