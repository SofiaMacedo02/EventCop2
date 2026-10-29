/**
 * Gerenciador e Pré-visualizador de Certificados - EventCop
 * Permite personalização em tempo real, troca de modelos e emissão/download.
 */

document.addEventListener('DOMContentLoaded', () => {
    inicializarBindsTempoReal();
    popularListaParticipantesExemplo();
});

const modelosDisponiveis = [
    { id: 'vinho', nome: 'Vinho Institucional', corPrincipal: '#5A0505', corFundo: '#fffdf9' },
    { id: 'dourado', nome: 'Dourado Elegante', corPrincipal: '#b45309', corFundo: '#fdfaf3' },
    { id: 'verde', nome: 'Verde Corporativo', corPrincipal: '#065f46', corFundo: '#f0fdf4' }
];

let modeloAtualIndex = 0;

function notificarCert(msg, tipo = 'ok') {
    if (window.EventCop && typeof window.EventCop.toast === 'function') {
        window.EventCop.toast(msg, tipo);
    } else {
        alert(msg);
    }
}

/**
 * Vincula todos os inputs aos respectivos elementos da pré-visualização
 */
function inicializarBindsTempoReal() {
    const inputTitulo = document.getElementById('inputTituloCertificado');
    const prevTitulo = document.getElementById('prevTitulo');
    if (inputTitulo && prevTitulo) {
        inputTitulo.addEventListener('input', (e) => {
            prevTitulo.textContent = e.target.value.toUpperCase() || 'CERTIFICADO';
        });
    }

    const inputNomeEvento = document.getElementById('inputNomeEvento');
    const lblResumoEvento = document.getElementById('lblResumoEvento');
    if (inputNomeEvento && lblResumoEvento) {
        inputNomeEvento.addEventListener('input', (e) => {
            lblResumoEvento.textContent = e.target.value || 'Evento';
        });
    }

    const inputTexto = document.getElementById('inputTextoCertificado');
    const prevText = document.getElementById('prevText');
    if (inputTexto && prevText) {
        inputTexto.addEventListener('input', (e) => {
            let texto = e.target.value;
            texto = texto.replace('[Nome do participante]', '').trim();
            prevText.textContent = texto;
        });
    }

    const inputLocal = document.getElementById('inputLocal');
    const inputData = document.getElementById('inputDataEvento');
    const prevLocation = document.getElementById('prevLocation');
    const atualizarLocalData = () => {
        const local = inputLocal ? inputLocal.value : 'São José dos Campos - SP';
        const data = inputData ? inputData.value : '15 de setembro de 2026';
        if (prevLocation) {
            prevLocation.textContent = `${local}, ${data}.`;
        }
    };
    if (inputLocal) inputLocal.addEventListener('input', atualizarLocalData);
    if (inputData) inputData.addEventListener('input', atualizarLocalData);

    bindAssinatura('inputSig1Nome', 'prevSig1Nome', 'prevSig1Rubrica');
    bindAssinatura('inputSig1Cargo', 'prevSig1Cargo');
    bindAssinatura('inputSig2Nome', 'prevSig2Nome', 'prevSig2Rubrica');
    bindAssinatura('inputSig2Cargo', 'prevSig2Cargo');
}

function bindAssinatura(inputId, prevId, rubricaId = null) {
    const input = document.getElementById(inputId);
    const prev = document.getElementById(prevId);
    const rubrica = rubricaId ? document.getElementById(rubricaId) : null;

    if (input && prev) {
        input.addEventListener('input', (e) => {
            prev.textContent = e.target.value;
            if (rubrica) rubrica.textContent = e.target.value;
        });
    }
}

/**
 * Seleciona um dos modelos de certificado pré-definidos
 */
function selecionarModelo(idModelo, elThumb) {
    const papel = document.getElementById('certificatePaper');
    const thumbs = document.querySelectorAll('.model-thumb');
    const selectPrincipal = document.getElementById('selectCorPrincipal');
    const lblResumo = document.getElementById('lblResumoModelo');

    if (!papel) return;

    thumbs.forEach(t => t.classList.remove('active'));
    if (elThumb) {
        elThumb.classList.add('active');
    }

    papel.classList.remove('model-vinho', 'model-dourado', 'model-verde');
    papel.classList.add(`model-${idModelo}`);

    const modeloEncontrado = modelosDisponiveis.find(m => m.id === idModelo);
    if (modeloEncontrado) {
        if (selectPrincipal) selectPrincipal.value = modeloEncontrado.corPrincipal;
        if (lblResumo) lblResumo.textContent = modeloEncontrado.nome;
    }

    papel.style.backgroundColor = '';
    const frame = papel.querySelector('.cert-border-frame');
    if (frame) frame.style.borderColor = '';
}

