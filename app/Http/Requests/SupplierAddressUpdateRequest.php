<?php

namespace App\Http\Requests;

class SupplierAddressUpdateRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'supplierId'=> 'required|min:1',
            'townPcode' => 'required|min:12|max:12',
            'phone' => 'nullable|min:7|max:70',
            'addressEN' => 'nullable|max:150',
            'addressMM' => 'required|max:150',
        ];
    }

    public function messages()
    {
        return [
            'supplierId.required' => trans('validation.required'),
            'townPcode.required' => trans('validation.required'),
            'addressMM.required' => trans('validation.required')
        ];
    }
}
