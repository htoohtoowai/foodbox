<?php

namespace App\Http\Requests;

class SupplierUpdateRequest extends BaseRequest
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
            'nameMM' => 'required|max:70'
        ];
    }

    public function messages()
    {
        return [
            'supplierCategory.required' => trans('validation.required'),
            'nameMM.required' => trans('validation.required')
        ];
    }
}
