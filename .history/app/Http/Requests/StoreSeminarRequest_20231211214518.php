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
            'smn_id',
            'smn_namapenulis',
            'smn_kategori',
            'smn_penyelenggara',
            'smn_waktu',
            'smn_tempatpelaksaan',
            'smn_keterangan',
            'pgn_id',
            'smn_atribut',
        ];
    }
}
