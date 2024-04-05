<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProductoRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo' => ['required', 'string', 'max:50', 'unique:productos,codigo'],
            'nombre' => ['required', 'string', 'max:80', 'unique:productos,nombre'],
            'descripcion' => ['nullable', 'string', 'max:255'],
            'fecha_vencimiento' => ['nullable', 'date'],
            'imagen' => ['nullable', 'string', 'max:2048', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'],
            'marca_id' => ['required', 'integer', 'exists:marcas,id'],
            'presentacione_id' => ['required', 'integer', 'exists:presentaciones,id'],
            'categorias' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'codigo' => 'Código',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'fecha_vencimiento' => 'Fecha de Vencimiento',
            'imagen' => 'Imagen',
            'marca_id' => 'Marca',
            'presentacione_id' => 'Presentación',
            'categorias' => 'Categorías',
        ];
    }
}
