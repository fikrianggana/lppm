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
            'bku_judul' => ['required'],
            'bku_penulis' => ['required'],
            'bku_editor' => ['required'],
            'bku_isbn' => ['required', 'regex:/^\d{3}-\d{3}-\d{5}-\d-\d$/'],
            'bku_penerbit' => ['required'],
            'bk_tahun' => ['required'],
            'pgn_id' => ['required'],
        ];
    }
}
