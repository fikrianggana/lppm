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
            'jrn_id' => ['required'],
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
            'pgn_id'  => ['required'],
            'jrn_atribut'  => ['required'],
        ];
    }
}
