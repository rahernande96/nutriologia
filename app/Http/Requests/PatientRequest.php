<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'birthdate' => 'required',
            'phone_1' => 'required',
            'email' => 'required|unique:patients',
           // 'weight' => 'required',
            'gender' => 'required',
            // 'size' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Ingrese el nombre del paciente',
            'address.required' => 'Ingrese la dirección del paciente',
            'city.required' => 'Ingrese la ciudad del paciente',
            'birthdate.required' => 'Ingrese la fecha de nacimiento del paciente',
            'phone_1.required' => 'Ingrese el número de telefono del paciente',
            'email.required' => 'Ingrese el correo electrónico del paciente',
            'email.unique' => 'Otro paciente ya ha registrado este correo electrónico, ingrese uno nuevo',
            //'weight.unique' => 'Ingrese el peso del paciente',
            'gender.required' => 'Ingrese el género del paciente',
            //'size.required' => 'Ingrese la talla del paciente'
        ];
    }
}
