<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProduct extends FormRequest
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
            'name'        =>'required|unique:products,name',
            'descripcion' =>'required|unique:products,descripcion',
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
            'name.required'        =>'El nombre es requerido.',
            'name.unique'          =>'Ya existe ee producto.',
            'descripcion.required' =>'La descripcion es requerida.',
            'descripcion.unique'   =>'Ya existe esa descripcion, probablemente el producto tambien.',
            'precio.required'      =>'El precio es requerido.',
            'precio.numeric'        =>'Ingrese numero.',
            'precio.min'            =>'El valor minimo es de 0.1.',
            'precio.max'            =>'El valor maximo es de 999999.99.',
        ];
    }
}
