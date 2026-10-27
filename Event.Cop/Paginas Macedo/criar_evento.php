<?php
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

$mensagem_sucesso = "";
$mensagem_erro = "";

if (isset($_GET["criado"]) && $_GET["criado"] === "sucesso") {
    $mensagem_sucesso = "Evento criado com sucesso! Seu evento já está disponível para inscrições.";
}

if (isset($_GET["erro"])) {
    $mensagem_erro = "Ocorreu um erro ao criar o evento. Por favor, verifique os campos obrigatórios.";
}

// Processamento POST direto
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!estaLogado() || !ehOrganizador()) {
        header("Location: login_organizadores.php?aviso=faca_login");
        exit;
    }

    $id_orga = $_SESSION["user_id"];
    $nome_evento = trim($_POST["nome_evento"] ?? "");
    $descricao = trim($_POST["descricao"] ?? "");
    $categoria = $_POST["categoria"] ?? "1";
    $formato = $_POST["formato"] ?? "presencial";
    $cidade = trim($_POST["cidade"] ?? "São José dos Campos");
    $estado = strtoupper(trim($_POST["estado"] ?? "SP"));
    $tipo = $_POST["tipo"] ?? "1";

    $data_inicio_raw = $_POST["data_inicio"] ?? "";
    if (!empty($data_inicio_raw)) {
        $timestamp = strtotime($data_inicio_raw);
        $data_event = date("Y-m-d", $timestamp);
        $hora_event = date("H:i:s", $timestamp);
    } else {
        $data_event = date("Y-m-d", strtotime("+7 days"));
        $hora_event = "14:00:00";
    }

    if (!in_array($formato, ['presencial', 'online', 'hibrido'])) $formato = 'presencial';
    if (!in_array($categoria, ['1', '2', '3', '4'])) $categoria = '1';
    if (!in_array($tipo, ['1', '2'])) $tipo = '1';

    if (!empty($nome_evento) && !empty($descricao)) {
        try {
            $sql = "INSERT INTO eventos (nome_event, descricao, cidade, estado, tipo, categoria, formato, id_orga, data_event, hora_event)
                    VALUES (:nome, :descricao, :cidade, :estado, :tipo, :categoria, :formato, :id_orga, :data_event, :hora_event)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome_evento, PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
            $stmt->bindParam(':cidade', $cidade, PDO::PARAM_STR);
            $stmt->bindParam(':estado', $estado, PDO::PARAM_STR);
            $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
            $stmt->bindParam(':categoria', $categoria, PDO::PARAM_STR);
            $stmt->bindParam(':formato', $formato, PDO::PARAM_STR);
            $stmt->bindParam(':id_orga', $id_orga, PDO::PARAM_INT);
            $stmt->bindParam(':data_event', $data_event, PDO::PARAM_STR);
            $stmt->bindParam(':hora_event', $hora_event, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: criar_evento.php?criado=sucesso");
            exit;
        } catch (PDOException $e) {
            error_log("Erro ao salvar evento: " . $e->getMessage());
            $mensagem_erro = "Erro ao registrar o evento no banco de dados.";
        }
    } else {
        $mensagem_erro = "Por favor, preencha o nome e a descrição do evento.";
    }
}

// Buscar eventos cadastrados no banco
$eventos_cadastrados = [];

