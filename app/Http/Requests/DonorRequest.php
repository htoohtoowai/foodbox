<?php

namespace App\Http\Requests;

class DonorRequest extends BaseRequest
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
            'donors' => 'required|array|max:20',
            'donors.*.categoryItemsId' => 'required|min:1',
            'donors.*.qty' => 'required|min:1',
            'donors.*.unitId' => 'required|min:1',
            'donors.*.note' => 'nullable|max:150'
        ];
    }

    public function messages()
    {
        return [
            'donors.required' => trans('validation.required'),
            'donors.*.categoryItemsId.required' => trans('validation.required'),
            'donors.*.qty.required' => trans('validation.required'),
            'donors.*.unitId.required' => trans('validation.required')

        ];
    }
}
