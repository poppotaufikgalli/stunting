<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            //'email' => 'required|email:rfc,dns|unique:users,email',
            'email' => 'required|email|unique:users,email',
            'nama' => 'required',
            'nip' => 'required|unique:users,nip',
            'jabatan' => 'required',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password'
        ];
    }
}
