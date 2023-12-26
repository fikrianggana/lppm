<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBukuRequest extends FormRequest
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
        $bku_id = $this->input('bku_id'); // Assuming you have 'bku_id' in your form data

        return [
            'bku_judul' => [
                'required'
            ],
            'bku_penulis' => ['required'],
            'bku_editor' => ['required'],
            'bku_isbn' => ['required', 'regex:/^\d{3}-\d{3}-\d{5}-\d-\d$/'],
            'bku_penerbit' => ['required'],
            'bku_tahun' => ['required', 'numeric', 'digits:4'],
            'usr_id' => ['required'],

        ];
    }
}
