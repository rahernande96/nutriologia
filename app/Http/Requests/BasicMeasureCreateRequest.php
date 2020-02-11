<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasicMeasureCreateRequest extends FormRequest
{
    public function messages()
    {
        return 
        [
            'size.required' => 'La talla es requerida',
            'weight.required' => 'El peso es requerido',
            'imc.required' => 'El IMC es requerido',
            'pregnancy.required' => 'Debe seleccionar si existe embarazo',
        ];
    }
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
            'size'      => 'required',
            'weight'    => 'required',
            'imc'       => 'required',
            'pregnancy' => 'required'
        ];
    }
}
