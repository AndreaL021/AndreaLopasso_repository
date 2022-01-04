<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'message'=>'required|min:30|max:200',
        ];
    }

    
    public function messages()
    {
        return [
            'message.required'=>'Il messaggio è obbligatorio',
            'message.min'=>'Il messaggio deve contenere minimo 30 caratteri',
            'message.max'=>'Il messaggio deve contenere massimo 200 caratteri',
        ];
    }
}
