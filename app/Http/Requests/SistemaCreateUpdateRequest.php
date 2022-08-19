<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SistemaCreateUpdateRequest extends FormRequest
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
            'razao_social'       => 'required',
            'nome_fantasia'      => 'required',
            'cnpj'               => 'required',
            'inscricao_estadual' => 'required',
            'telefone_fixo'      => 'required',
            'telefone_movel'     => 'required',
            'email'              => 'required|email',
            'url'                => 'required',
            'cep'                => 'required',
            'endereco'           => 'required',
            'numero'             => 'required',
            'cidade'             => 'required',
            'uf'                 => 'required',
            'qntd_prod'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'razao_social.required'             => 'É necessario informar a razão social',
            'nome_fantasia.required'            => 'É necessario informar o nome fantasia',
            'cnpj.required'                     => 'É necessario informar o cnpj',
            'inscricao_estadual.required'       => 'É necessario informar a inscrição estadual',
            'telefone_fixo.required'            => 'É necessario informar o telefone fixo',
            'telefone_movel.required'           => 'É necessario informar o telefone movel',
            'email.required'                    => 'É necessario informar o email',
            'email.email'                       => 'Email invalido',
            'url.required'                      => 'É necessario informar a URL',
            'cep.required'                      => 'É necessario informar o CEP',
            'endereco.required'                 => 'É necessario informar o endereco',
            'numero.required'                   => 'É necessario informar o numero',
            'uf.required'                       => 'É necessario informar a UF',
            'qntd_prod.required'                => 'É necessario informar a quantidade de produtos em destaque',
        ];
    }
}