/**
 * Alterna rapidamente entre os modelos disponíveis (botão do preview)
 */
function trocarModeloRapido() {
    modeloAtualIndex = (modeloAtualIndex + 1) % modelosDisponiveis.length;
    const novoModelo = modelosDisponiveis[modeloAtualIndex];
    const thumbs = document.querySelectorAll('.model-thumb');
    selecionarModelo(novoModelo.id, thumbs[modeloAtualIndex]);
}

/**
 * Aplica as cores selecionadas no <select> de cor principal e secundária
 */
function atualizarEstiloCertificado() {
    const corPrincipal = document.getElementById('selectCorPrincipal')?.value;
    const corFundo = document.getElementById('selectCorSecundaria')?.value;
    const papel = document.getElementById('certificatePaper');
    const frame = papel?.querySelector('.cert-border-frame');

    if (papel && frame && corPrincipal && corFundo) {
        papel.style.backgroundColor = corFundo;
        frame.style.borderColor = corPrincipal;

        const mainTitle = document.getElementById('prevTitulo');
        const studentName = document.getElementById('prevStudentName');
        if (mainTitle) mainTitle.style.color = corPrincipal;
        if (studentName) studentName.style.color = corPrincipal;
    }
}

/**
 * Altera a fonte dos participantes (Inscritos, Manual, CSV)
 */
function setFonteParticipantes(tipo, botao) {
    const botoes = document.querySelectorAll('.btn-source');
    botoes.forEach(b => b.classList.remove('active'));
    if (botao) botao.classList.add('active');

    const lblInscritos = document.getElementById('lblQtdInscritos');
    const inputQtd = document.getElementById('inputQtdCertificados');

    if (tipo === 'inscritos') {
        if (inputQtd) inputQtd.value = 248;
        if (lblInscritos) lblInscritos.textContent = '248';
        atualizarQtdCertificados(248);
        notificarCert('Lista sincronizada com os 248 inscritos confirmados.', 'ok');
    } else if (tipo === 'manual') {
        const manualQtd = prompt('Digite quantos participantes deseja adicionar manualmente:', '15');
        const num = parseInt(manualQtd, 10);
        if (!isNaN(num) && num > 0) {
            if (inputQtd) inputQtd.value = num;
            if (lblInscritos) lblInscritos.textContent = num;
            atualizarQtdCertificados(num);
            notificarCert(`${num} participante(s) adicionado(s) manualmente.`, 'ok');
        }
    } else if (tipo === 'csv') {
        if (inputQtd) inputQtd.value = 150;
        if (lblInscritos) lblInscritos.textContent = '150';
        atualizarQtdCertificados(150);
        notificarCert('Planilha CSV importada com 150 participantes!', 'ok');
    }
}

/**
 * Sincroniza a quantidade de certificados nos resumos e botões
 */
function atualizarQtdCertificados(qtd) {
    const qtdNum = Math.max(1, parseInt(qtd, 10) || 1);
    const lblResumo = document.getElementById('lblResumoQtd');
    const btnTexto = document.getElementById('btnGerarTexto');
    const lblSucesso = document.getElementById('lblSucessoQtd');

    if (lblResumo) lblResumo.textContent = `${qtdNum} participantes`;
    if (btnTexto) btnTexto.textContent = `Gerar ${qtdNum} certificados`;
    if (lblSucesso) lblSucesso.textContent = qtdNum;
}

/**
 * Adiciona um terceiro bloco de autoridade dinamicamente
 */
