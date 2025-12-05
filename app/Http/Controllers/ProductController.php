<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Página de listagem de Produtos (Admin) - Rota Funcionando!";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
{
    // Retorna a view que criamos
    return view('pages.products.create'); 
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validação dos Dados
    $validatedData = $request->validate([
        'name' => 'required|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable',
        'image_path' => 'nullable|string',
    ]);

    // 2. Criação do Produto no Banco de Dados (Mass Assignment)
    Product::create($validatedData);

    // 3. Redirecionamento e Mensagem de Sucesso
    // Por enquanto, vamos redirecionar para a página de listagem (products.index)
    return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
