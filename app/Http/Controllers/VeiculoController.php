<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Cor;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    /**
     * Exibe a lista de veículos
     */
    public function index()
    {
        $veiculos = Veiculo::with(['marca', 'modelo', 'cor'])->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.veiculos.index', compact('veiculos'));
    }

    /**
     * Exibe o formulário de criação de veículo
     */
    public function create()
    {
        $marcas = Marca::ativas()->orderBy('nome')->get();
        $modelos = Modelo::ativos()->with('marca')->orderBy('nome')->get();
        $cores = Cor::ativas()->orderBy('nome')->get();
        return view('admin.veiculos.create', compact('marcas', 'modelos', 'cores'));
    }

    /**
     * Armazena um novo veículo
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'cor_id' => 'required|exists:cores,id',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'nullable|string|max:10|unique:veiculos,placa',
            'tipo' => 'required|string|max:50',
            'combustivel' => 'required|string|max:50',
            'cambio' => 'required|string|max:50',
            'portas' => 'required|integer|min:2|max:5',
            'motor' => 'required|string|max:50',
            'preco_compra' => 'nullable|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'categoria' => 'required|string|max:100',
            'quilometragem' => 'nullable|integer|min:0',
            'foto1' => 'nullable|url|max:500',
            'foto2' => 'nullable|url|max:500',
            'foto3' => 'nullable|url|max:500',
        ], [
            'marca_id.required' => 'O campo marca é obrigatório.',
            'modelo_id.required' => 'O campo modelo é obrigatório.',
            'cor_id.required' => 'O campo cor é obrigatório.',
            'ano_fabricacao.required' => 'O campo ano de fabricação é obrigatório.',
            'ano_modelo.required' => 'O campo ano do modelo é obrigatório.',
            'placa.unique' => 'Esta placa já está cadastrada.',
            'tipo.required' => 'O campo tipo é obrigatório.',
            'combustivel.required' => 'O campo combustível é obrigatório.',
            'cambio.required' => 'O campo câmbio é obrigatório.',
            'portas.required' => 'O campo portas é obrigatório.',
            'motor.required' => 'O campo motor é obrigatório.',
            'preco_venda.required' => 'O campo preço de venda é obrigatório.',
            'status.required' => 'O campo status é obrigatório.',
            'categoria.required' => 'O campo categoria é obrigatório.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Veiculo::create($request->all());

        return redirect()->route('admin.veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe um veículo específico
     */
    public function show($id)
    {
        $veiculo = Veiculo::with(['marca', 'modelo', 'cor'])->findOrFail($id);
        return view('admin.veiculos.show', compact('veiculo'));
    }

    /**
     * Exibe o formulário de edição de veículo
     */
    public function edit($id)
    {
        $veiculo = Veiculo::with(['marca', 'modelo', 'cor'])->findOrFail($id);
        $marcas = Marca::ativas()->orderBy('nome')->get();
        $modelos = Modelo::ativos()->with('marca')->orderBy('nome')->get();
        $cores = Cor::ativas()->orderBy('nome')->get();
        return view('admin.veiculos.edit', compact('veiculo', 'marcas', 'modelos', 'cores'));
    }

    /**
     * Atualiza um veículo
     */
    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'marca_id' => 'required|exists:marcas,id',
            'modelo_id' => 'required|exists:modelos,id',
            'cor_id' => 'required|exists:cores,id',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'nullable|string|max:10|unique:veiculos,placa,' . $id,
            'tipo' => 'required|string|max:50',
            'combustivel' => 'required|string|max:50',
            'cambio' => 'required|string|max:50',
            'portas' => 'required|integer|min:2|max:5',
            'motor' => 'required|string|max:50',
            'preco_compra' => 'nullable|numeric|min:0',
            'preco_venda' => 'required|numeric|min:0',
            'status' => 'required|string|max:50',
            'categoria' => 'required|string|max:100',
            'quilometragem' => 'nullable|integer|min:0',
            'foto1' => 'nullable|url|max:500',
            'foto2' => 'nullable|url|max:500',
            'foto3' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $veiculo->update($request->all());

        return redirect()->route('admin.veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove um veículo (soft delete)
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();

        return redirect()->route('admin.veiculos.index')->with('success', 'Veículo removido com sucesso!');
    }

    /**
     * Filtrar veículos por status
     */
    public function filtrarPorStatus(Request $request)
    {
        $status = $request->get('status', 'todos');
        
        $query = Veiculo::query();
        
        if ($status !== 'todos') {
            $query->where('status', $status);
        }
        
        $veiculos = $query->orderBy('created_at', 'desc')->paginate(10);
        
        return view('veiculos.index', compact('veiculos', 'status'));
    }

    /**
     * Buscar veículos
     */
    public function buscar(Request $request)
    {
        $termo = $request->get('busca');
        
        $veiculos = Veiculo::where('marca', 'LIKE', "%{$termo}%")
            ->orWhere('modelo', 'LIKE', "%{$termo}%")
            ->orWhere('placa', 'LIKE', "%{$termo}%")
            ->orWhere('cor', 'LIKE', "%{$termo}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('veiculos.index', compact('veiculos', 'termo'));
    }

    /**
     * Alterar status do veículo
     */
    public function alterarStatus(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status alterado com sucesso!');
    }
}