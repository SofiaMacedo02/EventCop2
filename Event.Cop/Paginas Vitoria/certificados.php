<?php
require_once __DIR__ . '/auth.php';
$estaLogado = estaLogado();
$usuarioLogado = obterUsuarioLogado();
$nomeUsuario = $usuarioLogado['nome'] ?? 'Usuário';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventCop - Personalize seu certificado</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <a href="../Paginas Leticia/index.php">
        <img src="../imgs/logo_footer.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="../Paginas Leticia/index.php">Home</a></li>
            <li><a href="../Paginas Leticia/empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Leticia/cases.php">Cases</a></li>
            <li><a href="../Paginas Leticia/planos_precos.php">Planos e Preços</a></li>
            <?php if ($estaLogado): ?>
                <li><span style="color: #6a1b29; font-weight: bold;">Olá, <?= htmlspecialchars($nomeUsuario) ?></span></li>
                <li><a href="../Paginas Macedo/logout.php" style="color: #c94b4b;">Sair</a></li>
            <?php else: ?>
                <li><a href="../Paginas Macedo/login_organizadores.php">Sou um organizador</a></li>
                <li><a href="../Paginas Macedo/login_normal.php">Entrar</a></li>
            <?php endif; ?>
            <li><a href="../Paginas Macedo/criar_evento.php" class="btn-header">Criar Evento</a></li>
        </ul>
    </nav>
</header>

    <div class="main-container">
        <main class="content-area">
            <div class="breadcrumb-header">
                <div class="breadcrumb">
                    <span>Certificados</span> &gt; <strong>Gerar certificados</strong>
                </div>
                <button class="btn-back" onclick="window.location.href='../Paginas Leticia/index.php'">
                    <i class="fa-solid fa-arrow-left"></i> Voltar para Home
                </button>
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
                                <small class="input-hint"><i class="fa-solid fa-circle-info"></i> Use [Nome do participante] para inserir o nome automaticamente.</small>
                            </div>
                            <div class="form-group">
                                <label for="inputLocal">Local</label>
                                <input type="text" id="inputLocal" value="São Paulo - SP">
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
                                        <i class="fa-solid fa-circle-check check-icon"></i>
                                    </div>
                                    <div class="model-thumb" onclick="selecionarModelo('dourado', this)" title="Modelo Dourado Elegante">
                                        <div class="thumb-preview m-dourado"></div>
                                        <i class="fa-solid fa-circle-check check-icon"></i>
                                    </div>
                                    <div class="model-thumb" onclick="selecionarModelo('verde', this)" title="Modelo Verde Corporativo">
                                        <div class="thumb-preview m-verde"></div>
                                        <i class="fa-solid fa-circle-check check-icon"></i>
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
                            <i class="fa-solid fa-plus"></i> Adicionar outra autoridade
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
                            <button type="button" class="btn-source active" onclick="setFonteParticipantes('inscritos', this)"><i class="fa-solid fa-users"></i> Inscritos no evento</button>
                            <button type="button" class="btn-source" onclick="setFonteParticipantes('manual', this)"><i class="fa-solid fa-user-plus"></i> Adicionar manualmente</button>
                            <button type="button" class="btn-source" onclick="setFonteParticipantes('csv', this)"><i class="fa-solid fa-file-csv"></i> Importar lista (CSV)</button>
                        </div>

                        <div class="participants-info-banner">
                            <div>
                                <i class="fa-solid fa-circle-check green-icon"></i>
                                <span><strong id="lblQtdInscritos">248</strong> participantes confirmados no evento.</span>
                            </div>
                            <button type="button" class="btn-view-list" onclick="abrirModalParticipantes()">
                                <i class="fa-regular fa-eye"></i> Visualizar lista
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
                            <span><i class="fa-regular fa-eye"></i> Pré-visualização do certificado</span>
                            <button type="button" class="btn-change-model-sm" onclick="trocarModeloRapido()">
                                <i class="fa-solid fa-arrows-rotate"></i> Trocar modelo
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
                                <div class="cert-student-name" id="prevStudentName">Marina Oliveira</div>
                                <p class="cert-body-text" id="prevText">
                                    participou do Workshop de Tecnologia 2026, realizado no dia 15 de setembro de 2026, com carga horária de 8 horas.
                                </p>
                                <div class="cert-location" id="prevLocation">São Paulo - SP, 15 de setembro de 2026.</div>

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
                                <span><i class="fa-solid fa-award"></i> Modelo do certificado</span>
                                <strong id="lblResumoModelo">Vinho Institucional</strong>
                            </div>
                            <div class="review-item">
                                <span><i class="fa-regular fa-calendar"></i> Evento</span>
                                <strong id="lblResumoEvento">Workshop de Tecnologia 2026</strong>
                            </div>
                            <div class="review-item">
                                <span><i class="fa-solid fa-users"></i> Total de Participantes</span>
                                <strong id="lblResumoQtd">248 participantes</strong>
                            </div>
                            <div class="review-item">
                                <span><i class="fa-solid fa-signature"></i> Autoridades / Assinaturas</span>
                                <strong id="lblResumoAutoridades">2 autoridades</strong>
                            </div>
                        </div>
                        <button type="button" class="btn-generate-main" id="btnGerarCertificados" onclick="gerarCertificadosAcao()">
                            <i class="fa-solid fa-award"></i> <span id="btnGerarTexto">Gerar 248 certificados</span>
                        </button>
                        <small class="cert-gen-subnote"><i class="fa-solid fa-lock"></i> Certificados gerados com assinatura digital e código de autenticidade.</small>
                    </div>
                    <!-- Seção de Sucesso e Ações de Download -->
                    <div class="card-box success-banner-box" id="successBox" style="display: none;">
                        <div class="success-banner-header">
                            <div class="check-circle-lg"><i class="fa-solid fa-check"></i></div>
                            <div>
                                <h4><span id="lblSucessoQtd">248</span> certificados emitidos com sucesso!</h4>
                                <p>Todos os certificados foram gerados e estão prontos para distribuição.</p>
                            </div>
                        </div>
                        <div class="success-actions-row">
                            <button type="button" class="btn-download-pdf" onclick="baixarCertificadosPDF()">
                                <i class="fa-solid fa-download"></i> Baixar todos (PDF)
                            </button>
                            <button type="button" class="btn-send-email" onclick="enviarCertificadosEmail()">
                                <i class="fa-regular fa-envelope"></i> Enviar por e-mail
                            </button>
                        </div>
                    </div>
                    <div class="bottom-save-row">
                        <small><i class="fa-solid fa-circle-info"></i> Você pode salvar este modelo para usar em futuros eventos.</small>
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
                <h4><i class="fa-solid fa-users"></i> Lista de Participantes</h4>
                <button type="button" class="btn-close-modal" onclick="fecharModalParticipantes()">&times;</button>
            </div>
            <div class="modal-body">
                <ul class="participants-list-ul" id="listaParticipantesUl">
                    <!-- Gerado via JavaScript -->
                </ul>
            </div>
        </div>

