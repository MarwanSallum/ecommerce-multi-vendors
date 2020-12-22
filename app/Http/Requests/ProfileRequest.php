<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name' => 'string',
            'email' => 'email|unique:admins,email,'. $this -> id,
            'mobile' => 'numeric|unique:admins,mobile,'. $this -> id,
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('validation.required'),
            'email.required' => __('validation.email'),           
        ];
    }
}
