<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistroFormRequest extends FormRequest
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
            'nombre' => 'required',
            'email' => 'required|unique:usuarios',
            'contrasena' => 'required|confirmed'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required'=> 'El nombre es requerido',
            'email.required' => 'El email es requerido',
            'contrasena.required' => 'La contraseña es requerido',
            'contrasena.confirmed' => 'Por favor verifica tu contraseña',
            'email.unique' => 'El email que ingresaste ya esta registrado'
        ];
    }
}
