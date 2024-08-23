<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Http\Requests\Api\FornecedorStoreRequest;
use App\Http\Requests\Api\FornecedorUpdateRequest;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $perPage = $request->query('per_page');
        $paginatedProdutos = Fornecedor::paginate($perPage);
        $paginatedProdutos->appends([
            'per_page'=>$perPage
        ]);

        return response()->json($paginatedProdutos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FornecedorStoreRequest $request)
    {
        $statusHttp = 201;
        try {
            $newFornecedor = $request->all();
            $storedFornecedor = Fornecedor::create($newFornecedor);
            return response()->json([
                'message' => 'Fornecedor inserido com sucesso',
                'data' => $storedFornecedor
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler(
                'Erro ao inserir o fornecedor!!!',
                $error, $statusHttp);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Fornecedor $fornecedor)
    {
        return response()->json($fornecedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FornecedorUpdateRequest $request, Fornecedor $fornecedor)
    {
        $statusHttp = 200;
        try {
            $data = $request->all();
            $fornecedor->update($data);
            return response()->json([
                'message' => 'Fornecedor atualizado com sucesso',
                'data' => $fornecedor
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao atualizar o fornecedor!!!', $error, $statusHttp);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        $statusHttp = 200;
        try {
            $fornecedor->delete();
            return response()->json([
                'message' => 'Fornecedor removido com sucesso',
                'data' => $fornecedor
            ], $statusHttp);
        } catch (Exception $error) {
            return $this->errorHandler('Erro ao remover o fornecedor!!!', $error, $statusHttp);
        }
    }
}
