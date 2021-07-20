<?php

namespace App\Http\Requests;

class LoginRequest extends BaseRequest
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
            'username'=> 'required|min:11|max:15',
            'password' =>  'required|string|min:6',
            'deviceName' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => trans('validation.required'),
            'password.required' => trans('validation.required'),
            'deviceName.required' => trans('validation.required')
        ];
    }
}
