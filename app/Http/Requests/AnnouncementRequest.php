<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'title'=>'required|max:20',
            'body'=>'required|min:10|max:200',
        ];
    }

    
    public function messages()
    {
        return [
            'title.required'=>'Inserisci un titolo',
            'title.max'=>'Il titolo non può contenere più di 20 caratteri',
            'body.required'=>'Inserisci l\'annuncio',
            'body.min'=>'L\'annuncio deve contenere almeno 10 caratteri',
            'body.max'=>'L\'annuncio non può contenere più di 200 caratteri',
        ];
    }
}
