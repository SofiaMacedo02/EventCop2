let etapaAtual = 1;

// Seleção dos elementos do DOM
const etapas = document.querySelectorAll('.etapa');
const passoTexto = document.getElementById('passo-texto');
const progressoBarra = document.getElementById('progresso');

function atualizarFormulario(novaEtapa) {
    // 1. Esconde todas as etapas
    etapas.forEach(etapa => etapa.classList.add('escondido'));

    // 2. Mostra a etapa desejada (índice do array começa em 0)
    etapas[novaEtapa - 1].classList.remove('escondido');

    // 3. Atualiza o texto do passo
    passoTexto.textContent = `Passo ${novaEtapa} de 3`;

    // 4. Atualiza a largura da barra de progresso (33.3%, 66.6%, 100%)
    const porcentagem = (novaEtapa / 3) * 100;
    progressoBarra.style.width = `${porcentagem}%`;

    etapaAtual = novaEtapa;
}

// Escuta os cliques nos botões "Avançar"
document.querySelectorAll('.btn-proximo').forEach(botao => {
    botao.addEventListener('click', () => {
        if (etapaAtual < 3) {
            atualizarFormulario(etapaAtual + 1);
        }
    });
});

// Escuta os cliques nos botões "Voltar"
document.querySelectorAll('.btn-anterior').forEach(botao => {
    botao.addEventListener('click', () => {
        if (etapaAtual > 1) {
            atualizarFormulario(etapaAtual - 1);
        }
    });
});