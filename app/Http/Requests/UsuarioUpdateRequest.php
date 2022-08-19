<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UsuarioUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'nome'               => 'required|max:80',
            'email'              => 'required|email|max:80|unique:users,email,' . $request->id . '',
            'telefone_celular'   => 'required|celular_com_ddd',
            'sexo'               => 'required|verifica_bool',
            'telefone_comercial' => 'required|telefone_com_ddd',
            'cpf'                => 'cpf|unique:contato,cpf,' . $request->contato_id . '',
        ];
    }

    public function messages()
    {
        return [
            'unique'             => 'O :attribute já existe na nossa base de dados',
            'required'           => 'O campo :attribute é obrigatório',
            'max'                => 'O campo :attribute tem muitos caracteres',
            'email'              => 'Email inválido',
            'celular_com_ddd'    => 'Celular inválido',
            'telefone_com_ddd'   => 'Telefone inválido',
            'cpf'                => 'CPF inválido',
            'sexo.verifica_bool' => 'Sexo Inválido'
        ];
    }
}
