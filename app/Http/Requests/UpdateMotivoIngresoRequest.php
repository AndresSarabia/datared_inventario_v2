<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMotivoIngresoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'descripcion' => 'required|max:128',
            'obsv' => 'nullable|max:64',
        ];
    }
    public function messages()        
    { 
        return[   
            'descripcion'=>'El campo descripción es obligatorio',   
            'obsv'=>'El campo observaciones debe ser una cadena de texto de máximo 64 caracteres'
        ];
    }
}
