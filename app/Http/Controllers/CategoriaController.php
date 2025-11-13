<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    //Listagem inicial das categorias
    public function index()
    {
        $cat = Categoria::all();
        return view("categoria.index", compact('cat') );
    }

    //formulario de criação de categoria
    public function form_novo()
    {}

    //Salvar nova categoria
    public function salvar_novo()
    {}

    //Formulario de edição de categoria
    public function form_editar()
    {}

    //Salvaer edição
    public function salvar_edit()
    {}

    //Excluir uma catoria
    public function excluir()
    {}
}