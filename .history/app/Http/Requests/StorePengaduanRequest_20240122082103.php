<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengaduan extends FormRequest
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
            'pdn_tipe' => ['required'],
            'pdn_jenis' => ['required'],
            'usr_id' => ['required'],
            'hpt_id' => ['required'],
            'pro_id' => ['required'],
            'smn_id' => ['required'],
            'hcp_id' => ['required'],
            'jrn_id' => ['required'],
            'bku_id' => ['required'],
            'pkm_id' => ['required'],
            'keterangan' => ['required'],
        ];
    }
}
