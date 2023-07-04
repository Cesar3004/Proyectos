<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'nombre'=>'required|max:200',
            'apellido'=>'required|max:200',
            'tipo_documento'=>'required|max:20',
            'num_documento'=>'required|max:8',
            'direccion'=>'required|max:100',
            'telefono'=>'required|max:9',
            'email'=>'required|max:50'


        ];
    }
}
