<?php

namespace App\Http\Requests;

class DoneeRequest extends BaseRequest
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
            'donees' => 'required|array|max:20',
            'donees.*.categoryItemsId' => 'required|min:1',
            'donees.*.qty' => 'required|min:1',
            'donees.*.unitId' => 'required|min:1',
            'donees.*.note' => 'nullable|max:150'
        ];
    }

    public function messages()
    {
        return [
            'donees.required' => trans('validation.required'),
            'donees.*.categoryItemsId.required' => trans('validation.required'),
            'donees.*.qty.required' => trans('validation.required'),
            'donees.*.unitId.required' => trans('validation.required')

        ];
    }
}
