<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePengabdianMasyarakatRequest extends FormRequest
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
        $pkm_id = $this->route('pengabdian'); 
        return [
            'pkm_namakegiatan' => ['required'],
            'pkm_jenis' => ['required'],
            'pkm_waktupelaksanaan' => ['required'],
            'pkm_personilterlibat' => ['required'],
            'pkm_jumlahpenerimamanfaat' => ['required', 'numeric', 'min:1'],
            'pkm_buktipendukung' => ['mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx'],
            'pkm_mahasiswa' => ['nullable'],
            'pkm_nim' => ['nullable'],
            'prodi_id'=>['nullable'],

        ];
    }
    public function messages()
    {
        return [
            'pkm_namakegiatan.required' => 'Nama Kegiatan wajib diisi.',
            'pkm_jenis.required' => 'Jenis wajib diisi.',
            'pkm_waktupelaksanaan.required' => 'Waktu Pelaksanaan wajib diisi.',
            'pkm_personilterlibat.required' => 'Personil Terlibat wajib diisi.',
            'pkm_jumlahpenerimamanfaat.min' => 'Jumlah Penerima Manfaat wajib diisi minimal 1.',
            'pkm_buktipendukung.mimes' => 'Bukti Pendukung dengan format doc,docx,pdf,xls,xlsx,pdf,ppt,pptx.',
           
        ];
    }
}
