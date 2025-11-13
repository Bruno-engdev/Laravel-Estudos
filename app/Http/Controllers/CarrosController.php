<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\carros; // Importa o model

class CarrosController extends Controller
{
    // Método que retorna a view com todos os carros
    public function index()
    {
        $carros = carros::all(); // Pega todos os registros da tabela 'Carros'
        return view('carros', compact('carros')); // Retorna para a view com os dados
    }

    public function salvarCarro(Request $request){
        $carro = new Carros();
        $carro->nome_carro =$request->input('nome_modelo');
        $carro->ano_carro =$request->input('ano_modelo');
        $carro->preco_carro =$request->input('preco_modelo');
        $carro->save();
        return redirect('/carros');
    }

    public function alterarCarro(Request $request, $id){
    // Buscar o carro pelo ID
    $carro = Carros::find($id);

    // Verificar se o carro existe
    if(!$carro){
        return redirect('/carros')->with('error', 'Carro não encontrado.');
    }

    // Atualizar os campos
    $carro->nome_carro = $request->input('nome_modelo');
    $carro->ano_carro = $request->input('ano_modelo');
    $carro->preco_carro = $request->input('preco_modelo');

    // Salvar as alterações
    $carro->save();
    return redirect('/carros');
}

    public function deletarCarro($id){
    // Buscar o carro pelo ID
    $carro = Carros::find($id);

    // Verificar se o carro existe
    if(!$carro){
        return redirect()->route('carros.index')->with('error', 'Carro não encontrado.');
    }

    // excluir as alterações
    $carro->delete();
    return redirect('/carros');

    }
}