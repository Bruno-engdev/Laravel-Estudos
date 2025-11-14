<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::orderBy('nome')->paginate(15);
        return view('admin.marcas.index', compact('marcas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100|unique:marcas,nome',
            'descricao' => 'nullable|string',
            'pais_origem' => 'nullable|string|max:50',
            'ativo' => 'boolean',
        ], [
            'nome.required' => 'O nome da marca é obrigatório.',
            'nome.unique' => 'Esta marca já está cadastrada.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Marca::create($request->all());

        return redirect()->route('admin.marcas.index')->with('success', 'Marca cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $marca = Marca::with(['modelos', 'veiculos'])->findOrFail($id);
        return view('admin.marcas.show', compact('marca'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.edit', compact('marca'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $marca = Marca::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:100|unique:marcas,nome,' . $id,
            'descricao' => 'nullable|string',
            'pais_origem' => 'nullable|string|max:50',
            'ativo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $marca->update($request->all());

        return redirect()->route('admin.marcas.index')->with('success', 'Marca atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $marca = Marca::findOrFail($id);
        
        // Verifica se há modelos associados
        if ($marca->modelos()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível excluir esta marca pois existem modelos associados.');
        }
        
        // Verifica se há veículos associados
        if ($marca->veiculos()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível excluir esta marca pois existem veículos associados.');
        }

        $marca->delete();

        return redirect()->route('admin.marcas.index')->with('success', 'Marca removida com sucesso!');
    }
}
