document.addEventListener('DOMContentLoaded', function() {
    const tabela = document.querySelector('table tbody');
    let linhaSelecionada = null;

    tabela.querySelectorAll('tr').forEach(tr => {
        tr.addEventListener('click', () => {
            if (linhaSelecionada) {
                linhaSelecionada.classList.remove('selecionado');
            }
            tr.classList.add('selecionado');
            linhaSelecionada = tr;

            document.getElementById('btnAlterar').disabled = false;
            document.getElementById('btnExcluir').disabled = false; // Habilita o botão Excluir
        });
    });

    document.getElementById('btnAlterar').addEventListener('click', () => {
        if (!linhaSelecionada) return;

        const id = linhaSelecionada.dataset.id;
        const nome = linhaSelecionada.dataset.nome;
        const email = linhaSelecionada.dataset.email;
        const telefone = linhaSelecionada.dataset.telefone;

        const modal = document.getElementById('modalAlteracao');
        modal.querySelector('#cliente_id').value = id;
        modal.querySelector('#nome').value = nome;
        modal.querySelector('#email').value = email;
        modal.querySelector('#telefone').value = telefone;

        const form = modal.querySelector('form');
        form.action = `/clientes/${id}`; // URL para update via PUT
    });

    document.getElementById('btnExcluir').addEventListener('click', () => {
        if (!linhaSelecionada) return;

        if (!confirm('Tem certeza que deseja excluir este cliente?')) return;

        const id = linhaSelecionada.dataset.id;
        const form = document.getElementById('formExcluir');
        form.action = `/clientes/${id}`;
        form.submit();
    });
});
