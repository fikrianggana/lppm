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
            'pro_namapenulis' => ['required'],
            'pro_judulprogram' => ['required'],
            'pro_judulpaper' => ['required'],
            'pro_kategori' => ['required'],
            'pro_penyelenggara' => ['required'],
            'pro_waktuterbit'=> ['required', 'date'] ,
            'pro_tempatpelaksanaan',
            'pro_keterangan',
            'pgn_id',
        ];
    }
}