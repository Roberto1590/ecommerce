<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioCreateUpdateRequest;
use App\Http\Requests\UsuarioSenhaUpdateRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use App\Models\Contato;
use App\Models\ContatoUsuario;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class UserController extends Controller
{

    public function index(Request $request)
    {

        $usuario = ContatoUsuario::where('user_id', '<>', auth()->user()->id)->get();
        foreach ($usuario as $user) {
            $user->usuario;
        }
        $usuariosDeletado = User::onlyTrashed()->get();
        return view('auth.admin.gerenciamento.usuarios.usuarios', compact('usuario', 'usuariosDeletado'));
    }

    public function indexInserir()
    {
        return view('auth.admin.gerenciamento.usuarios.inserir');
    }

    public function indexUpdate(Request $request)
    {
        $usuario  = ContatoUsuario::where('user_id', $request->id)->first();
        if (!$usuario || $usuario->user_id == auth()->user()->id) {
            return false;
        }
        $usuario->usuario;
        return view('auth.admin.gerenciamento.usuarios.atualizar', compact('usuario'));
    }

    public function inserir(UsuarioCreateUpdateRequest $request)
    {
        // Inserindo USER
        $usuario           = new User();
        $usuario->name     = $request->input('nome');
        $usuario->email    = $request->input('email');
        $usuario->password = bcrypt(FunctionsController::gerar_senha(6, $request->input('nome'), false, true, false, false));
        $usuario->save();

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if (
                File::exists(public_path(str_replace('../', '', $usuario->path_perfil)))
            ) {
                File::delete(public_path(str_replace('../', '', $usuario->path_perfil)));
            }
            $imagemRequest = $request->imagem;
            $extensao = $imagemRequest->extension();
            $nomeImagem = md5($imagemRequest->getClientOriginalName() . strtotime('now')) . "." . $extensao;
            $request->imagem->move(public_path('app/usuarios/' . $usuario->id . '/images/'), $nomeImagem);
            $usuario->path_perfil       = '../app/usuarios/' . $usuario->id . '/images/' . $nomeImagem;
            $usuario->save();
        }

        // Inserindo Contato do User
        $contato                     = new ContatoUsuario();
        $contato->user_id            = $usuario->id;
        $contato->cpf                = $request->cpf;
        $contato->sexo               = $request->sexo;
        $contato->telefone_comercial = $request->telefone_comercial;
        $contato->telefone_celular   = $request->telefone_celular;
        $contato->sexo               = ($request->sexo == '1') ? 1 : 0;
        $contato->save();
        //
        return redirect()->back()->with('msgSuccess', 'Usuário inserido com sucesso');
    }

    public function get($id)
    {
        $contato = ContatoUsuario::find($id);
        if (!$contato) {
            return false;
        }
        $contato->usuario;
        return $contato;
    }

    public function atualizar(UsuarioUpdateRequest $request)
    {
        // Inserindo USER
        // return ($request);
        $usuario           = User::find($request->input('id'));
        $usuario->name     = $request->input('nome');
        $usuario->email    = $request->input('email');
        //
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if (
                File::exists(public_path(str_replace('../', '', $usuario->path_perfil)))
            ) {
                File::delete(public_path(str_replace('../', '', $usuario->path_perfil)));
            }
            $imagemRequest = $request->imagem;
            $extensao = $imagemRequest->extension();
            $nomeImagem = md5($imagemRequest->getClientOriginalName() . strtotime('now')) . "." . $extensao;
            $request->imagem->move(public_path('app/usuarios/' . $usuario->id . '/images/'), $nomeImagem);
            $usuario->path_perfil       = '../app/usuarios/' . $usuario->id . '/images/' . $nomeImagem;
        }
        // imagem pro banco

        $usuario->save();

        // Inserindo Contato do User
        $contato                     = ContatoUsuario::where('user_id', $request->input('id'))->first();
        $contato->cpf                = $request->input('cpf');
        $contato->telefone_comercial = $request->input('telefone_comercial');
        $contato->telefone_celular   = $request->input('telefone_celular');
        $contato->save();
        //
        return redirect()->back()->with('msgSuccess', 'Usuário atualizado com sucesso');
    }

    public function atualizarSenha(UsuarioSenhaUpdateRequest $request)
    {
        try {
            // Inserindo USER
            $usuario            = User::find($request->input('id'));
            $usuario->password  = $request->input('senha');
            $usuario->save();
            //
            return redirect()->back()->with('msgSuccess', 'Senha do usuário atuaizado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function deletar(Request $request)
    {

        if ($request->id == auth()->user()->id) {
            return false;
        }
        ContatoUsuario::where('user_id', $request->id)->delete();
        User::find($request->id)->delete();
        //
        return redirect()->back()->with('msgSuccess', 'Usuário deletado com sucesso');
    }

    public function restaurar(Request $request)
    {
        if ($request->id == auth()->user()->id) {
            return false;
        }
        ContatoUsuario::where('user_id', $request->id)->restore();
        User::where('id', $request->id)->restore();
        return redirect()->back()->with('msgSuccess', 'Usuário restaurado com sucesso');
    }
}
