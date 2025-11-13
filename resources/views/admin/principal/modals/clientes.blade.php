@extends('Template_siteNew.index')

@section('content')
<div class="container text-center">
  <div class="row">
    <div class="col">
        <h1 class="section-title">Lista de Clientes</h1>
    </div>
    <div class="row">
       <div class="col">
      <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Id</th>
            </tr>
        </thead>
        <tbody>
        @foreach($clientes as $cliente)
            <tr class="linha-cliente"
                data-id="{{ $cliente->id }}"
                data-nome="{{ $cliente->nome }}"
                data-email="{{ $cliente->email }}"
                data-telefone="{{ $cliente->telefone }}">
                
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->email }}</td>
                <td>
                    @if($cliente->telefone)
                        {{ $cliente->telefone }}
                    @else
                        Não informado
                    @endif
                </td>
                <td>{{ $cliente->id }}</td>
            </tr>
        @endforeach

        </tbody>
      </table>
      </div> 
    </div>
    <div class="row" style="padding: 20px 0;">

        <div class="col">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target="#modalIncluir">Adicionar cliente
                </button>

                <button type="button" id="btnAlterar" disabled class="btn btn-primary" data-bs-toggle="modal" 
                        data-bs-target="#modalAlteracao">Alterar cliente
                </button>

                <button type="button" id="btnExcluir" disabled class="btn btn-danger">Excluir cliente</button>

                <form id="formExcluir" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

    </div>
    @include("Template_siteNew.modalAltCliente")
    @include("Template_siteNew.modalIncCliente")   
</div>
<script src="{{ asset('site/js/CRUDCliente.js') }}"></script>

@endsection
