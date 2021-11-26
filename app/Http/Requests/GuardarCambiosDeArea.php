<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarCambiosDeArea extends FormRequest
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
            "nombre" => "required|max:255",
            "id" => "required|numeric",
            "telefono" => "required|max:255",
            "correo" => "required|max:255",
            "direccion" => "required|max:255",
            "contacto" => "required|max:255",
        ];
    }
}
