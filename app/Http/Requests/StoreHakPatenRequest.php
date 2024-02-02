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
            'hpt_namalengkap' => ['required'],
            'hpt_judul' => ['required'],
            'hpt_nopemohonan' => ['required'],
            'hpt_tglpelaksanaan' => ['required'],
            'hpt_tglpenerimaan' => ['required'],
            'hpt_status' => ['required'],
            'usr_id' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'hpt_namalengkap.required' => 'Nama Lengkap wajib diisi.',
            'hpt_judul.required' => 'Judul wajib diisi.',
            'hpt_nopemohonan.required' => 'No Permohonan wajib diisi.',
            'hpt_tglpelaksanaan.required' => 'Tanggal Pelaksanaan wajib diisi.',
            'hpt_tglpenerimaan.required' => 'Tanggal Penerimaan wajib diisi.',
            'hpt_status.required' => 'Status wajib diisi.',
        ];
    }
}
