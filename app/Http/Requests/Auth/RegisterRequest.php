<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
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
            'fio'      => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:students',
            'password' => ['required', 'confirmed', Password::min(3)],
            'school'   => 'required|integer|min:0'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'fio'    => __('common.fio'),
            'school' => __('common.school'),
        ];
    }

}
