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
}
