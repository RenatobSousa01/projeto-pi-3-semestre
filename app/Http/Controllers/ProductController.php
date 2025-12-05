<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // ✅ Importar para deletar arquivos com 'unlink'

class ProductController extends Controller
{
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all(); 
        return view('pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.products.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Limpeza e Validação de Dados
        $request->merge(['price' => str_replace(',', '.', $request->input('price'))]);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // ----------------------------------------------------
        // ✅ 2. LOGICA DE UPLOAD (SOLUÇÃO ACESSO DIRETO)
        // ----------------------------------------------------
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Define um nome único para o arquivo
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            
            // Move o arquivo para a pasta public/images/
            $request->file('image')->move(public_path('images'), $fileName);
            
            // Salva o caminho relativo no BD
            $imagePath = 'images/' . $fileName; 
        }

        // 3. Criação do Produto no Banco de Dados
        Product::create(array_merge($validatedData, [
            'image_path' => $imagePath, // Salva o caminho da imagem
        ]));

        // 4. Redirecionamento
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('pages.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Limpeza e Validação de Dados
        $request->merge(['price' => str_replace(',', '.', $request->input('price'))]);
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // ----------------------------------------------------
        // ✅ 2. LOGICA DE UPLOAD (SOLUÇÃO ACESSO DIRETO - UPDATE)
        // ----------------------------------------------------
        $imagePath = $product->image_path; 

        if ($request->hasFile('image')) {
            // Se houver imagem antiga E ela existir no disco, apague-a
            if ($product->image_path && File::exists(public_path($product->image_path))) {
                File::delete(public_path($product->image_path));
            }
            
            // Define o nome e move o novo arquivo para public/images
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'), $fileName);
            
            // Salva o novo caminho
            $imagePath = 'images/' . $fileName; 
        }

        // 3. Atualiza o Produto
        $product->update(array_merge($validatedData, [
            'image_path' => $imagePath,
        ]));

        // 4. Redirecionamento
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // 1. Apaga a imagem associada antes de apagar o registro
        if ($product->image_path && File::exists(public_path($product->image_path))) {
            File::delete(public_path($product->image_path));
        }

        // 2. Deleta o registro do banco de dados
        $product->delete();

        // 3. Redireciona com mensagem
        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso!');
    }
}