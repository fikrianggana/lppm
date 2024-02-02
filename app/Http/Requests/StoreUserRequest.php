<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'usr_nama' => ['required'],
            'prodi_id' => ['required'],
            'username' => ['required'],
            'password' => ['required'],
            'usr_role' => ['required'],
            'usr_email' => ['required', 'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/'],
            'usr_notelpon' => ['required', 'numeric'],
        ];
        
    }
    public function messages()
    {
        return [
            'usr_nama.required' => 'Nama wajib diisi.',
            'prodi_id.required' => 'Prodi wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
            'usr_role.required' => 'Role wajib diisi.',
            'usr_email.required' => 'Email wajib diisi dengan format @gmail.com.',
            'usr_notelpon.required' => 'No Telepon hanya bisa angka.',
           
        ];
    }
}
