<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
use Illuminate\Http\Request;

class ClienteFrontController extends Controller
{
    /**
     * Exibe a página inicial (home)
     */
    public function home()
    {
        // Pega os últimos 6 veículos disponíveis com relacionamentos
        $veiculos = Veiculo::with(['marca', 'modelo', 'cor'])
                          ->where('status', 'Disponível')
                          ->latest()
                          ->take(6)
                          ->get();
        
        return view('cliente.home', compact('veiculos'));
    }

    /**
     * Exibe a página de modelos (todos os veículos)
     */
    public function modelos()
    {
        // Pega todos os veículos disponíveis com paginação e relacionamentos
        $veiculos = Veiculo::with(['marca', 'modelo', 'cor'])
                          ->where('status', 'Disponível')
                          ->orderBy('marca_id')
                          ->orderBy('modelo_id')
                          ->paginate(12);
        
        return view('cliente.modelos', compact('veiculos'));
    }

    /**
     * Exibe os detalhes de um veículo específico
     */
    public function show($id)
    {
        $veiculo = Veiculo::with(['marca', 'modelo', 'cor'])->findOrFail($id);
        
        // Veículos relacionados (mesma marca)
        $relacionados = Veiculo::with(['marca', 'modelo', 'cor'])
                              ->where('marca_id', $veiculo->marca_id)
                              ->where('id', '!=', $veiculo->id)
                              ->where('status', 'Disponível')
                              ->take(3)
                              ->get();
        
        return view('cliente.veiculo-detalhes', compact('veiculo', 'relacionados'));
    }

    /**
     * Inscrição na newsletter
     */
    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        // Aqui você pode salvar o email na base de dados
        // ou enviar para um serviço de email marketing
        
        return back()->with('success', 'Obrigado por se inscrever!');
    }
}
