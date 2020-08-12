<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProduct extends FormRequest
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
          'id'          =>'required|exists:products,id',
          'name'        =>'required',
          'descripcion' =>'required',
          'habilitado'  =>'required',
          'precio'      =>'required|numeric|min:0.1|max:999999.99',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'id.required'           =>'El id es requerido.',
            'id.exists'             =>'No existe el producto.',
            'name.required'         =>'El nombre es requerida.',
            'habilitado.required'   =>'La descripcion es requerida',
            'descripcion.required'  =>'La descripcion es requerida',
            'precio.required'       =>'El precio es requerido.',
            'precio.numeric'        =>'Ingrese numero.',
            'precio.min'            =>'El valor minimo es de 0.1.',
            'precio.max'            =>'El valor maximo es de 999999.99.',
        ];
    }
}
