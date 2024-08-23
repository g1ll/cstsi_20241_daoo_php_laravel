<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Controller;
use App\Models\Fornecedor;
use Exception;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Fornecedor::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $statusHttp = 201;
        try {
            $request->validate([
                "nome"=>"required | string",
                "email"=>"required | email | unique:fornecedores"
            ]);
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
    public function update(Request $request, Fornecedor $fornecedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Fornecedor $fornecedor)
    {
        //
    }
}
