<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeVentasRequest extends FormRequest
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
            'fecha_hora' => 'required|date',
            'impuesto' => 'required|numeric',
            'total' => 'required|numeric',
            'cliente_id' => 'required|integer|exists:clientes,id',
            'user_id' => 'required|integer|exists:users,id',
            'comprobante_id' => 'required|integer|exists:comprobantes,id',
            'numero_comprobante' => 'required|string|max:255',
        ];
    }
}
