<?php

namespace App\Http\Requests;

class SupplierRequest extends BaseRequest
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
            'supplierCategory'=> 'required|min:1',
            'nameEN' => 'nullable|max:50',
            'nameMM' => 'required|max:70',
            'addressInfo' => 'required|array|max:20',
            'addressInfo.*.townPcode' => 'required|min:12|max:12',
            'addressInfo.*.phone' => 'nullable|min:7|max:70',
            'addressInfo.*.addressEN' => 'nullable|max:150',
            'addressInfo.*.addressMM' => 'required|max:150'
        ];
    }

    public function messages()
    {
        return [
            'supplierCategory.required' => trans('validation.required'),
            'nameMM.required' => trans('validation.required'),
            'addressInfo.required' => trans('validation.required'),
            'addressInfo.*.townPcode.required' => trans('validation.required'),
            'addressInfo.*.addressMM.required' => trans('validation.required')
        ];
    }
}
