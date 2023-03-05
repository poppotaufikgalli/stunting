<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
{
    protected $rules = [];
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
        $method = $this->method();
        if (null !== $this->get('_method', null)) {
            $method = $this->get('_method');
        }
        $this->offsetUnset('_method');

        switch ($method) {
            case 'GET':
            case 'DELETE':
                break;
            /*case 'DELETE':
                $this->rules = [ 
                ];
                break;
            case 'GET':
                $this->rules = [ //rules here for get request];
                break;*/

            case 'POST':
                $this->rules = [
                    //'email' => 'required|email:rfc,dns|unique:users,email',
                    'nip' => 'required|unique:users,nip',
                    'email' => 'required|email|unique:users,email',
                    'nama' => 'required',
                    'jabatan' => 'required',
                    'password' => 'required|min:8',
                    'password_confirmation' => 'required|same:password'
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $this->rules = [
                    'nama' => ['required', Rule::unique('users')->ignore($user->id)],
                    'nip' => ['required', Rule::unique('users')->ignore($user->id)],
                    'jabatan' => 'required',
                ];
                break;   
         
            default:
                break;
        }

        return $this->rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak sesuai',
            'email.unique' => 'Email telah terdaftar',

            'nama.required' => 'Nama tidak boleh kosong',

            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP telah terdaftar',

            'jabatan.required' => 'Jabatan tidak boleh kosong',

            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password tidak boleh kurang dari 8',

            'password_confirmation.required' => 'Konfirmasi Password tidak boleh kosong',
            'password_confirmation.same' => 'Konfirmasi Password tidak sama dengan Password',
        ];
    }
}
