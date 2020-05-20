<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'title' => 'required',
            'start_date' => 'required|after_or_equal:start_date',
        ];
    }

    public function messages()
    {
        return 
        [
            'title.required' => 'Ingrese el titulo de la cita',
            'start_date.required' => 'Ingrese la fecha de la cita',
            'start_date.after_or_equal' => 'La fecha ingresada no es valida',
        ];
    }
}
