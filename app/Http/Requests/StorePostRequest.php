<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;


class StorePostRequest extends FormRequest
{
    /**
     * memberikan indikasi bahwa validator harus berhenti memvalidasi jika
     * terjadi kegagalan pada validasi pertama
     * 
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * URl dimana user akan dialihkan ketika terjadi kegagaln validasi
     * 
     * @var string
     */
    protected $redirectRoute = 'dashboard';

    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return true;
    // }
    /**
     * Menentukan apakah user ini memiliki otorisasi untuk melakukan request ini.
     */
    public function authorize(): bool 
    {
        // $comment = Comment::find($this->route('comment'));
        return $this->user()->can('update', $this->comment);
    }
    /**
     * Get the validation rules that apply to the request.
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|unique:posts|max:255',
            'body' => 'required'
        ];
    }

    /**
     * siapkan validasi "after" yang dapat dipanggil untuk request ini
     */
    public function after():array {
        return[

            function(Validator $validator) {    //callables methods
                if($this->somethingElseIsInvalid()) {
                    $validator->errors()->add(
                        'field',
                        'Ada sesuatu yang salah pada bidang ini.'
                    );
                }
            }
        ];
    }

    /**
     * Dapatkan pesan error untuk rules validasi yang didefinisikan
     * 
     * @return array<string, string>
     */
    
    public function messages(): array
    {
        return [
            'title.required' => 'Judul dibutuhkan',
            'post.required' => 'Post dibutuhkan'
        ];
    }

    /**
     * Dapatkan attribute custom untuk error validasi
     * 
     * @return array <string, string>
     */
    public function attributes(): array
    {
        return [
            'email' => 'alamat email',
        ];
    }

    /**
     * Persiapkan data untuk validasi
     */
    protected function prepareForValidation(): void
    {
        $this->merger([
            'slug' => Str::slug($this->slug),
        ]);
    }

    /**
     * menangani usaha validasi yang gagal
     */
    protected function passedValidation(): void
    {
        $this->replace(['name' => 'Taylor']);
    }
}
