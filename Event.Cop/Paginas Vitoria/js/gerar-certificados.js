/**
 * Gerenciador e Pré-visualizador de Certificados - EventCop
 * Permite personalização em tempo real, troca de modelos e emissão/download.
 */

document.addEventListener('DOMContentLoaded', () => {
    inicializarBindsTempoReal();
    popularListaParticipantesExemplo();
});

// Modelos pré-configurados
const modelosDisponiveis = [
    { id: 'vinho', nome: 'Vinho Institucional', corPrincipal: '#5A0505', corFundo: '#fffdf9' },
    { id: 'dourado', nome: 'Dourado Elegante', corPrincipal: '#b45309', corFundo: '#fdfaf3' },
    { id: 'verde', nome: 'Verde Corporativo', corPrincipal: '#065f46', corFundo: '#f0fdf4' }
];

let modeloAtualIndex = 0;

/**
 * Vincula todos os inputs aos respectivos elementos da pré-visualização
 */
function inicializarBindsTempoReal() {
    // 1. Título do Certificado
    const inputTitulo = document.getElementById('inputTituloCertificado');
    const prevTitulo = document.getElementById('prevTitulo');
    if (inputTitulo && prevTitulo) {
        inputTitulo.addEventListener('input', (e) => {
            prevTitulo.textContent = e.target.value.toUpperCase() || 'CERTIFICADO';
        });
    }

    // 2. Nome do Evento
    const inputNomeEvento = document.getElementById('inputNomeEvento');
    const lblResumoEvento = document.getElementById('lblResumoEvento');
    if (inputNomeEvento && lblResumoEvento) {
        inputNomeEvento.addEventListener('input', (e) => {
            lblResumoEvento.textContent = e.target.value || 'Evento';
        });
    }

    // 3. Texto do Certificado
    const inputTexto = document.getElementById('inputTextoCertificado');
    const prevText = document.getElementById('prevText');
    if (inputTexto && prevText) {
        inputTexto.addEventListener('input', (e) => {
            let texto = e.target.value;
            // Se tiver o placeholder [Nome do participante], remove dele para manter o nome em destaque
            texto = texto.replace('[Nome do participante]', '').trim();
            prevText.textContent = texto;
        });
    }

    // 4. Data e Local
    const inputLocal = document.getElementById('inputLocal');
    const inputData = document.getElementById('inputDataEvento');
    const prevLocation = document.getElementById('prevLocation');
    const atualizarLocalData = () => {
        const local = inputLocal ? inputLocal.value : 'São Paulo - SP';
        const data = inputData ? inputData.value : '15 de setembro de 2026';
        if (prevLocation) {
            prevLocation.textContent = `${local}, ${data}.`;
        }
    };
    if (inputLocal) inputLocal.addEventListener('input', atualizarLocalData);
    if (inputData) inputData.addEventListener('input', atualizarLocalData);

    // 5. Autoridades / Assinaturas 1 e 2
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

    // Atualiza classes ativas nas miniaturas
    thumbs.forEach(t => t.classList.remove('active'));
    if (elThumb) {
        elThumb.classList.add('active');
    }

    // Remove classes anteriores
    papel.classList.remove('model-vinho', 'model-dourado', 'model-verde');
    papel.classList.add(`model-${idModelo}`);

    const modeloEncontrado = modelosDisponiveis.find(m => m.id === idModelo);
    if (modeloEncontrado) {
        if (selectPrincipal) selectPrincipal.value = modeloEncontrado.corPrincipal;
        if (lblResumo) lblResumo.textContent = modeloEncontrado.nome;
    }

    // Limpa custom styles diretos para prevalecer a classe do tema
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
    } else if (tipo === 'manual') {
        const manualQtd = prompt('Digite quantos participantes deseja adicionar manualmente:', '1');
        const num = parseInt(manualQtd, 10);
        if (!isNaN(num) && num > 0) {
            if (inputQtd) inputQtd.value = num;
            if (lblInscritos) lblInscritos.textContent = num;
            atualizarQtdCertificados(num);
        }
    } else if (tipo === 'csv') {
        alert('Funcionalidade de importação de arquivo CSV/Excel ativada. Selecione sua planilha com nomes e e-mails.');
        if (inputQtd) inputQtd.value = 150;
        if (lblInscritos) lblInscritos.textContent = '150';
        atualizarQtdCertificados(150);
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
        alert('O modelo suporta até 3 assinaturas para garantir a diagramação visual ideal.');
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

    // Adiciona na pré-visualização
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

        // Rolagem suave até a confirmação
        successBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }, 900);
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
    alert(`Sucesso! Os certificados personalizados foram colocados na fila de envio e estão sendo disparados para os ${qtd} participantes.`);
}

/**
 * Salvar modelo de certificado
 */
function salvarModeloCertificado() {
    alert('Modelo de certificado salvo com sucesso no perfil do organizador!');
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
