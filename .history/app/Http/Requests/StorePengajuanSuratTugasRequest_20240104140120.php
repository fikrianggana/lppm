<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanSuratTugasRequest extends FormRequest
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
            'pst_namapengaju' => ['required'],
            'pst_namasurattugas' => ['required'],
            'pst_masapelaksanaan' => ['required'],
            'pst_buktipendukung' => ['required'],
            'pst_namasurattugas' => ['required'],
        ];
    }
}
