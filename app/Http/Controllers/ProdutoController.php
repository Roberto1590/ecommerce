<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoriaCreateUpdateRequest;
use App\Http\Requests\CategoriaPaiCreateUpdateRequest;
use App\Http\Requests\MarcaCreateUpdateRequest;
use App\Http\Requests\ProdutoCreateUpdateRequest;
use App\Models\Categoria;
use App\Models\CategoriasPai;
use App\Models\Marcas;
use App\Models\Produtos;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * View de marca
     */
    public function marcaIndex()
    {
        $marcas = Marcas::all();
        $marcasDeletado = Marcas::onlyTrashed()->get();

        return view('auth.admin.comercio.marcas.marca', compact('marcas', 'marcasDeletado'));
    }

    /**
     * Inserir Marca
     */
    public function marcaInserir(MarcaCreateUpdateRequest $request)
    {
        try {
            // Inserindo USER
            $marca            = new Marcas();
            $marca->nome      = $request->input('nome');
            $marca->meta_link = $request->input('meta_link');
            $marca->save();
            //
            return redirect()->back()->with('msgSuccess', 'Marca inserida com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get marca por ID
     */
    public function marcaGet($id)
    {
        try {
            // Inserindo USER
            $marca        = Marcas::where('id', $id)->first();
            if (!$marca) {
                return false;
            }
            //
            return $marca;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Restaura Marca
     */
    public function marcaRestaurar(Request $request)
    {
        try {
            Marcas::where('id', $request->id)->restore();
            return redirect()->back()->with('msgSuccess', 'Marca restaurado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Deleta Marca
     */
    public function marcaDeletar(Request $request)
    {
        try {
            Marcas::where('id', $request->id)->delete();
            //
            return redirect()->back()->with('msgSuccess', 'Marca deletado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Atualiza Marca
     */
    public function marcaAtualizar(MarcaCreateUpdateRequest $request)
    {
        try {
            // Inserindo USER
            $marca            = Marcas::find($request->input('id'));
            $marca->nome      = $request->input('nome');
            $marca->meta_link = $request->input('meta_link');
            $marca->save();
            //
            return redirect()->back()->with('msgSuccess', 'Marca atualizada com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // --------------------------------------------------------------------------------------- //
    /**
     * View de categoria pai
     */
    public function categoriaPaiIndex()
    {
        $cat = CategoriasPai::all();
        $catDeletado = CategoriasPai::onlyTrashed()->get();

        return view('auth.admin.comercio.categoriasPai.categoriasPai', compact('cat', 'catDeletado'));
    }

    /**
     * Inserir Categoria Pai
     */
    public function categoriaPaiInserir(CategoriaPaiCreateUpdateRequest $request)
    {
        try {
            // Inserindo USER
            $cat            = new CategoriasPai();
            $cat->nome      = $request->input('nome');
            $cat->meta_link = $request->input('meta_link');
            $cat->save();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria pai inserida com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get categoria pai por ID
     */
    public function categoriaPaiGet($id)
    {
        try {
            // Inserindo USER
            $cat        = CategoriasPai::where('id', $id)->first();
            if (!$cat) {
                return false;
            }
            //
            return $cat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Restaurar categoria pai
     */
    public function categoriaPaiRestaurar(Request $request)
    {
        try {
            CategoriasPai::where('id', $request->id)->restore();
            return redirect()->back()->with('msgSuccess', 'Categoria pai restaurado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Deleta categoria pai
     */
    public function categoriaPaiDeletar(Request $request)
    {
        try {
            CategoriasPai::where('id', $request->id)->delete();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria pai deletado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Atualiza categoria pai
     */
    public function categoriaPaiAtualizar(CategoriaPaiCreateUpdateRequest $request)
    {
        try {
            // Inserindo USER
            $cat            = CategoriasPai::find($request->input('id'));
            $cat->nome      = $request->input('nome');
            $cat->meta_link = $request->input('meta_link');
            $cat->save();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria pai atualizada com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // --------------------------------------------------------------------------------------- //

    /**
     * View de categoria
     */
    public function categoriaIndex()
    {
        $cat = Categoria::all();
        $catDeletado = Categoria::onlyTrashed()->get();

        if ($cat) {
            foreach ($cat as $c) {
                $c['categoria_pai'] = $c->categoriaPai;
            }
        }
        // return $cat[0]['categoria_filha']->nome;
        $catPais = CategoriasPai::all();

        return view('auth.admin.comercio.categoria.categorias', compact('cat', 'catDeletado', 'catPais'));
    }

    /**
     * Inserir Categoria
     */
    public function categoriaInserir(CategoriaCreateUpdateRequest $request)
    {
        try {
            // Inserindo
            $cat                    = new Categoria();
            $cat->categoria_pai_id  = $request->input('categoria_pai_id');
            $cat->nome              = $request->input('nome');
            $cat->meta_link         = $request->input('meta_link');
            $cat->save();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria inserida com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get categoria por ID
     */
    public function categoriaGet($id)
    {
        try {
            // Buscando
            $cat        = Categoria::where('id', $id)->first();
            if (!$cat) {
                return false;
            }
            //
            $cat->categoriaPai;
            return $cat;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Restaurar categoria
     */
    public function categoriaRestaurar(Request $request)
    {
        try {
            Categoria::where('id', $request->id)->restore();
            $categoria = Categoria::where('id', $request->id)->first();
            CategoriasPai::where('id', $categoria->categoria_pai_id)->restore();
            return redirect()->back()->with('msgSuccess', 'Categoria restaurada com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Deleta categoria
     */
    public function categoriaDeletar(Request $request)
    {
        try {
            $categoria = Categoria::find($request->id);
            CategoriasPai::where('id', $categoria->categoria_pai_id)->delete();
            Categoria::find($request->id)->delete();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria deletado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Atualiza categoria
     */
    public function categoriaAtualizar(CategoriaCreateUpdateRequest $request)
    {
        try {
            // Atualizando
            $cat                    = Categoria::find($request->input('id'));
            $cat->categoria_pai_id  = $request->input('categoria_pai_id');
            $cat->nome              = $request->input('nome');
            $cat->meta_link         = $request->input('meta_link');
            $cat->save();
            //
            return redirect()->back()->with('msgSuccess', 'Categoria atualizada com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    // --------------------------------------------------------------------------------------- //

    /**
     * View de Produtos
     */
    public function produtoIndex()
    {
        $produto = Produtos::all();
        $produtoDeletado = Produtos::onlyTrashed()->get();

        if ($produto) {
            foreach ($produto as $prod) {
                $prod->categoria;
                $prod->marca;
            }
        }

        return view('auth.admin.comercio.produto.produtos', compact('produto', 'produtoDeletado'));
    }

    /**
     * View de inserir Produtos
     */
    public function indexInserirProduto()
    {
        $marcas     = Marcas::all();
        $categorias = Categoria::all();

        return view('auth.admin.comercio.produto.inserir', compact('marcas', 'categorias'));
    }

    /**
     * View de inserir Produtos
     */
    public function indexUpdateProduto(Request $request)
    {
        $produto = Produtos::find($request->id);

        if (!$produto) {
            return false;
        }
        foreach ($produto as $prod) {
            $prod->categoria;
            $prod->marca;
        }
        $marcas     = Marcas::all();
        $categorias = Categoria::all();

        return view('auth.admin.comercio.produto.inserir', compact('produto', 'categorias', 'marcas', 'categorias'));
    }

    /**
     * Inserir Produto
     */
    public function ProdutoInserir(ProdutoCreateUpdateRequest $request)
    {
        try {

            return redirect()->back()->with('msgSuccess', 'Produto inserido com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Get produto por ID
     */
    public function produtoGet($id)
    {
        try {
            // Buscando
            $produto        = Produtos::where('id', $id)->first();
            if (!$produto) {
                return false;
            }
            //
            $produto->categoriaPai;
            return $produto;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Restaurar produto
     */
    public function produtoRestaurar(Request $request)
    {
        try {
            Produtos::where('id', $request->id)->restore();
            return redirect()->back()->with('msgSuccess', 'Produto restaurado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Deleta produto
     */
    public function produtoDeletar(Request $request)
    {
        try {
            Produtos::find($request->id)->delete();
            //
            return redirect()->back()->with('msgSuccess', 'Produto deletado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Atualiza categoria
     */
    public function produtoAtualizar(ProdutoCreateUpdateRequest $request)
    {
        try {

            return redirect()->back()->with('msgSuccess', 'Produto atualizado com sucesso');
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
