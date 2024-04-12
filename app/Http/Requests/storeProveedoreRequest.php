<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeProveedoreRequest extends FormRequest
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
            'tipo_persona' => ['required', 'string'],
            'direccion' => ['required', 'string', 'max:180'],
            'razon_social' => ['required', 'string', 'max:80'],
            'documento_id' => ['required', 'integer', 'exists:documentos,id'],
            'numero_documento' => ['required', 'string', 'max:20', 'unique:personas,numero_documento'],
        ];
    }
}
