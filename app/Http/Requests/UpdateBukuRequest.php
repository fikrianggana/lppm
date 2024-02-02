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
        
        return [
            'bku_judul' => ['required'],
            'bku_penulis' => ['required'],
            'bku_editor' => ['required'],
            'bku_isbn' => ['required', 'regex:/^\d{3}-\d{3}-\d{5}-\d-\d$/'],
            'bku_penerbit' => ['required'],
            'bku_tahun' => ['required', 'numeric', 'digits:4'],
            'usr_id' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'bku_judul.required' => 'Judul wajib diisi.',
            'bku_penulis.required' => 'Penulis wajib diisi.',
            'bku_editor.required' => 'Editor wajib diisi.',
            'bku_isbn.required' => 'ISBN wajib diisi dengan format XXXX-XXXX.',
            'bku_penerbit.required' => 'Penerbit wajib diisi.',
            'bku_tahun.digits' => 'Tahun harus terdiri dari 4 digit.',
           
        ];
    }
}
