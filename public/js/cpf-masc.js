function formatCPF(input) {
let value = input.value.replace(/\D/g, ''); // remove tudo que não é número
value = value.replace(/(\d{3})(\d)/, '$1.$2'); // insere ponto após 3 dígitos
value = value.replace(/(\d{3})(\d)/, '$1.$2'); // insere ponto após 6 dígitos
value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // insere traço antes dos 2 últimos dígitos
input.value = value;
}