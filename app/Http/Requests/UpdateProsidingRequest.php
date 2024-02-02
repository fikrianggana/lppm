<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProsidingRequest extends FormRequest
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
            'pro_namapenulis' => ['required'],
            'pro_judulprogram' => ['required'],
            'pro_judulpaper' => ['required'],
            'pro_kategori' => ['required'],
            'pro_penyelenggara' => ['required'],
            'pro_waktuterbit'=> ['required', 'date'] ,
            'pro_tempatpelaksanaan' => ['required'],
            'pro_keterangan' => ['required'],
            'usr_id' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'pro_namapenulis.required' => 'Nama Penulis wajib diisi.',
            'pro_judulprogram.required' => 'Judul Program wajib diisi.',
            'pro_judulpaper.required' => 'Judul Paper wajib diisi.',
            'pro_kategori.required' => 'Kategori wajib diisi.',
            'pro_penyelenggara.required' => 'Penyelenggara wajib diisi.',
            'pro_waktuterbit.required' => 'Waktu Terbit wajib diisi.',
            'pro_tempatpelaksanaan.required' => 'Tempat Pelaksanaan wajib diisi.',
            'pro_keterangan.required' => 'Keterangan wajib diisi.',
           
        ];
    }
    
}
