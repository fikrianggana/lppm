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
            'pgn_id'  => ['required'],
            'smn_atribut' => ['required']
        ];
    }
}
