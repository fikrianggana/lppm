<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHakPatenRequest extends FormRequest
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
            'hpt_id' => ['required'],
            'hpt_namalengkap'=> ['required'],
            'hpt_judul'=> ['required'],
            'hpt_nopemohonan',
            'hpt_tglpelaksanaan',
            'hpt_tglpenerimaan',
            'hpt_status',
            'pgn_id'
        ];
    }
}
