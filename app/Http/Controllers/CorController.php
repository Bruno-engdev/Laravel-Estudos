<?php

namespace App\Http\Controllers;

use App\Models\Cor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cores = Cor::orderBy('nome')->paginate(15);
        return view('admin.cores.index', compact('cores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.cores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:50|unique:cores,nome',
            'codigo_hex' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'ativo' => 'boolean',
        ], [
            'nome.required' => 'O nome da cor é obrigatório.',
            'nome.unique' => 'Esta cor já está cadastrada.',
            'codigo_hex.regex' => 'Código hexadecimal inválido. Use o formato #RRGGBB.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Cor::create($request->all());

        return redirect()->route('admin.cores.index')->with('success', 'Cor cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cor = Cor::with('veiculos')->findOrFail($id);
        return view('admin.cores.show', compact('cor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cor = Cor::findOrFail($id);
        return view('admin.cores.edit', compact('cor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cor = Cor::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|max:50|unique:cores,nome,' . $id,
            'codigo_hex' => 'nullable|string|max:7|regex:/^#[0-9A-Fa-f]{6}$/',
            'ativo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $cor->update($request->all());

        return redirect()->route('admin.cores.index')->with('success', 'Cor atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cor = Cor::findOrFail($id);
        
        // Verifica se há veículos associados
        if ($cor->veiculos()->count() > 0) {
            return redirect()->back()->with('error', 'Não é possível excluir esta cor pois existem veículos associados.');
        }

        $cor->delete();

        return redirect()->route('admin.cores.index')->with('success', 'Cor removida com sucesso!');
    }
}
