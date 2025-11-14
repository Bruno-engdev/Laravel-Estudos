<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Veiculo;
use Illuminate\Support\Facades\Validator;

class VeiculoController extends Controller
{
    /**
     * Exibe a lista de veículos
     */
    public function index()
    {
        $veiculos = Veiculo::orderBy('created_at', 'desc')->paginate(10);
        return view('veiculos.index', compact('veiculos'));
    }

    /**
     * Exibe o formulário de criação de veículo
     */
    public function create()
    {
        return view('veiculos.create');
    }

    /**
     * Armazena um novo veículo
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'nullable|string|max:10|unique:veiculos,placa',
            'cor' => 'required|string|max:50',
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
        ], [
            'marca.required' => 'O campo marca é obrigatório.',
            'modelo.required' => 'O campo modelo é obrigatório.',
            'ano_fabricacao.required' => 'O campo ano de fabricação é obrigatório.',
            'ano_modelo.required' => 'O campo ano do modelo é obrigatório.',
            'placa.unique' => 'Esta placa já está cadastrada.',
            'cor.required' => 'O campo cor é obrigatório.',
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

        // Remove formatação de valores monetários se houver
        $data = $request->all();
        if (isset($data['preco_compra'])) {
            $data['preco_compra'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['preco_compra']);
        }
        $data['preco_venda'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['preco_venda']);

        Veiculo::create($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo cadastrado com sucesso!');
    }

    /**
     * Exibe um veículo específico
     */
    public function show($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        return view('veiculos.show', compact('veiculo'));
    }

    /**
     * Exibe o formulário de edição de veículo
     */
    public function edit($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        return view('veiculos.edit', compact('veiculo'));
    }

    /**
     * Atualiza um veículo
     */
    public function update(Request $request, $id)
    {
        $veiculo = Veiculo::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'marca' => 'required|string|max:100',
            'modelo' => 'required|string|max:100',
            'ano_fabricacao' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'ano_modelo' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'placa' => 'nullable|string|max:10|unique:veiculos,placa,' . $id,
            'cor' => 'required|string|max:50',
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
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Remove formatação de valores monetários se houver
        $data = $request->all();
        if (isset($data['preco_compra'])) {
            $data['preco_compra'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['preco_compra']);
        }
        $data['preco_venda'] = str_replace(['R$', '.', ','], ['', '', '.'], $data['preco_venda']);

        $veiculo->update($data);

        return redirect()->route('veiculos.index')->with('success', 'Veículo atualizado com sucesso!');
    }

    /**
     * Remove um veículo (soft delete)
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::findOrFail($id);
        $veiculo->delete();

        return redirect()->route('veiculos.index')->with('success', 'Veículo removido com sucesso!');
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