<footer class="footer">
    <div class="footer-coluna footer-empresa">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-footer">
        <p class="descricao-footer">
            A plataforma completa para planejar,
            organizar e executar eventos
            corporativos com eficiência.
        </p>
        <div class="traco"></div>
        <div class="footer-info">
            <img src="../imgs/imagem localizacao footer.png" alt="Localização">
            <p>Avenida das Nações, nº 850 <br> São José dos Campos - SP <br> CEP: 12227-000 </p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem CNPJ footer.png" alt="Documento">
            <p>CNPJ: 48.729.315/0001-62</p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem e-mail footer.png" alt="E-mail">
            <p> contato@eventcop.com.br </p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem telefone footer.png" alt="Telefone">
            <p> (12) 3456-7890</p>
        </div>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem calendario footer.png" alt="Calendário">
            <div>
                <h3>Tipos de Eventos</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="../Paginas Leticia/cases.php">› Corporativos</a>
        <a href="../Paginas Leticia/cases.php">› Workshops e Palestras</a>
        <a href="../Paginas Leticia/cases.php">› Treinamentos</a>
        <a href="../Paginas Leticia/cases.php">› Feiras e Exposições</a>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem recursos plataforma footer.png" alt="Recursos">
            <div>
                <h3>Recursos da Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="../Paginas Macedo/criar_evento.php">› Gestão de Eventos</a>
        <a href="../Paginas Macedo/inscricao.php">› Inscrições e Convites</a>
        <a href="../Paginas Leticia/empresas.php">› Relatórios e Métricas</a>
        <a href="../Paginas Leticia/agenda_consultores.php">› Agendamento com Consultores</a>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem comece na plataforma footer.png" alt="Comece na plataforma">
            <div>
                <h3>Comece na Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="../Paginas Macedo/cadastro_normal.php">› Criar minha conta</a>
        <a href="../Paginas Macedo/cadastro_organizador.php">› Quero organizar um evento</a>
        <div class="ajuda">
            <img src="../imgs/imagem precisa de ajuda footer.png" alt="Atendimento" class="fone-ajuda">
            <div>
                <h3>Precisa de ajuda?</h3>
                <p>Nossa equipe está pronta<br>para te atender!</p>
                <a href="../Paginas Leticia/agenda_consultores.php" class="btn-fale"> Fale conosco <span>→</span> </a>
            </div>
        </div>
    </div>
    <div class="footer-baixo">
        <div class="redes">
            <strong>Siga-nos</strong>
            <img src="../imgs/imagem redes sociais footer.png" alt="Instagram, LinkedIn e YouTube">
        </div>
        <p> © 2026 EventCop. Todos os direitos reservados.</p>
        <div class="footer-politicas">
            <a href=""> Política de Privacidade</a>
            <span>|</span>
            <a href="">Termos de Uso</a>
        </div>
    </div>
</footer> 
    <script src="js/gerar-certificados.js"></script>
</body>
</html>
