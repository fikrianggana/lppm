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
            'bku_judul' => ['required', 'string'],
            'bku_penulis' => ['required', 'string'],
            'bku_editor' => ['required', 'string'],
            'bku_isbn' => ['required', 'regex:/^\d{3}-\d{3}-\d{5}-\d-\d$/', 'unique:bukus,bku_isbn'],
            'bku_penerbit' => ['required', 'string'],
            'bku_tahun' => ['required', 'numeric', 'digits:4'],
            'usr_id' => ['required'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'bku_judul.required' => 'Judul buku wajib diisi.',
            'bku_penulis.required' => 'Penulis buku wajib diisi.',
            'bku_editor.required' => 'Editor buku wajib diisi.',
            'bku_isbn.required' => 'ISBN wajib diisi.',
            'bku_isbn.regex' => 'Format ISBN tidak valid. Gunakan format XXX-XXX-XXXXX-X-X.',
            'bku_isbn.unique' => 'ISBN sudah digunakan.',
            'bku_penerbit.required' => 'Penerbit buku wajib diisi.',
            'bku_tahun.required' => 'Tahun terbit buku wajib diisi.',
            'bku_tahun.numeric' => 'Tahun terbit buku harus berupa angka.',
            'bku_tahun.digits' => 'Tahun terbit buku harus terdiri dari 4 digit.',
        ];
    }
}
