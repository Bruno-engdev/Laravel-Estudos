<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    /**
     * Lista todos os clientes
     */
    public function index()
    {
        $clientes = Cliente::orderBy('created_at', 'desc')->get();
        return view('admin.principal.index', compact('clientes'));
    }

    /**
     * Salva um novo cliente
     */
    public function salvarCliente(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:cliente,email',
            'telefone' => 'nullable|string|max:20',
            'CPF' => 'nullable|string|max:14',
            'DataNasc' => 'nullable|date'
        ], [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está cadastrado',
        ]);

        $cliente = new Cliente();
        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->CPF = $request->input('CPF');
        $cliente->DataNasc = $request->input('DataNasc');
        $cliente->save();
        
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente cadastrado com sucesso!');
    }

    /**
     * Atualiza um cliente existente
     */
    public function alterarCliente(Request $request, $id)
    { 
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('admin.clientes.index')->with('error', 'Cliente não encontrado.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:cliente,email,' . $id,
            'telefone' => 'nullable|string|max:20',
            'CPF' => 'nullable|string|max:14',
            'DataNasc' => 'nullable|date'
        ], [
            'nome.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'Digite um email válido',
            'email.unique' => 'Este email já está cadastrado',
        ]);

        $cliente->nome = $request->input('nome');
        $cliente->email = $request->input('email');
        $cliente->telefone = $request->input('telefone');
        $cliente->CPF = $request->input('CPF');
        $cliente->DataNasc = $request->input('DataNasc');
        $cliente->save();
        
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Exclui um cliente
     */
    public function deletarCliente($id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            return redirect()->route('admin.clientes.index')->with('error', 'Cliente não encontrado.');
        }

        $cliente->delete();
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente excluído com sucesso!');
    }
}
