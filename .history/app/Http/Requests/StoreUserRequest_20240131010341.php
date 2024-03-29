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
            'usr_email' => ['required'],
            'usr_notelpon' => ['required', 'numeric'],
        ];
    }
}
