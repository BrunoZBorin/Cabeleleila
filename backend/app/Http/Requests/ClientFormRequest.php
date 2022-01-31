<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientFormRequest extends FormRequest
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
            'name' => 'required|min:3',
            'email' => 'required|unique:clients',
            'adress' => 'required',
            'zipcode' => 'required',
            'city' => 'required'
        ];
    }
    public function messages ()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'adress.required' => 'O campo endereço é obrigatório',
            'zipcode.required' => 'O campo cep é obrigatório',
            'city.required' => 'O campo cidade é obrigatório',
            'email.unique' => 'Esse email já está cadastrado',
            'name.min' => 'O campo nome precisa ter pelo menos três caracteres',

        ];
    }
}
