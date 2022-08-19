<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioSenhaUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->check()) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'senha' => 'required|max:30|min:5',
            'confirmar_senha' => 'required|max:30|min:5',
        ];
    }

    public function messages()
    {
        return [
            'senha.required'  => 'É necessario informar a senha do usuário',
            'senha.max'  => 'Senha muito grande',
            'senha.min'  => 'Senha muito pequeno',
            //
            'confirmar_senha.required'  => 'É necessario informar a senha do usuário',
            'confirmar_senha.max'  => 'Senha muito grande',
            'confirmar_senha.min'  => 'Senha muito pequeno',
        ];
    }
}
