@extends("admin_layout.index")

@section("admin")
<div id="layoutSidenav_content"   style="marging-left:-8px">
    <main>
        <div class="container-fluid px-4">
            </div>
                <section id="about" class="section">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col">
                                <h1 class="section-title">Registro de clientes</h1>
                            </div>
                        </div>
                            <div class="row">                            
                                <table class="table-darkmode">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>Telefone</th>
                                            <th>CPF</th>
                                            <th>Data de Nascimento</th>
                                            <th>Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr class="linha-cliente"
                                                data-id="{{ $cliente->id }}"
                                                data-nome="{{ $cliente->nome }}"
                                                data-email="{{ $cliente->email }}"
                                                data-telefone="{{ $cliente->telefone }}"
                                                data-cpf="{{ $cliente->cpf }}"
                                                data-datanascimento="{{ $cliente->data_nascimento }}">
                                                
                                                <td>{{ $cliente->nome }}</td>
                                                <td>{{ $cliente->email }}</td>
                                                <td>
                                                    @if($cliente->telefone)
                                                        {{ $cliente->telefone }}
                                                    @else
                                                        Não informado
                                                    @endif
                                                </td>
                                                <td>{{ $cliente->cpf ?? 'Não informado' }}</td>
                                                <td>{{ $cliente->data_nascimento ?? 'Não informado' }}</td>
                                                <td>{{ $cliente->id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                           
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

                        @include("admin.principal.modals.modalAltCliente")
                        @include("admin.principal.modals.modalIncCliente")   
                    </div>
                </section>
                <script src="{{ asset('js/CRUDCliente.js') }}"></script>                            
            </div>
        </div>
    </main>
    <div class="row">  
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div> 
</div>
@stop
