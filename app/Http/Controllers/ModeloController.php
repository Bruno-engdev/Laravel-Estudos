<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $modelos = Modelo::with('marca')->orderBy('nome')->paginate(15);
        return view('admin.modelos.index', compact('modelos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $marcas = Marca::ativas()->orderBy('nome')->get();
        return view('admin.modelos.create', compact('marcas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'tipo' => 'nullable|string|max:50',
            'ativo' => 'boolean',
        ], [
            'marca_id.required' => 'A marca é obrigatória.',
            'marca_id.exists' => 'Marca inválida.',
            'nome.required' => 'O nome do modelo é obrigatório.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Modelo::create($request->all());

        return redirect()->route('admin.modelos.index')->with('success', 'Modelo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $modelo = Modelo::with(['marca', 'veiculos'])->findOrFail($id);
        return view('admin.modelos.show', compact('modelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $modelo = Modelo::findOrFail($id);
        $marcas = Marca::ativas()->orderBy('nome')->get();
        return view('admin.modelos.edit', compact('modelo', 'marcas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $modelo = Modelo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'marca_id' => 'required|exists:marcas,id',
            'nome' => 'required|string|max:100',
            'descricao' => 'nullable|string',
            'tipo' => 'nullable|string|max:50',
            'ativo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $modelo->update($request->all());

        return redirect()->route('admin.modelos.index')->with('success', 'Modelo atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $modelo = Modelo::findOrFail($id);
        
        // Verifica se há veículos associados
        if ($modelo->veiculos()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível excluir este modelo pois existem veículos associados.');
        }

        $modelo->delete();

        return redirect()->route('admin.modelos.index')->with('success', 'Modelo removido com sucesso!');
    }
}
