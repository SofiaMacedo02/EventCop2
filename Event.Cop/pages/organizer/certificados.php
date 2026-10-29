<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';
require_once ROOT_PATH . '/data/organizador.php';

if (!eh_organizador()) {
    login_mock('organizador', 'marina@eventcop.com.br', 'demo');
}

$usuarioLogado = usuario_logado();
$nomeUsuario   = $usuarioLogado['nome'] ?? 'Marina Oliveira';

$pageTitle = 'Personalize seu certificado | EventCop';
$pageCss   = ['pages/certificados.css'];
$pageJs    = ['pages/certificados.js'];
$menuAtivo = 'admin';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="main-container">
    <main class="content-area">
        <div class="breadcrumb-header">
            <nav class="breadcrumb" aria-label="Navegação estrutural">
                <a href="<?= route('dashboard') ?>">Painel</a>
                <span class="sep">&gt;</span>
                <span>Certificados</span>
                <span class="sep">&gt;</span>
                <strong>Gerar certificados</strong>
            </nav>
            <a class="btn-back" href="<?= route('dashboard') ?>">
                <i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Voltar ao Painel
            </a>
        </div>

        <div class="page-title">
            <h1>Personalize seu certificado</h1>
            <p>Crie o modelo do certificado, adicione as informações do evento e gere automaticamente um certificado para cada participante.</p>
        </div>

        <!-- Grid de Edição x Preview -->
        <div class="certificate-editor-grid">
            <!-- Coluna Esquerda: Formulários de Configuração (Passos 1 a 4) -->
            <div class="editor-left-col">

                <!-- Passo 1: Informações -->
                <div class="card-box step-box">
                    <div class="step-header">
                        <span class="step-num">1</span>
                        <div>
                            <h3>Informações do certificado</h3>
                            <p>Preencha os dados que aparecerão no certificado.</p>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div class="form-group">
                            <label for="inputNomeEvento">Nome do evento</label>
                            <input type="text" id="inputNomeEvento" value="Workshop de Tecnologia 2026">
                        </div>
                        <div class="form-group">
                            <label for="inputCargaHoraria">Carga horária</label>
                            <input type="text" id="inputCargaHoraria" value="8 horas">
                        </div>
                        <div class="form-group">
                            <label for="inputTituloCertificado">Título do certificado</label>
                            <input type="text" id="inputTituloCertificado" value="Certificado de Participação">
                        </div>
                        <div class="form-group">
                            <label for="inputDataEvento">Data do evento</label>
                            <input type="text" id="inputDataEvento" value="15 de setembro de 2026">
                        </div>
                    </div>

                    <div class="form-grid-2" style="margin-top: 15px;">
                        <div class="form-group">
                            <label for="inputTextoCertificado">Texto do certificado</label>
                            <textarea id="inputTextoCertificado" rows="3">Certificamos que [Nome do participante] participou do Workshop de Tecnologia 2026, realizado no dia 15 de setembro de 2026, com carga horária de 8 horas.</textarea>
                            <small class="input-hint"><i class="fa-solid fa-circle-info" aria-hidden="true"></i> Use [Nome do participante] para inserir o nome automaticamente.</small>
                        </div>
                        <div class="form-group">
                            <label for="inputLocal">Local</label>
                            <input type="text" id="inputLocal" value="São José dos Campos - SP">
                        </div>
                    </div>
                </div>

                <!-- Passo 2: Personalize -->
                <div class="card-box step-box">
                    <div class="step-header">
                        <span class="step-num">2</span>
                        <div>
                            <h3>Personalize seu certificado</h3>
                            <p>Escolha as cores, fontes e elementos visuais.</p>
                        </div>
                    </div>

                    <div class="form-grid-2">
                        <div>
                            <div class="form-group">
                                <label for="selectCorPrincipal">Cor principal</label>
                                <select id="selectCorPrincipal" onchange="atualizarEstiloCertificado()">
                                    <option value="#5A0505" selected>#5A0505 (Vinho Institucional)</option>
                                    <option value="#b45309">#B45309 (Dourado / Ouro)</option>
                                    <option value="#065f46">#065F46 (Verde Esmeralda)</option>
                                    <option value="#1e3a8a">#1E3A8A (Azul Marinho)</option>
                                    <option value="#18181b">#18181B (Preto Nobre)</option>
                                </select>
                            </div>
                            <div class="form-group" style="margin-top: 12px;">
                                <label for="selectCorSecundaria">Cor de fundo do papel</label>
                                <select id="selectCorSecundaria" onchange="atualizarEstiloCertificado()">
                                    <option value="#fffdf9" selected>#FFFDF9 (Off-White)</option>
                                    <option value="#FFF8F2">#FFF8F2 (Creme Suave)</option>
                                    <option value="#FFFFFF">#FFFFFF (Branco Puro)</option>
                                    <option value="#FDFBF7">#FDFBF7 (Marfim Clássico)</option>
                                </select>
                            </div>
                        </div>

                        <div class="model-selector-wrapper">
                            <label>Escolha um modelo rápido</label>
                            <div class="models-thumbs-grid">
                                <div class="model-thumb active" onclick="selecionarModelo('vinho', this)" title="Modelo Vinho Clássico">
                                    <div class="thumb-preview m-vinho"></div>
                                    <i class="fa-solid fa-circle-check check-icon" aria-hidden="true"></i>
                                </div>
                                <div class="model-thumb" onclick="selecionarModelo('dourado', this)" title="Modelo Dourado Elegante">
                                    <div class="thumb-preview m-dourado"></div>
                                    <i class="fa-solid fa-circle-check check-icon" aria-hidden="true"></i>
                                </div>
                                <div class="model-thumb" onclick="selecionarModelo('verde', this)" title="Modelo Verde Corporativo">
                                    <div class="thumb-preview m-verde"></div>
                                    <i class="fa-solid fa-circle-check check-icon" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passo 3: Assinaturas e Autoridades -->
                <div class="card-box step-box">
                    <div class="step-header">
                        <span class="step-num">3</span>
                        <div>
                            <h3>Assinaturas e autoridades</h3>
                            <p>Adicione os responsáveis que assinarão o certificado.</p>
                        </div>
                    </div>

                    <div class="sig-inputs-group" id="containerAssinaturas">
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label for="inputSig1Nome">Nome da Autoridade 1</label>
                                <input type="text" id="inputSig1Nome" value="Mariana Souza">
                            </div>
                            <div class="form-group">
                                <label for="inputSig1Cargo">Cargo / Função</label>
                                <input type="text" id="inputSig1Cargo" value="Diretora do Evento">
                            </div>
                        </div>
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label for="inputSig2Nome">Nome da Autoridade 2</label>
                                <input type="text" id="inputSig2Nome" value="Carlos Oliveira">
                            </div>
                            <div class="form-group">
                                <label for="inputSig2Cargo">Cargo / Função</label>
                                <input type="text" id="inputSig2Cargo" value="Palestrante Principal">
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn-add-sig" onclick="adicionarAutoridade()">
                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Adicionar outra autoridade
                    </button>
                </div>

                <!-- Passo 4: Participantes -->
                <div class="card-box step-box">
                    <div class="step-header">
                        <span class="step-num">4</span>
                        <div>
                            <h3>Participantes</h3>
                            <p>Selecione os participantes que receberão os certificados.</p>
                        </div>
                    </div>

                    <div class="tab-source-buttons">
                        <button type="button" class="btn-source active" onclick="setFonteParticipantes('inscritos', this)"><i class="fa-solid fa-users" aria-hidden="true"></i> Inscritos no evento</button>
                        <button type="button" class="btn-source" onclick="setFonteParticipantes('manual', this)"><i class="fa-solid fa-user-plus" aria-hidden="true"></i> Adicionar manualmente</button>
                        <button type="button" class="btn-source" onclick="setFonteParticipantes('csv', this)"><i class="fa-solid fa-file-csv" aria-hidden="true"></i> Importar lista (CSV)</button>
                    </div>

                    <div class="participants-info-banner">
                        <div>
                            <i class="fa-solid fa-circle-check green-icon" aria-hidden="true"></i>
                            <span><strong id="lblQtdInscritos">248</strong> participantes confirmados no evento.</span>
                        </div>
                        <button type="button" class="btn-view-list" onclick="abrirModalParticipantes()">
                            <i class="fa-regular fa-eye" aria-hidden="true"></i> Visualizar lista
                        </button>
                    </div>

                    <div class="qtd-control-wrapper">
                        <label for="inputQtdCertificados">Quantidade de certificados a emitir:</label>
                        <input type="number" id="inputQtdCertificados" value="248" min="1" max="1000" onchange="atualizarQtdCertificados(this.value)">
                    </div>
                </div>

            </div>

            <!-- Coluna Direita: Preview Sticky + Passo 5 (Resumo e Ação) -->
            <div class="editor-right-col">

                <!-- PRÉ-VISUALIZAÇÃO DO CERTIFICADO -->
                <div class="preview-sticky-container">
                    <div class="preview-header-title">
                        <span><i class="fa-regular fa-eye" aria-hidden="true"></i> Pré-visualização do certificado</span>
                        <button type="button" class="btn-change-model-sm" onclick="trocarModeloRapido()">
                            <i class="fa-solid fa-arrows-rotate" aria-hidden="true"></i> Trocar modelo
                        </button>
                    </div>

                    <!-- O CERTIFICADO IMPRESSO REAL -->
                    <div class="certificate-paper-preview model-vinho" id="certificatePaper">
                        <div class="cert-border-frame">
                            <div class="cert-header">
                                <div class="cert-brand-name">EventCop</div>
                            </div>
                            <h2 class="cert-main-title" id="prevTitulo">CERTIFICADO DE PARTICIPAÇÃO</h2>
                            <div class="cert-subtitle" id="prevSubtitulo">EVENTCOP RECONHECIMENTO</div>
                            <div class="cert-certifies">Certificamos que</div>
                            <div class="cert-student-name" id="prevStudentName"><?= e($nomeUsuario) ?></div>
                            <p class="cert-body-text" id="prevText">
                                participou do Workshop de Tecnologia 2026, realizado no dia 15 de setembro de 2026, com carga horária de 8 horas.
                            </p>
                            <div class="cert-location" id="prevLocation">São José dos Campos - SP, 15 de setembro de 2026.</div>

                            <div class="cert-signatures-row" id="prevSignaturesRow">
                                <div class="sig-item">
                                    <div class="sig-line-img" id="prevSig1Rubrica">Mariana Souza</div>
                                    <strong id="prevSig1Nome">Mariana Souza</strong>
                                    <span id="prevSig1Cargo">Diretora do Evento</span>
                                </div>
                                <div class="sig-item">
                                    <div class="sig-line-img" id="prevSig2Rubrica">Carlos Oliveira</div>
                                    <strong id="prevSig2Nome">Carlos Oliveira</strong>
                                    <span id="prevSig2Cargo">Palestrante Principal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Passo 5: Revisar e gerar -->
                <div class="card-box step-box">
                    <div class="step-header">
                        <span class="step-num">5</span>
                        <div>
                            <h3>Revisar e gerar</h3>
                            <p>Revise o resumo antes de emitir os certificados.</p>
                        </div>
                    </div>
                    <div class="review-summary-list">
                        <div class="review-item">
                            <span><i class="fa-solid fa-award" aria-hidden="true"></i> Modelo do certificado</span>
                            <strong id="lblResumoModelo">Vinho Institucional</strong>
                        </div>
                        <div class="review-item">
                            <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> Evento</span>
                            <strong id="lblResumoEvento">Workshop de Tecnologia 2026</strong>
                        </div>
                        <div class="review-item">
                            <span><i class="fa-solid fa-users" aria-hidden="true"></i> Total de Participantes</span>
                            <strong id="lblResumoQtd">248 participantes</strong>
                        </div>
                        <div class="review-item">
                            <span><i class="fa-solid fa-signature" aria-hidden="true"></i> Autoridades / Assinaturas</span>
                            <strong id="lblResumoAutoridades">2 autoridades</strong>
                        </div>
                    </div>
                    <button type="button" class="btn-generate-main" id="btnGerarCertificados" onclick="gerarCertificadosAcao()">
                        <i class="fa-solid fa-award" aria-hidden="true"></i> <span id="btnGerarTexto">Gerar 248 certificados</span>
                    </button>
                    <small class="cert-gen-subnote"><i class="fa-solid fa-lock" aria-hidden="true"></i> Certificados gerados com assinatura digital e código de autenticidade.</small>
                </div>

                <!-- Seção de Sucesso e Ações de Download -->
                <div class="card-box success-banner-box" id="successBox" style="display: none;">
                    <div class="success-banner-header">
                        <div class="check-circle-lg"><i class="fa-solid fa-check" aria-hidden="true"></i></div>
                        <div>
                            <h4><span id="lblSucessoQtd">248</span> certificados emitidos com sucesso!</h4>
                            <p>Todos os certificados foram gerados e estão prontos para distribuição.</p>
                        </div>
                    </div>
                    <div class="success-actions-row">
                        <button type="button" class="btn-download-pdf" onclick="baixarCertificadosPDF()">
                            <i class="fa-solid fa-download" aria-hidden="true"></i> Baixar todos (PDF)
                        </button>
                        <button type="button" class="btn-send-email" onclick="enviarCertificadosEmail()">
                            <i class="fa-regular fa-envelope" aria-hidden="true"></i> Enviar por e-mail
                        </button>
                    </div>
                </div>

                <div class="bottom-save-row">
                    <small><i class="fa-solid fa-circle-info" aria-hidden="true"></i> Você pode salvar este modelo para usar em futuros eventos.</small>
                    <button type="button" class="btn-save-template" onclick="salvarModeloCertificado()">Salvar modelo</button>
                </div>
            </div>
        </div>
    </main>
</div>

<!-- MODAL DE LISTA DE PARTICIPANTES -->
<div class="modal-overlay" id="modalParticipantes" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h4><i class="fa-solid fa-users" aria-hidden="true"></i> Lista de Participantes</h4>
            <button type="button" class="btn-close-modal" onclick="fecharModalParticipantes()" aria-label="Fechar modal">&times;</button>
        </div>
        <div class="modal-body">
            <ul class="participants-list-ul" id="listaParticipantesUl">
                <!-- Gerado via JavaScript -->
            </ul>
        </div>
    </div>
</div>

<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
