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
            'jrn_id' -
            'jrn_judulmakalah',
            'jrn_namajurnal',
            'jrn_namapersonil',
            'jrn_issn',
            'jrn_volume',
            'jrn_nomor',
            'jrn_halamanawal',
            'jrn_halamanakhir',
            'jrn_url',
            'jrn_kategori',
            'pgn_id',
            'jrn_atribut',
        ];
    }
}