<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GuardarResponsableRequest extends FormRequest
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
            "direccion" => "required|max:255",
            "areas_id" => "required|exists:areas,id",//Requerido y que exista en áreas, columna id :)
        ];
    }

    public function all($keys = null)
    {
        
        if (empty($keys)) {
            return parent::json()->all();
        }

        return collect(parent::json()->all())->only($keys)->toArray();
    }


}
