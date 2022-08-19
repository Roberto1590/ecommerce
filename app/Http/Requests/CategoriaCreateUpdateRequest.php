<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaCreateUpdateRequest extends FormRequest
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
            'categoria_pai_id' => 'required',
            'nome'             => 'required',
            'meta_link'        => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required'             => 'É necessario informar o nome',
            'meta_link.required'        => 'É necessario informar o meta link',
            'categoria_pai_id.required' => 'É necessario informar a categoria pai',
        ];
    }
}