// 1. Verifica se existe um organizador logado na sessão
if (estaLogado() && ehOrganizador() && !empty($_SESSION["user_id"])) {
    $id_orga_logado = $_SESSION["user_id"];

    try {
        // 2. Consulta filtrando pelo id_orga do usuário logado
        $sql = "SELECT e.*, o.nome_orga 
                FROM eventos e 
                LEFT JOIN organizadores o ON e.id_orga = o.id_orga 
                WHERE e.id_orga = :id_orga 
                ORDER BY e.id_event DESC";

        $stmtEventos = $pdo->prepare($sql);
        $stmtEventos->bindParam(':id_orga', $id_orga_logado, PDO::PARAM_INT);
        $stmtEventos->execute();

        $eventos_cadastrados = $stmtEventos->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Erro ao buscar eventos do organizador: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar e Gerenciar Eventos - EventCop</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body class="body_criar_evento">

<header class="header">
    <a href="../Paginas Leticia/index.php">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="../Paginas Leticia/index.php">Home</a></li>
            <li><a href="../Paginas Leticia/empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Leticia/cases.php">Cases</a></li>
            <li><a href="../Paginas Leticia/planos_precos.php">Planos e Preços</a></li>
            <?php if (estaLogado()): ?>
                <li><span style="color: #f0f0f0; font-weight: bold;">Olá, <?= htmlspecialchars($_SESSION['user_nome'] ?? 'Organizador') ?></span></li>
                <li><a href="logout.php" style="color: #c94b4b;">Sair</a></li>
            <?php else: ?>
                <li><a href="login_organizadores.php">Sou um organizador</a></li>
            <?php endif; ?>
            <li><a href="criar_evento.php" class="btn-header">Criar Evento</a></li>
        </ul>
    </nav>
</header>

<main class="main_criar_evento">

    <?php if (!estaLogado() || !ehOrganizador()): ?>
        <div style="background-color: #fff3cd; color: #856404; padding: 15px; border-radius: 8px; margin: 20px auto; max-width: 900px; border: 1px solid #ffeeba; text-align: center;">
            <strong>Atenção:</strong> Você precisa estar conectado como <strong>Organizador</strong> para salvar novos eventos. 
            <a href="login_organizadores.php" style="color: #6a1b29; font-weight: bold; text-decoration: underline; margin-left: 10px;">Fazer Login</a> ou 
            <a href="cadastro_organizador.php" style="color: #6a1b29; font-weight: bold; text-decoration: underline; margin-left: 5px;">Cadastrar-se</a>.
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagem_sucesso)): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin: 20px auto; max-width: 900px; border: 1px solid #c3e6cb; text-align: center; font-weight: bold;">
            <?= htmlspecialchars($mensagem_sucesso) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($mensagem_erro)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin: 20px auto; max-width: 900px; border: 1px solid #f5c6cb; text-align: center;">
            <?= htmlspecialchars($mensagem_erro) ?>
        </div>
    <?php endif; ?>

    <form class="form-wizard" action="criar_evento.php" method="POST">
        <div class="formularios_eventos">
            <h1>Criar Evento</h1>
            <p>Siga as etapas para criar e publicar seu evento na plataforma.</p>

            <!-- 1. Informações Básicas -->
            <section class="cadastro_evento">
                <div class="progress-container" style="--step-size: 32px; --step-color: #e6d8ca; --main-color: #ee8f66; --progress-width: 100%;">
                    <div class="progress" style="transform: scaleX(0);"></div>
                    <ol>
                        <li class="active">1</li>
                        <li>2</li>
                        <li>3</li>
                        <li>4</li>
                    </ol>
                </div>

                <label for="nome_evento">Nome do Evento:</label>
                <input type="text" id="nome_evento" name="nome_evento" required placeholder="Ex.: Workshop de Inteligência Artificial 2026">
                
                <label for="descricao">Descrição do Evento:</label>
                <textarea id="descricao" name="descricao" required placeholder="Descreva os objetivos, palestrantes e diferenciais do seu evento..."></textarea>
                
                <div class="div_selects">
                    <div>
                        <label for="categoria">Categoria do Evento:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="1" selected>Workshop</option>
                            <option value="2">Corporativo</option>
                            <option value="3">Networking</option>
                            <option value="4">Educacional</option>
                        </select>
                    </div> 
                    <div>
                        <label for="tipo">Privacidade:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="1" selected>Evento Público</option>
                            <option value="2">Evento Privado</option>
                        </select>
                    </div> 
                </div>

                <div class="botoes">
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>
            
            <!-- 2. Data, Hora e Local -->
            <section class="cadastro_evento" hidden>
                <div class="progress-container" style="--step-size: 32px; --step-color: #e6d8ca; --main-color: #ee8f66; --progress-width: 100%;">
                    <div class="progress" style="transform: scaleX(0.33);"></div>
                    <ol>
                        <li class="active">1</li>
                        <li class="active">2</li>
                        <li>3</li>
                        <li>4</li>
                    </ol>
                </div>
                <div class="linha">
                    <section class="data_hora">
                        <h3>Data e Hora</h3>
                        <label for="data_inicio">Data e Hora de Início:</label>
                        <input type="datetime-local" id="data_inicio" name="data_inicio" required>

                        <label for="data_termino">Data e Hora de Término:</label>
                        <input type="datetime-local" id="data_termino" name="data_termino" required>
                    </section>
                    
                    <section class="local">
                        <h3>Local do evento</h3>
                        <div style="display: flex; gap: 10px;">
                            <div style="flex: 2;">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" name="cidade" value="São José dos Campos" required>
                            </div>
                            <div style="flex: 1;">
                                <label for="estado">UF:</label>
                                <input type="text" id="estado" name="estado" maxlength="2" value="SP" required>
                            </div>
                        </div>

                        <label for="nome_local">Nome do Local / Plataforma:</label>
                        <input type="text" id="nome_local" name="nome_local" required placeholder="Ex.: Centro de Convenções ou Zoom">
                        
                        <label for="endereco">Endereço Completo:</label>
                        <input type="text" id="endereco" name="endereco" required placeholder="Rua, número, bairro">
                        
                        <div class="como_sera_select">
                            <label>
                                <input type="radio" name="formato" value="presencial" required checked>
                                <span>Presencial</span>
                            </label>
                            <label>
                                <input type="radio" name="formato" value="online">
                                <span>Online</span>
                            </label>
                            <label>
                                <input type="radio" name="formato" value="hibrido">
                                <span>Híbrido</span>
                            </label>
                        </div>
                    </section>
                </div>
                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <!-- 3. Atividades -->
            <section class="cadastro_evento" hidden>
                <div class="progress-container" style="--step-size: 32px; --step-color: #e6d8ca; --main-color: #ee8f66; --progress-width: 100%;">
                    <div class="progress" style="transform: scaleX(0.66);"></div>
                    <ol>
                        <li class="active">1</li>
                        <li class="active">2</li>
                        <li class="active">3</li>
                        <li>4</li>
                    </ol>
                </div>
                <div class="linha">
                    <section class="atividades">
                        <h3>Atividades do Evento</h3>
                        <div class="como_sera_select">
                            <label class="btn-radio">
                                <input type="radio" name="tipo_atividade" value="palestra" checked> 
                                <span>Palestra</span>
                            </label>
                            <label class="btn-radio">
                                <input type="radio" name="tipo_atividade" value="oficina"> 
                                <span>Oficina</span>
                            </label>
                            <label class="btn-radio">
                                <input type="radio" name="tipo_atividade" value="painel"> 
                                <span>Painel</span>
                            </label>
                            <label class="btn-radio">
                                <input type="radio" name="tipo_atividade" value="networking"> 
                                <span>Networking</span>
                            </label>
                        </div>
                        <label for="titulo_atividade">Título da Atividade Principal:</label>
                        <input type="text" id="titulo_atividade" name="titulo_atividade" placeholder="Ex.: Palestra de Abertura">
                        
                        <label for="responsavel">Palestrante / Responsável:</label>
                        <input type="text" id="responsavel" name="responsavel" placeholder="Nome do palestrante ou instrutor">
                        
                        <label for="descricao_curta">Breve Resumo da Atividade:</label>
                        <textarea id="descricao_curta" name="descricao_curta" placeholder="Tópicos que serão abordados..."></textarea>
                    </section>
                    <section class="cronograma">
                        <h3>Resumo da Programação</h3>
                        <div class="cronograma-topo">
                            <span class="cronograma-data">Grade do Evento</span>
                        </div>
                        <p style="font-size: 14px; color: #666; margin-top: 10px;">
                            Você poderá adicionar mais palestras, workshops e palestrantes após publicar o evento no painel de controle.
                        </p>
                    </section>
                </div>
                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <!-- 4. Inscrições e Publicação -->
            <section class="cadastro_evento" hidden>
                <div class="progress-container" style="--step-size: 32px; --step-color: #e6d8ca; --main-color: #ee8f66; --progress-width: 100%;">
                    <div class="progress" style="transform: scaleX(1);"></div>
                    <ol>
                        <li class="active">1</li>
                        <li class="active">2</li>
                        <li class="active">3</li>
                        <li class="active">4</li>
                    </ol>
                </div>
                <div class="linha">
                    <section class="inscricoes">
                        <div class="tipo-inscricao-container">
                            <h3>Tipo de inscrição</h3>
                            <label class="card-opcao">
                                <input type="radio" name="tipo_inscricao" value="gratuito" checked>
                                <div class="card-conteudo">
                                    <div class="radio-circle"></div>
                                    <div class="texto-opcao">
                                        <strong>Gratuito</strong>
                                        <p>Inscrição sem custo para os participantes.</p>
                                    </div>
                                </div>
                            </label>
                            <label class="card-opcao">
                                <input type="radio" name="tipo_inscricao" value="pago">
                                <div class="card-conteudo">
                                    <div class="radio-circle"></div>
                                    <div class="texto-opcao">
                                        <strong>Pago</strong>
                                        <p>Com valor de inscrição e emissão de ingressos.</p>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </section>
                    
                    <section class="limite_publico">
                        <h3>Limites e Público</h3>
                        <div class="linha-vagas-espera">
                            <div class="campo-grupo">
                                <label for="vagas">Vagas disponíveis:</label>
                                <input type="number" id="vagas" name="vagas" value="100" min="1">
                            </div>
                        </div>
                        <div class="campo-grupo" style="margin-top: 10px;">
                            <label for="publico">Público-alvo:</label>
                            <select id="publico" name="publico">
                                <option value="geral" selected>Público Geral</option>
                                <option value="estudantes">Estudantes e Acadêmicos</option>
                                <option value="profissionais">Profissionais e Empresas</option>
                            </select>
                        </div>
                    </section>
                </div>
                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="submit" class="btn_cadastrar">Publicar Evento Agora</button>
                </div>
            </section>
        </div>
    </form>

    <!-- DASHBOARD DE EVENTOS -->
    <section class="dashboard">
        <div class="painel-eventos">
            <div class="painel-header">
                <h2>Eventos Cadastrados no Sistema</h2>
                <p>Acompanhe os eventos disponíveis e gerencie as inscrições:</p>
            </div>
            
            <div class="lista-eventos">
                <?php if (!empty($eventos_cadastrados)): ?>
                    <?php foreach ($eventos_cadastrados as $ev): ?>
                        <div class="card-evento">
                            <div class="thumb-container">
                                <img src="../imgs/imagem portal de eventos.png" alt="Evento EventCop">
                                <span class="tag-status status-andamento">● Ativo</span>
                            </div>
                            <div class="info-evento">
                                <h3><?= htmlspecialchars($ev['nome_event']) ?></h3>
                                <p class="detalhe-evento">
                                    <?= date('d/m/Y', strtotime($ev['data_event'])) ?> às <?= substr($ev['hora_event'], 0, 5) ?>
                                </p>
                                <p class="detalhe-evento">
                                    <?= htmlspecialchars($ev['cidade']) ?> - <?= htmlspecialchars($ev['estado']) ?> (<?= ucfirst($ev['formato']) ?>)
                                </p>
                                <p style="font-size: 13px; color: #555; margin-top: 6px;">
                                    <?= htmlspecialchars(mb_strimwidth($ev['descricao'], 0, 100, '...')) ?>
                                </p>
                            </div>
                            <div class="acoes-evento">
                                <a href="inscricao.php?id_evento=<?= $ev['id_event'] ?>" class="btn-gerenciar" style="text-align: center; text-decoration: none; display: inline-block;">
                                    Inscrever-se <span>›</span>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>

                <?php endif; ?>
            </div>
        </div>
    </section>
     
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
            <p>
                Avenida das Nações, nº 850<br>
                São José dos Campos - SP<br>
                CEP: 12227-000
            </p>
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
