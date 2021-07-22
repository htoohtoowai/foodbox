<?php

namespace App\Http\Requests;

class DonorUpdateRequest extends BaseRequest
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
            'categoryItemsId' => 'required|integer|min:1',
            'qty' => 'required|integer|min:1',
            'unitId' => 'required|integer|min:1',
            'note' => 'nullable|max:150'
        ];
    }

    public function messages()
    {
        return [
            'categoryItemsId.required' => trans('validation.required'),
            'qty.required' => trans('validation.required'),
            'unitId.required' => trans('validation.required')
        ];
    }
}
