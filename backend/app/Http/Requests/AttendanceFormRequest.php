<?php

namespace App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AttendanceFormRequest extends FormRequest
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
        $today = Carbon::now()->startOfDay();
        return [
            'hour' => 'required',
            'dateservice' => 'required|date|after:today'
        ];
    }
    public function messages ()
    {
        return [
            'hour.required' => 'O campo hora é obrigatório',
            'dateservice.required' => 'O campo data é obrigatório',
            'dateservice.date' => 'A data marcada deve ser a partir de amanhã'
        ];
    }
}
