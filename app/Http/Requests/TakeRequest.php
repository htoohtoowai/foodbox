<?php

namespace App\Http\Requests;

class TakeRequest extends BaseRequest
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
            'takeStatus'=> 'required|integer|min:1',
            'categoryItemsId' => 'integer|min:1|required_if:takeStatus,'.config('enum.takeStatus.custom'),
            'qty' => 'integer|min:1|required_if:takeStatus,'.config('enum.takeStatus.custom'),
            'unitId' => 'integer|min:1|required_if:takeStatus,'.config('enum.takeStatus.custom'),
            'note' => 'max:150'
        ];
    }

    public function messages()
    {
        return [
            'categoryItemsId.required' => trans('validation.required_if'),
            'qty.required' => trans('validation.required_if'),
            'unitId.required' => trans('validation.required_if')
        ];
    }
}
