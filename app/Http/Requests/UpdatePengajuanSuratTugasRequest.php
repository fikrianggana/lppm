<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengajuanSuratTugasRequest extends FormRequest
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
        $pst_id = $this->route('pengajuan'); 
        return [
            'usr_id' => ['required'],
            'pst_namasurattugas' => ['required'],
            'pst_masapelaksanaan' => ['required'],
            'pst_buktipendukung' => ['mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx,heic,jpg,png,jpeg'],
        ];
    }
    public function messages()
    {
        return [
            'pst_namasurattugas.required' => 'Nama Surat Tugas wajib diisi.',
            'pst_masapelaksanaan.required' => 'Masa Pelaksanaan wajib diisi.',
            'pst_buktipendukung.mimes' => 'Bukti Pendukung dengan format doc,docx,pdf,xls,xlsx,pdf,ppt,pptx.',
           
        ];
    }
}
