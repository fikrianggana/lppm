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
            'hpt_id',
            'hpt_namalengkap',
            'hpt_judul',
            'hpt_nopemohonan',
            'hpt_tglpelaksanaan',
            'hpt_tglpenerimaan',
            'hpt_status',
            'pgn_id'
        ];
    }
}
