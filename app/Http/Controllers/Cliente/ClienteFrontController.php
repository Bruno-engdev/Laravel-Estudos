<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use App\Models\Marca;
use App\Models\Modelo;
use App\Models\Cor;
use Illuminate\Http\Request;

class ClienteFrontController extends Controller
{
    /**
     * Página inicial da loja
     */
    public function home()
    {
        // Buscar alguns veículos em destaque
        $veiculos = Veiculo::with(['marca', 'modelo', 'cor'])
            ->where('status', 'Disponível')
            ->latest()
            ->take(6)
            ->get();

        return view('cliente.home', compact('veiculos'));
    }

    /**
     * Página de modelos
     */
    public function modelos()
    {
        // Buscar todos os veículos disponíveis
        $veiculos = Veiculo::with(['marca', 'modelo', 'cor'])
            ->where('status', 'Disponível')
            ->paginate(12);

        // Buscar marcas para filtros
        $marcas = Marca::where('ativo', true)->orderBy('nome')->get();

        return view('cliente.modelos', compact('veiculos', 'marcas'));
    }

    /**
     * Detalhes de um veículo específico
     */
    public function show($id)
    {
        $veiculo = Veiculo::with(['marca', 'modelo', 'cor'])->findOrFail($id);
        
        // Veículos relacionados (mesma marca ou modelo)
        $veiculosRelacionados = Veiculo::with(['marca', 'modelo', 'cor'])
            ->where('status', 'Disponível')
            ->where('id', '!=', $id)
            ->where(function($query) use ($veiculo) {
                $query->where('marca_id', $veiculo->marca_id)
                      ->orWhere('modelo_id', $veiculo->modelo_id);
            })
            ->take(4)
            ->get();

        return view('cliente.veiculo-detalhes', compact('veiculo', 'veiculosRelacionados'));
    }

    /**
     * Newsletter subscribe
     */
    public function newsletterSubscribe(Request $request)
    {
        // Por enquanto, apenas retorna sucesso
        return response()->json(['success' => true, 'message' => 'Obrigado! Você foi inscrito em nossa newsletter.']);
    }
}
