<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Produto::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $statusHttp = 201;
        try {
            $newProduto = $request->all();
            $newProduto['importado'] = $request->has('importado');
            $storedProduto = Produto::create($newProduto);
            return response()->json([
                'message' => 'Produto inserido com sucesso',
                'data' => $storedProduto
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler(
                'Erro ao inserir o produto!!!',
                $error, $statusHttp);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return response()->json($produto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $statusHttp = 200;
        try {
            $data = $request->all();
            $data['importado'] = $request->has('importado');
            $produto->update($data);
            return response()->json([
                'message' => 'Produto atualizado com sucesso',
                'data' => $produto
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao atualizar o produto!!!', $error, $statusHttp);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $statusHttp = 200;
        try {
            $produto->delete();
            return response()->json([
                'message' => 'Produto removido com sucesso',
                'data' => $produto
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao remover o produto!!!', $error, $statusHttp);
        }
    }

}
