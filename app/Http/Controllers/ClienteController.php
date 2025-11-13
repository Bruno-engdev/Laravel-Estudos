<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cliente; // Importa o model
class ClienteController extends Controller
{public function index()
    {
        $clientes = cliente::all(); // Pega todos os registros da tabela 'Carros'
        return view('admin/principal/index', compact('clientes')); // Retorna para a view com os dados
    }

    public function salvarCliente(Request $request){
    $cliente = new Cliente();
    $cliente->nome = $request->input('nome');
    $cliente->email = $request->input('email');
    $cliente->telefone = $request->input('telefone');
    $cliente->CPF = $request->input('CPF');
    $cliente->DataNasc = $request->input('DataNasc');
    $cliente->save();
    return redirect('/admin/principal/index');
}

public function alterarCliente(Request $request, $id){ 
    // Buscar o cliente pelo ID
    $cliente = Cliente::find($id);

    // Verificar se o cliente existe
    if(!$cliente){
        return redirect('/admin/principal/index')->with('error', 'Cliente não encontrado.');
    }

    // Atualizar os campos
    $cliente->nome = $request->input('nome');
    $cliente->email = $request->input('email');
    $cliente->telefone = $request->input('telefone');
    $cliente->CPF = $request->input('telefone');
    $cliente->DataNasc = $request->input('DataNasc');
    // Salvar as alterações
    $cliente->save();
    return redirect('/admin/principal/index');
}

public function deletarCliente($id){
    // Buscar o cliente pelo ID
    $cliente = Cliente::find($id);

    // Verificar se o cliente existe
    if(!$cliente){
        return redirect('/admin/principal/index')->with('error', 'Cliente não encontrado.');
    }

    // Excluir o cliente
    $cliente->delete();
    return redirect('/admin/principal/index');
}

}
