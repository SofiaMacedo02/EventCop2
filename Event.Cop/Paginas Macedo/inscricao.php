<?php
require_once "inscricao.php";
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

$sucesso = false;
$erro = "";
$evento = null;
$id_evento = isset($_GET["id_evento"]) ? (int)$_GET["id_evento"] : 0;

// Buscar detalhes do evento se houver ID
if ($id_evento > 0) {
    try {
        $stmtEv = $pdo->prepare("SELECT * FROM eventos WHERE id_event = :id LIMIT 1");
        $stmtEv->bindParam(':id', $id_evento, PDO::PARAM_INT);
        $stmtEv->execute();
        $evento = $stmtEv->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar evento: " . $e->getMessage());
    }
}

// Fallback: se nenhum evento específico foi selecionado, busca o primeiro cadastrado
if (!$evento) {
    try {
        $stmtPrimeiro = $pdo->query("SELECT * FROM eventos ORDER BY id_event ASC LIMIT 1");
        $evento = $stmtPrimeiro->fetch(PDO::FETCH_ASSOC);
        if ($evento) {
            $id_evento = (int)$evento['id_event'];
        }
    } catch (PDOException $e) {
        error_log("Erro fallback evento: " . $e->getMessage());
    }
}

// Se o usuário já estiver autenticado, pré-preencher
$usuarioLogado = obterUsuarioLogado();
$nomePre = $usuarioLogado['nome'] ?? '';
$emailPre = $usuarioLogado['email'] ?? '';

