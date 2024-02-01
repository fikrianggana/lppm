<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHakCiptaRequest extends FormRequest
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
            'hcp_namalengkap' => ['required'],
            'hcp_judul' => ['required'],
            'hcp_noapk' => ['required', 'max:13'],
            'hcp_sertifikat' => ['required', 'numeric', 'digits:10'],
            'hcp_keterangan' => ['required'],
            'usr_id' => ['required'],
        ];
    }


    public function messages()
    {
        return [
            'hcp_namalengkap.required' => 'Nama Lengkap wajib diisi.',
            'hcp_judul.required' => 'Judul wajib diisi.',
            'hcp_noapk.required' => 'No Aplikasi wajib diisi.',
            'hcp_noapk.max' => 'No Aplikasi harus terdiri dari 13 digit.',
            'hcp_noapk.unique' => 'No Aplikasi sudah digunakan.',
            'hcp_sertifikat.required' => 'Sertifikat wajib diisi.',
            'hcp_sertifikat.digits' => 'Sertifikat harus terdiri dari 10 digit.',
            'hcp_keterangan.required' => 'Keterangan wajib diisi.',
           
        ];
    }
}
