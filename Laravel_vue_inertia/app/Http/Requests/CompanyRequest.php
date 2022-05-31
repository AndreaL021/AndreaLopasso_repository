<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'business_email'=>'required|max:50|email',
            'business_email' => 'unique:App\Models\Company,business_email',
            'business_name'=>'required|max:50', 
            'address'=>'required|max:50', 
            'cap'=>'required|size:5', 
            'city'=>'required|max:50', 
            'province'=>'required|max:50', 
            'region'=>'required|max:50'
        ];
    }

    public function messages()
    {
        return [
            'business_email'=>'I',
            'business_name'=>'errore',
            'address'=>'errore',
            'cap.required'=>'Inserire un CAP valido',
            'cap.size'=>'Inserire un CAP valido',
            'city'=>'errore',
            'province'=>'errore',
            'region'=>'errore',
        ];
    }
}
