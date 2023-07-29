<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DispatcherRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'email'=>'required|email:unique,dispatchers',
            'password'=>'required|confirmed',
            'local_government'=>'required|string',
            'street'=>'required|string',
            'state'=>'required|string',
            'number'=>'required|numeric',
            'phone_number'=>'required'

        ];
    }
}
