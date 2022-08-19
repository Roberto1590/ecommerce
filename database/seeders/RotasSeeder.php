<?php

namespace Database\Seeders;

use App\Models\Rotas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /**
         * ------------------- MENUS PAI -------------------
         * 1  -> Sistema
         * 5  -> Gerenciamento
         * 10 -> Comercio
         * ------------------- MENUS ID -------------------
         * 1  -> Sistema
         * 21 -> Usuarios
         * 41 -> Marcas
         * 42 -> Categorias
         * 43 -> Produtos
         * ------------ Entendendo estrutura ------------
         * id                     -> Id da rota (Usado para gerenciar a permissão)
         * Descricão              -> Nome da rota
         * Rota                   -> Rota do menu
         * controller_principal   -> Controlador index do menu   (Usado para view principal)
         * controller_secundario  -> Controlador index do menu   (Usado para view de update)
         * controller_get         -> Controlador GET da rota     (Usado para entregar dados)
         * controller_post        -> Controlador POST da rota    (Usado para inserir)
         * controller_put         -> Controlador PUT do menu     (Usado para atualizar)
         * controller_delete      -> Controlador para deletar    (Usado para deletar)
         * controller_restore     -> Controlador para restaurar  (Usado para restaurar)
         */

        // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/sistema',
            'controller_index'              => '\SistemaController@index',
            'controller_get'                => '\SistemaController@getByID',
            'controller_post'               => '\SistemaController@inserirPost',
            'controller_put'                => '\SistemaController@atualizarPost',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 1,  // Sistema
            'menu'                          => 1, // Sistema
        ]);
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/sistema/inserir',
            'controller_index'              => '\SistemaController@inserirGet',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 1,  // Sistema
            'menu'                          => 1, // Sistema
        ]);
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/sistema/atualizar',
            'controller_index'              => '\SistemaController@atualizarGet',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 1,  // Sistema
            'menu'                          => 1, // Sistema
        ]);
        // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/gerenciamento/usuarios',
            'controller_index'              => '\UserController@index',
            'controller_get'                => '\UserController@get',
            'controller_post'               => '\UserController@inserir',
            'controller_put'                => '\UserController@atualizar',
            'controller_delete'             => '\UserController@deletar',
            'controller_restore'            => '\UserController@restaurar',
            'menu_pai'                      => 5,  // Gerenciamento
            'menu'                          => 21, // usuarios
        ]);

        Rotas::factory()->create([
            'descricao'                     => 'Usuarios Atualizar',
            'rota'                          => '/dashboard/gerenciamento/usuarios/atualizar',
            'controller_index'              => '\UserController@indexUpdate',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 5,  // Gerenciamento
            'menu'                          => 21, // usuarios
        ]);

        Rotas::factory()->create([
            'descricao'                     => 'Usuarios Inserir',
            'rota'                          => '/dashboard/gerenciamento/usuarios/inserir',
            'controller_index'              => '\UserController@indexInserir',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 5,  // Gerenciamento
            'menu'                          => 21, // usuarios
        ]);

        // // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/comercio/marcas',
            'controller_index'              => '\ProdutoController@marcaIndex',
            'controller_get'                => '\ProdutoController@marcaGet',
            'controller_post'               => '\ProdutoController@marcaInserir',
            'controller_put'                => '\ProdutoController@marcaAtualizar',
            'controller_delete'             => '\ProdutoController@marcaDeletar',
            'controller_restore'            => '\ProdutoController@marcaRestaurar',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 41, // Marcas
        ]);
        // // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Usuarios',
            'rota'                          => '/dashboard/comercio/categorias-pai',
            'controller_index'              => '\ProdutoController@categoriaPaiIndex',
            'controller_get'                => '\ProdutoController@categoriaPaiGet',
            'controller_post'               => '\ProdutoController@categoriaPaiInserir',
            'controller_put'                => '\ProdutoController@categoriaPaiAtualizar',
            'controller_delete'             => '\ProdutoController@categoriaPaiDeletar',
            'controller_restore'            => '\ProdutoController@categoriaPaiRestaurar',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 42, // Categorias
        ]);
        // // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Produtos',
            'rota'                          => '/dashboard/comercio/categorias',
            'controller_index'              => '\ProdutoController@categoriaIndex',
            'controller_get'                => '\ProdutoController@categoriaGet',
            'controller_post'               => '\ProdutoController@categoriaInserir',
            'controller_put'                => '\ProdutoController@categoriaAtualizar',
            'controller_delete'             => '\ProdutoController@categoriaDeletar',
            'controller_restore'            => '\ProdutoController@categoriaRestaurar',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 42, // Categorias
        ]);

        // // ---------------------------------------------------------------------------------------------------------------- //
        Rotas::factory()->create([
            'descricao'                     => 'Produtos',
            'rota'                          => '/dashboard/comercio/produtos',
            'controller_index'              => '\ProdutoController@produtoIndex',
            'controller_get'                => '\ProdutoController@produtoGet',
            'controller_post'               => '\ProdutoController@ProdutoInserir',
            'controller_put'                => '\ProdutoController@produtoAtualizar',
            'controller_delete'             => '\ProdutoController@produtoDeletar',
            'controller_restore'            => '\ProdutoController@produtoRestaurar',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 43, // Produtos
        ]);

        Rotas::factory()->create([
            'descricao'                     => 'Produtos Atualizar',
            'rota'                          => '/dashboard/comercio/produtos/atualizar',
            'controller_index'              => '\ProdutoController@indexUpdateProduto',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 43, // Produtos
        ]);

        Rotas::factory()->create([
            'descricao'                     => 'Produtos Inserir',
            'rota'                          => '/dashboard/comercio/produtos/inserir',
            'controller_index'              => '\ProdutoController@indexInserirProduto',
            'controller_get'                => 'not',
            'controller_post'               => 'not',
            'controller_put'                => 'not',
            'controller_delete'             => 'not',
            'controller_restore'            => 'not',
            'menu_pai'                      => 10,  // Comercio
            'menu'                          => 43, // Produtos
        ]);
    }
}
