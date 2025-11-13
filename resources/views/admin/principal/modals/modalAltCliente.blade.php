<div class="modal fade" id="modalAlteracao" tabindex="-1" aria-labelledby="modalAlteracaoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="formAlteracaoCliente">
            @csrf
            @method('PUT') <!-- para método PUT de atualização -->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAlteracaoLabel">Alterar Cliente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="cliente_id">
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" name="nome" id="nome" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" name="telefone" id="telefone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar alterações</button>
                </div>
            </div>
        </form>
    </div>
</div>
