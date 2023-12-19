<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
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
            'bk_judul' => ['required'],
            'bk_penulis' => ['required'],
            'bk_editor' => ['required'],
            'bk_isbn',
            'bk_penerbit',
            'bk_tahun',
            'pgn_id',
        ];
    }
}