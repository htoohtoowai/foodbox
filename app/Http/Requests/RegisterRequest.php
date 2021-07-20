<?php

namespace App\Http\Requests;

class RegisterRequest extends BaseRequest
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
            'username'=> 'required|unique:members|min:11|max:15',
            'name' => 'required|max:50',
            'townPcode' => 'required|min:12|max:12',
            'password' => 'required|required_with:passwordConfirmation|min:6',
            'passwordConfirmation' => 'required|same:password|min:6'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => trans('validation.unique'),
            'name.required' => trans('validation.required'),
            'townPcode.required' => trans('validation.required'),
            'password.required' => trans('validation.required')
        ];
    }
}
