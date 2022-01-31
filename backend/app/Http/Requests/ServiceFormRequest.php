<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceFormRequest extends FormRequest
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
            'dificulty' => 'required',
            'value' => 'required|numeric'
        ];
    }

    public function messages ()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'dificulty.required' => 'O campo dificuldade é obrigatório',
            'value.required' => 'O campo valor é obrigatório',
            'value.numeric' => 'O campo valor deve ser numérico',
            'name.required' => 'O campo nome deve possuir ao menos 3 letras',
        ];
    }
}
