<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProdiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pro_namapenulis',
            'pro_judulprogram',
            'pro_judulpaper',
            'pro_kategori',
            'pro_penyelenggara',
            'pro_waktuterbit',
            'pro_tempatpelaksanaan',
            'pro_keterangan',
            'pgn_id',
        ];
    }
}
