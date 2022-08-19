<?php

namespace App\Http\Controllers;

use App\Http\Requests\SistemaCreateUpdateRequest;
use App\Models\Sistema;
use Exception;
use Illuminate\Http\Request;

class SistemaController extends Controller
{
    public function index()
    {
        $sistemas = Sistema::all();
        $sistemasDeletado = Sistema::onlyTrashed()->get();

        return view('auth.admin.sistema.sistema', compact('sistemas', 'sistemasDeletado'));
    }

    public function inserirGet()
    {
        return view('auth.admin.sistema.inserir');
    }

    public function inserirPost(SistemaCreateUpdateRequest $request)
    {
        try {
            // Inserindo
            $sistema                              = new Sistema();
            $sistema->sistema_razao_social        = $request->input('razao_social');
            $sistema->sistema_nome_fantasia       = $request->input('nome_fantasia');
            $sistema->sistema_cnpj                = $request->input('cnpj');
            $sistema->sistema_ie                  = $request->input('inscricao_estadual');
            $sistema->sistema_telefone_fixo       = $request->input('telefone_fixo');
            $sistema->sistema_telefone_movel      = $request->input('telefone_movel');
            $sistema->sistema_email               = $request->input('email');
            $sistema->sistema_site_url            = $request->input('url');
            $sistema->sistema_cep                 = $request->input('cep');
            $sistema->sistema_endereco            = $request->input('endereco');
            $sistema->sistema_numero              = $request->input('numero');
            $sistema->sistema_cidade              = $request->input('cidade');
            $sistema->sistema_estado              = $request->input('uf');
            $sistema->sistema_produtos_destaques  = $request->input('qntd_prod');
            $sistema->save();
            //
            return redirect()->back()->with('msgSuccess', 'Sistema inserido com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function atualizarGet(Request $request)
    {
        $sistema  = Sistema::where('id', $request->id)->first();
        if (!$sistema) {
            return false;
        }
        return view('auth.admin.sistema.atualizar', compact('sistema'));
    }
    public function atualizarPost(SistemaCreateUpdateRequest $request)
    {
        try {
            // Inserindo
            $sistema                              = Sistema::find($request->input('id'));
            $sistema->sistema_razao_social        = $request->input('razao_social');
            $sistema->sistema_nome_fantasia       = $request->input('nome_fantasia');
            $sistema->sistema_cnpj                = $request->input('cnpj');
            $sistema->sistema_ie                  = $request->input('inscricao_estadual');
            $sistema->sistema_telefone_fixo       = $request->input('telefone_fixo');
            $sistema->sistema_telefone_movel      = $request->input('telefone_movel');
            $sistema->sistema_email               = $request->input('email');
            $sistema->sistema_site_url            = $request->input('url');
            $sistema->sistema_cep                 = $request->input('cep');
            $sistema->sistema_endereco            = $request->input('endereco');
            $sistema->sistema_numero              = $request->input('numero');
            $sistema->sistema_cidade              = $request->input('cidade');
            $sistema->sistema_estado              = $request->input('uf');
            $sistema->sistema_produtos_destaques  = $request->input('qntd_prod');
            $sistema->save();
            //
            return redirect()->back()->with('msgSuccess', 'Sistema inserido com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