// Processamento POST da Inscrição
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    $forma_pagamento = trim($_POST["forma_pagamento"] ?? "pix");
    $id_evento_post = (int)($_POST["id_evento"] ?? $id_evento);

    if (!empty($nome) && !empty($email) && !empty($telefone)) {
        try {
            // 1. Identificar ou Criar o Usuário Participante
            $id_user = null;
            if (estaLogado() && !ehOrganizador()) {
                $id_user = $_SESSION["user_id"];
            } else {
                $stmtUser = $pdo->prepare("SELECT id_user FROM usuarios WHERE email_user = :email LIMIT 1");
                $stmtUser->bindParam(':email', $email, PDO::PARAM_STR);
                $stmtUser->execute();
                $userExiste = $stmtUser->fetch(PDO::FETCH_ASSOC);

                if ($userExiste) {
                    $id_user = $userExiste['id_user'];
                } else {
                    $senhaHash = password_hash("eventcop123", PASSWORD_DEFAULT);
                    $stmtNovo = $pdo->prepare("INSERT INTO usuarios (nome_user, email_user, senha_user, telefone_user) VALUES (:nome, :email, :senha, :telefone)");
                    $stmtNovo->bindParam(':nome', $nome, PDO::PARAM_STR);
                    $stmtNovo->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmtNovo->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
                    $stmtNovo->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                    $stmtNovo->execute();
                    $id_user = $pdo->lastInsertId();
                }
            }

            // 2. Garantir que temos um evento associado
            if ($id_evento_post <= 0) {
                // Se ainda não houver eventos cadastrados no banco, criamos um evento padrão
                $stmtEvDefault = $pdo->query("SELECT id_event FROM eventos LIMIT 1");
                $evDefault = $stmtEvDefault->fetch(PDO::FETCH_ASSOC);
                if ($evDefault) {
                    $id_evento_post = $evDefault['id_event'];
                } else {
                    // Criar organizador padrão se não houver
                    $pdo->query("INSERT INTO organizadores (nome_orga, email_orga, senha_orga, telefone_orga) VALUES ('EventCop Oficial', 'contato@eventcop.com.br', '123456', '(12) 3456-7890')");
                    $orgaId = $pdo->lastInsertId();
                    $pdo->query("INSERT INTO eventos (nome_event, descricao, cidade, estado, tipo, categoria, formato, id_orga, data_event, hora_event) 
                                 VALUES ('Workshop Geral EventCop 2026', 'Workshop oficial de capacitação e tecnologia', 'São José dos Campos', 'SP', '1', '1', 'presencial', $orgaId, CURDATE(), '14:00:00')");
                    $id_evento_post = $pdo->lastInsertId();
                }
            }

            // 3. Verificar se já está inscrito
            $stmtCheck = $pdo->prepare("SELECT id_cliente_evento FROM clientes_eventos WHERE id_user = :user AND id_event = :event LIMIT 1");
            $stmtCheck->bindParam(':user', $id_user, PDO::PARAM_INT);
            $stmtCheck->bindParam(':event', $id_evento_post, PDO::PARAM_INT);
            $stmtCheck->execute();

            if ($stmtCheck->fetch()) {
                $sucesso = true;
                $mensagem_info = "Você já possui uma inscrição confirmada para este evento!";
            } else {
                $stmtInsc = $pdo->prepare("INSERT INTO clientes_eventos (id_user, id_event) VALUES (:user, :event)");
                $stmtInsc->bindParam(':user', $id_user, PDO::PARAM_INT);
                $stmtInsc->bindParam(':event', $id_evento_post, PDO::PARAM_INT);
                $stmtInsc->execute();
                $sucesso = true;
                $mensagem_info = "Inscrição realizada e confirmada com sucesso!";
            }
        } catch (PDOException $e) {
            error_log("Erro ao processar inscrição: " . $e->getMessage());
            $erro = "Erro ao processar sua inscrição. Tente novamente mais tarde.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição no Evento - EventCop</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header class="header">
    <a href="index.php"> <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header"> </a>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Macedo/login_organizadores.php">Sou adm</a></li>
            <li><a href="../Paginas Macedo/login_normal.php" class="btn-header">Entrar</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="banner">
        <div class="banner-texto">
            <h1><?= $evento ? htmlspecialchars($evento['nome_event']) : "Garanta sua vaga no EventCop" ?></h1>
            <p>Inscreva-se e receba seu kit de boas-vindas com certificado de participação exclusivo!</p>
        </div>
    </section>

    <div class="form-wizard">
        <?php if ($sucesso): ?>
            <div style="background-color: #d4edda; color: #155724; padding: 25px; border-radius: 10px; margin: 30px auto; max-width: 650px; text-align: center; border: 1px solid #c3e6cb;">
                <h2 style="color: #2d6a4f; margin-bottom: 10px;">Inscrição Confirmada!</h2>
                <p style="font-size: 16px;"><?= htmlspecialchars($mensagem_info) ?></p>
                <div style="margin-top: 15px; padding: 15px; background: #fff; border-radius: 8px; border: 1px dashed #2d6a4f;">
                    <strong>Evento:</strong> <?= htmlspecialchars($evento['nome_event'] ?? 'Workshop EventCop') ?><br>
                    <strong>Participante:</strong> <?= htmlspecialchars($nome) ?><br>
                    <strong>E-mail:</strong> <?= htmlspecialchars($email) ?>
                </div>
                <p style="margin-top: 15px; font-size: 14px; color: #555;">Enviamos as credenciais e o comprovante de acesso para o seu e-mail cadastrado.</p>
                <div style="margin-top: 20px;">
                    <a href="../Paginas Leticia/index.php" class="btn_cadastrar" style="text-decoration: none; display: inline-block; padding: 10px 25px;">Voltar para o Início</a>
                </div>
            </div>
        <?php else: ?>

            <?php if (!empty($erro)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin: 15px auto; max-width: 700px; border: 1px solid #f5c6cb; text-align: center;">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form class="formulario_inscricao_completo" action="inscricao.php<?= $id_evento ? '?id_evento=' . $id_evento : '' ?>" method="POST">
                <input type="hidden" name="id_evento" value="<?= $id_evento ?>">
                <input type="hidden" id="forma_pagamento_selecionada" name="forma_pagamento" value="pix">

                <section class="junta_incriao">
                    <section class="cadastro_organizador active">
                        <h1>Inscreva-se Já!</h1>
                        <p>Preencha os dados do participante abaixo:</p>
                        <div style="margin-top: 15px;">
                            <label for="nome">Seu Nome Completo:</label>
                            <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? $nomePre) ?>" required>
                            
                            <label for="email">Seu E-mail:</label>
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $emailPre) ?>" required> 
                            
                            <label for="telefone">Telefone celular / WhatsApp:</label>
                            <input type="tel" id="telefone" name="telefone" placeholder="(12) 99999-9999" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" required>
                        </div>
                    </section>

                    <section class="pagamentos">
                        <h1>Forma de Pagamento</h1>
                        <p>Escolha como deseja confirmar sua inscrição:</p>
                        <div class="formas_pagamento">
                            <div id="pix">
                                <button type="button" class="btn-metodo"><span>Pix</span></button>
                            </div>
                            <div id="cartao">
                                <button type="button" class="btn-metodo"><span>Cartão de Crédito</span></button>
                            </div>
                            <div id="boleto">
                                <button type="button" class="btn-metodo"><span>Boleto</span></button>
                            </div>
                        </div>
                    </section>

                    <!-- SEÇÃO PIX -->
                    <section class="pagamento" id="sec-pix" hidden >
                        <div class="pagamento-corpo">
                            <div class="pagamento-formulario">
                                <div class="pagamento-titulo">
                                    <h2>Pague com PIX</h2>
                                    <p>Escaneie o QR Code ou copie o código Pix abaixo para pagamento imediato.</p>
                                </div>
                                <div class="pix-grupo">
                                    <label>Código Pix Copia e Cola:</label>
                                    <div class="pix-input-container">
                                        <input type="text" id="pix-input" value="00020126580014br.gov.bcb.pix0136eventcop@eventos.com.br" readonly>
                                        <button type="button" class="btn-copiar" id="copiar-pix">
                                            Copiar código Pix
                                        </button>
                                    </div>
                                </div>
                                <div class="alerta-seguranca">
                                    <div>
                                        <strong>Pagamento 100% seguro.</strong>
                                        <p>Seus dados estão protegidos pela EventCop.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagamento-rodape">
                            <div class="rodape-seguranca">
                                <div>
                                    <strong>Confirmação Imediata</strong>
                                    <p>Liberação automática da credencial.</p>
                                </div>
                            </div>
                            <div class="rodape-total">
                                <span class="label-total">Total da Inscrição:</span>
                                <span class="valor-total">R$ 40,00</span>
                            </div>
                            <button type="submit" class="btn-finalizar">
                                Finalizar Inscrição via Pix <span>→</span>
                            </button>
                        </div>
                    </section>

                    <!-- SEÇÃO CARTÃO -->
                    <section class="pagamento" id="sec-cartao" hidden>
                        <div class="pagamento-corpo">
                            <div class="pagamento-formulario">
                                <div class="pagamento-titulo">
                                    <h2>Pague com Cartão de Crédito</h2>
                                    <p>Preencha os dados do seu cartão e finalize sua inscrição com segurança.</p>
                                </div>
                                <div class="campo-grupo">
                                    <label>Número do Cartão:</label>
                                    <input type="text" name="cartao_numero" placeholder="0000 0000 0000 0000" maxlength="19">
                                </div>  
                                <div class="grupinho" style="display: flex; gap: 10px; margin-top: 10px;">
                                    <input type="text" name="cartao_nome" placeholder="Nome impresso no cartão">
                                    <input type="text" name="cartao_validade" placeholder="MM/AA" maxlength="5">
                                    <input type="text" name="cartao_cvv" placeholder="CVV" maxlength="4">
                                </div>
                                <div class="alerta-seguranca" style="margin-top: 15px;">
                                    <div>
                                        <strong>Ambiente Criptografado</strong>
                                        <p>Dados protegidos com certificado SSL.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagamento-rodape">
                            <div class="rodape-total">
                                <span class="label-total">Total da Inscrição:</span>
                                <span class="valor-total">R$ 40,00</span>
                            </div>
                            <button type="submit" class="btn-finalizar">
                                Finalizar Inscrição no Cartão <span>→</span>
                            </button>
                        </div>
                    </section>

                    <!-- SEÇÃO BOLETO -->
                    <section class="pagamento" id="sec-boleto" hidden>
                        <div class="pagamento-corpo">
                            <div class="pagamento-formulario">
                                <div class="pagamento-titulo">
                                    <h2>Pague com Boleto Bancário</h2>
                                    <p>Copie a linha digitável para pagar pelo internet banking ou em qualquer lotérica.</p>
                                </div>
                                <div class="pix-grupo">
                                    <label>Linha digitável:</label>
                                    <div class="pix-input-container">
                                        <input type="text" id="copia-input" value="34191.79000 01043.510047 91020.150008 7 9417000004000" readonly>
                                        <button type="button" class="btn-copiar" id="copiar-boleto">
                                            Copiar linha digitável
                                        </button>
                                    </div>
                                </div>
                                <div class="boleto-detalhes" style="margin-top: 15px;">
                                    <div class="detalhe-item">
                                        <small>Vencimento:</small>
                                        <strong><?= date('d/m/Y', strtotime('+3 days')) ?></strong>
                                    </div>
                                    <div class="detalhe-item">
                                        <small>Valor:</small>
                                        <strong>R$ 40,00</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pagamento-rodape">
                            <div class="rodape-total">
                                <span class="label-total">Total da Inscrição:</span>
                                <span class="valor-total">R$ 40,00</span>
                            </div>
                            <button type="submit" class="btn-finalizar">
                                Gerar Boleto e Finalizar <span>→</span>
                            </button>
                        </div>
                    </section>
                </section>
            </form>
        <?php endif; ?>
    </div>
</main>

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
            <p>Avenida das Nações, nº 850<br>São José dos Campos - SP<br>CEP: 12227-000</p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem CNPJ footer.png" alt="Documento">
            <p>CNPJ: 48.729.315/0001-62</p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem e-mail footer.png" alt="E-mail">
            <p>contato@eventcop.com.br</p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem telefone footer.png" alt="Telefone">
            <p>(12) 3456-7890</p>
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
        <a href="criar_evento.php">› Gestão de Eventos</a>
        <a href="inscricao.php">› Inscrições e Convites</a>
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
        <a href="cadastro_normal.php">› Criar minha conta</a>
        <a href="cadastro_organizador.php">› Quero organizar um evento</a>
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

</body>
</html>
