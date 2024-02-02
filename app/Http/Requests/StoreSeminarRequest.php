<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSeminarRequest extends FormRequest
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
            'smn_namapenulis' => ['required'],
            'smn_kategori'  => ['required'],
            'smn_penyelenggara'  => ['required'],
            'smn_waktu'  => ['required'],
            'smn_tempatpelaksaan'  => ['required'],
            'smn_keterangan'  => ['required'],
            'usr_id'  => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'smn_namapenulis.required' => 'Nama Penulis wajib diisi.',
            'smn_kategori.required' => 'Kategori wajib diisi.',
            'smn_penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'smn_waktu.required' => 'Waktu wajib diisi.',
            'smn_tempatpelaksaan.required' => 'Tempat Pelaksanaan wajib diisi.',
            'smn_keterangan.required' => 'Keterangan wajib diisi.',

           
        ];
    }
}
