<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpresaCreateUpdateRequest;
use App\Models\Empresa;
use Exception;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        $empresas = Empresa::all();
        $empresasDeletado = Empresa::onlyTrashed()->get();

        return view('auth.admin.empresa.empresa', compact('empresas', 'empresasDeletado'));
    }

    public function inserirGet()
    {
        return view('auth.admin.empresa.inserir');
    }

    public function inserirPost(EmpresaCreateUpdateRequest $request)
    {
        try {
            // Inserindo
            $empresa                      = new Empresa();
            $empresa->razao_social        = $request->input('razao_social');
            $empresa->nome_fantasia       = $request->input('nome_fantasia');
            $empresa->cnpj                = $request->input('cnpj');
            $empresa->ie                  = $request->input('inscricao_estadual');
            $empresa->telefone_fixo       = $request->input('telefone_fixo');
            $empresa->telefone_movel      = $request->input('telefone_movel');
            $empresa->email               = $request->input('email');
            $empresa->site_url            = $request->input('url');
            $empresa->cep                 = $request->input('cep');
            $empresa->endereco            = $request->input('endereco');
            $empresa->numero              = $request->input('numero');
            $empresa->cidade              = $request->input('cidade');
            $empresa->estado              = $request->input('uf');
            $empresa->save();
            //
            return redirect()->back()->with('msgSuccess', 'Empresa inserido com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function atualizarGet(Request $request)
    {
        $empresa  = Empresa::where('id', $request->id)->first();
        if (!$empresa) {
            return false;
        }
        return view('auth.admin.empresa.atualizar', compact('empresa'));
    }
    public function atualizarPost(EmpresaCreateUpdateRequest $request)
    {
        try {
            // Inserindo
            $empresa                      = Empresa::find($request->input('id'));
            $empresa->razao_social        = $request->input('razao_social');
            $empresa->nome_fantasia       = $request->input('nome_fantasia');
            $empresa->cnpj                = $request->input('cnpj');
            $empresa->ie                  = $request->input('inscricao_estadual');
            $empresa->telefone_fixo       = $request->input('telefone_fixo');
            $empresa->telefone_movel      = $request->input('telefone_movel');
            $empresa->email               = $request->input('email');
            $empresa->site_url            = $request->input('url');
            $empresa->cep                 = $request->input('cep');
            $empresa->endereco            = $request->input('endereco');
            $empresa->numero              = $request->input('numero');
            $empresa->cidade              = $request->input('cidade');
            $empresa->estado              = $request->input('uf');
            $empresa->save();
            //
            return redirect()->back()->with('msgSuccess', 'Empresa inserido com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
