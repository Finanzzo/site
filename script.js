// Carregar o header em todas as páginas
document.addEventListener("DOMContentLoaded", function() {
  fetch('header.html')
    .then(res => res.text())
    .then(html => document.getElementById('header-container').innerHTML = html);
});

// Função para formatar moeda em R$
function formatarMoeda(input) {
  let valor = input.value.replace(/\D/g, '');
  valor = (valor / 100).toFixed(2) + '';
  valor = valor.replace('.', ',');
  valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
  input.value = 'R$ ' + valor;
}

// Função para calcular troco aproximado na portabilidade
function calcularTroco() {
  const parcelaInput = document.getElementById('parcela').value;
  const qtdParcelasInput = document.getElementById('qtdParcelas').value;
  const saldoDevedorInput = document.getElementById('saldoDevedor').value;

  if (!parcelaInput || !qtdParcelasInput || !saldoDevedorInput) {
    alert('Preencha todos os campos para calcular.');
    return;
  }

  // Remove tudo que não for número e converte para float
  const parcela = parseFloat(parcelaInput.replace(/\D/g, '')) / 100;
  const qtdParcelas = parseInt(qtdParcelasInput);
  const saldoDevedor = parseFloat(saldoDevedorInput.replace(/\D/g, '')) / 100;

  if (isNaN(parcela) || isNaN(qtdParcelas) || isNaN(saldoDevedor)) {
    alert('Valores inválidos, revise os campos.');
    return;
  }

  const taxa = 1.55 / 100; // 1,55% ao mês

  // Fórmula do valor presente da anuidade (parcelas futuras com nova taxa)
  const valorPresente = parcela * (1 - Math.pow(1 + taxa, -qtdParcelas)) / taxa;

  // Troco aproximado = valor presente com nova taxa - saldo devedor atual
  const troco = valorPresente - saldoDevedor;

  const resultado = document.getElementById('resultado');

  if (troco > 0) {
    resultado.innerHTML = `Valor aproximado de troco: <strong>R$ ${troco.toFixed(2).replace('.', ',')}</strong><br>Para simulação detalhada, chame no WhatsApp!`;
  } else {
    resultado.innerHTML = `Não há troco disponível com esses dados.<br>Para mais informações, chame no WhatsApp!`;
  }
}
