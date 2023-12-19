<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengabdianMasyarakatRequest extends FormRequest
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
            'pkm_namakegiatan' => ['required'],
            'pkm_jenis' => ['required'],
            'pkm_waktupelaksanaan' => ['required'],
            'pkm_personilterlibat' => ['required'],
            'pkm_jumlahpenerimamanfaat' => ['required', 'numeric', 'min:1'],
            'pkm_buktipendukung' => ['mimes:doc,docx,pdf,xls,xlsx,pdf,ppt,pptx'],
            'pkm_mahasiswa' =>

        ];
    }
}