function adicionarAutoridade() {
    const container = document.getElementById('containerAssinaturas');
    const rowAssinaturas = document.getElementById('prevSignaturesRow');
    const lblAutoridades = document.getElementById('lblResumoAutoridades');

    if (!container || !rowAssinaturas) return;

    const totalAtual = container.querySelectorAll('.form-grid-2').length + 1;
    if (totalAtual > 3) {
        notificarCert('O modelo suporta até 3 assinaturas para garantir a diagramação ideal.', 'info');
        return;
    }

    const novoBloco = document.createElement('div');
    novoBloco.className = 'form-grid-2';
    novoBloco.style.marginTop = '10px';
    novoBloco.innerHTML = `
        <div class="form-group">
            <label for="inputSig3Nome">Nome da Autoridade 3</label>
            <input type="text" id="inputSig3Nome" value="Prof. Dr. Ricardo Silva">
        </div>
        <div class="form-group">
            <label for="inputSig3Cargo">Cargo / Função</label>
            <input type="text" id="inputSig3Cargo" value="Coordenador Acadêmico">
        </div>
    `;
    container.appendChild(novoBloco);

    const novaSigPrev = document.createElement('div');
    novaSigPrev.className = 'sig-item';
    novaSigPrev.id = 'sigItem3';
    novaSigPrev.innerHTML = `
        <div class="sig-line-img" id="prevSig3Rubrica">Ricardo Silva</div>
        <strong id="prevSig3Nome">Prof. Dr. Ricardo Silva</strong>
        <span id="prevSig3Cargo">Coordenador Acadêmico</span>
    `;
    rowAssinaturas.appendChild(novaSigPrev);

    bindAssinatura('inputSig3Nome', 'prevSig3Nome', 'prevSig3Rubrica');
    bindAssinatura('inputSig3Cargo', 'prevSig3Cargo');

    if (lblAutoridades) lblAutoridades.textContent = '3 autoridades';
    notificarCert('3ª autoridade adicionada ao certificado.', 'ok');
}

/**
 * Ação de Gerar Certificados com feedback de carregamento
 */
function gerarCertificadosAcao() {
    const btn = document.getElementById('btnGerarCertificados');
    const successBox = document.getElementById('successBox');

    if (!btn || !successBox) return;

    const textoOriginal = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Processando certificados...';

    setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = textoOriginal;
        successBox.style.display = 'block';
        notificarCert('Certificados gerados com sucesso!', 'ok');
        successBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }, 650);
}

/**
 * Baixar certificados em PDF via janela de impressão estilizada (@media print)
 */
function baixarCertificadosPDF() {
    window.print();
}

/**
 * Simulação de envio por e-mail para todos os participantes
 */
function enviarCertificadosEmail() {
    const qtd = document.getElementById('inputQtdCertificados')?.value || '248';
    notificarCert(`Certificados enviados por e-mail para os ${qtd} participantes!`, 'ok');
}

/**
 * Salvar modelo de certificado
 */
function salvarModeloCertificado() {
    notificarCert('Modelo de certificado salvo com sucesso no perfil do organizador!', 'ok');
}

/**
 * Modal de visualização dos participantes
 */
function abrirModalParticipantes() {
    const modal = document.getElementById('modalParticipantes');
    if (modal) modal.style.display = 'flex';
}

function fecharModalParticipantes() {
    const modal = document.getElementById('modalParticipantes');
    if (modal) modal.style.display = 'none';
}

function popularListaParticipantesExemplo() {
    const listaUl = document.getElementById('listaParticipantesUl');
    if (!listaUl) return;

    const participantesExemplo = [
        { nome: 'Marina Oliveira', email: 'marina.oliveira@email.com', status: 'Confirmado' },
        { nome: 'Carlos Eduardo Santos', email: 'carlos.santos@email.com', status: 'Confirmado' },
        { nome: 'Beatriz Costa Pereira', email: 'beatriz.costa@email.com', status: 'Confirmado' },
        { nome: 'Lucas Martins Ferreira', email: 'lucas.m@email.com', status: 'Confirmado' },
        { nome: 'Juliana Rocha Lima', email: 'juliana.rocha@email.com', status: 'Confirmado' },
        { nome: 'Rafael Almeida', email: 'rafael.almeida@email.com', status: 'Confirmado' }
    ];

    listaUl.innerHTML = participantesExemplo.map(p => `
        <li>
            <div>
                <strong>${p.nome}</strong><br>
                <small style="color: #7d736f;">${p.email}</small>
            </div>
            <span style="color: #1e7e34; font-weight: 600; font-size: 0.8rem;">
                <i class="fa-solid fa-circle-check"></i> ${p.status}
            </span>
        </li>
    `).join('');
}
