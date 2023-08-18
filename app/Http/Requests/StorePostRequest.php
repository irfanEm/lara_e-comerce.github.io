<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

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
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
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
}
