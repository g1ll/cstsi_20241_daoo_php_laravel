<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorStoreRequest extends FormRequest
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
            "nome"=>"required | string",
            "email"=>"required | email | unique:fornecedores",
            "cnpj" =>"required | string | unique:fornecedores",
            "estado_id"=>"required | integer",
            "telefone" => "required | string",
            "endereco" => "required | string",
        ];
    }
}

