<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUnidadMedidaRequest extends FormRequest
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
            'descripcion' =>'required|max:45',
            'abreviatura' =>'required|max:8', 
        ];
    }
    public function messages()    
    {
        return[   
            'descripcion'=>'El campo descripción es obligatorio',
            'abreviatura'=>'El campo abreviatura es obligatorio',
        ];
    }
}
