<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJurnalRequest extends FormRequest
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
            'jrn_judulmakalah'  => ['required'],
            'jrn_namajurnal'  => ['required'],
            'jrn_namapersonil'  => ['required'],
            'jrn_issn'  => ['required'],
            'jrn_volume'  => ['required'],
            'jrn_nomor'  => ['required'],
            'jrn_halamanawal'  => ['required'],
            'jrn_halamanakhir'  => ['required'],
            'jrn_url'  => ['required'],
            'jrn_kategori'  => ['required'],
            'usr_id'  => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'jrn_judulmakalah.required' => 'Judul Makalah wajib diisi.',
            'jrn_namajurnal.required' => 'Nama Jurnal wajib diisi.',
            'jrn_namapersonil.required' => 'Nama Personil wajib diisi.',
            'jrn_issn.required' => 'ISSN wajib diisi.',
            'jrn_volume.required' => 'Volume wajib diisi.',
            'jrn_nomor.required' => 'Nomor wajib diisi.',
            'jrn_halamanawal.required' => 'Halaman Awal wajib diisi.',
            'jrn_halamanakhir.required' => 'Halaman Akhir wajib diisi.',
            'jrn_url.required' => 'URL wajib diisi.',
            'jrn_kategori.required' => 'Kategori wajib diisi.',
        ];
    }
}
