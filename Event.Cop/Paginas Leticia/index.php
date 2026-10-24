<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$estaLogado = isset($_SESSION["user_id"]);
$nomeUsuario = $_SESSION["user_nome"] ?? "Usuário";
$tipoUsuario = $_SESSION["user_tipo"] ?? "usuario";
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventCop - A Plataforma Completa para seus Eventos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header class="header">
    <a href="index.php">
        <img src="../imgs/logo_footer.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="empresas.php">EventCop Empresas</a></li>
            <li><a href="cases.php">Cases</a></li>
            <li><a href="planos_precos.php">Planos e Preços</a></li>
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

<main>
    <section class="hero">
        <h1>Crie seu Workshop com a EventCop</h1>
        <p>
            Divulgue patrocinadores, distribua materiais de apoio e facilite
            a organização das principais etapas do seu workshop com uma
            plataforma de eventos moderna e segura.
        </p>
        <a href="../Paginas Macedo/criar_evento.php" class="btn-claro">
            Crie seu Workshop →
        </a>
    </section>

    <section class="vantagens">
        <h2>
            Conheça as vantagens da EventCop para seu Workshop
        </h2>
        <img
            src="../imgs/Imagem do ChatGPT 26 de set. de 2026, 15_06_16.png"
            alt="Vantagens da EventCop"
            class="imagem-vantagens">

        <div class="linha"></div>
        <div class="organizadores">
            <div class="numero-organizadores">
                <strong>+1 mil</strong>
                <p>
                    Organizadores no<br>
                    Brasil inteiro fazem<br>
                    parte da EventCop
                </p>
            </div>
            <img
                src="../imgs/organizadores.png"
                alt="Organizadores EventCop no Brasil"
                class="mapa-organizadores">
        </div>
    </section>

    <section class="precos">
        <h2>Quanto custa criar um Workshop?</h2>
        <div class="planos">
            <div class="plano">
                <h3>Workshop Gratuito</h3>
                <div class="valor-gratis">
                    <span>R$</span>
                    <strong>0</strong>
                </div>
                <p>Grátis para inscrições gratuitas</p>
                <p>Participantes ilimitados</p>
                <p>Importe seus participantes</p>
                <p>Site personalizado</p>
                <p>E-mails ilimitados</p>
                <p>Inscrições via boleto, cartão e Pix</p>
            </div>
            <div class="plano">
                <h3>Workshop Pago</h3>
                <strong class="cifrao">$</strong>
                <p>Todos os recursos do gratuito</p>
                <p>Taxa de 10% sobre as inscrições</p>
                <p>Seu dinheiro em 10 dias</p>
                <p>Certificados ilimitados</p>
            </div>
        </div>

        <a href="planos_precos.php" class="btn-vinho">
            Conheça todos os Planos
            <span>→</span>
        </a>
    </section>

    <section class="dashboard">
        <div class="dashboard-imagem">
            <img src="../imgs/WhatsApp Image 2026-10-08 at 11.27.35.jpeg" alt="Dashboard EventCop">
        </div>
        <div class="dashboard-texto">
            <h2>Planeje e organize seu Workshop<br>2x mais rápido</h2>
            <p>
                Inicie seus cursos e oficinas práticas agora mesmo.
                Conte com a EventCop e não perca tempo organizando
                as inscrições online, distribuição de certificados
                e muito mais.
            </p>
            <a href="../Paginas Macedo/criar_evento.php" class="btn-claro"> Crie seu Evento → </a>
        </div>
    </section>

    <section class="funcionalidades">
        <h2>Explore mais funcionalidades para o seu Workshop</h2>
        <div class="funcionalidades-conteudo">
            <div class="container-imagem-funcionalidades">
                <img src="../imgs/imagem funcionalidades3.png" alt="Funcionalidades EventCop" class="imagem-funcionalidades">
                <div class="botoes-funcionalidades">
                    <a href="../Paginas Macedo/criar_evento.php" class="btn-funcionalidade">Divulgação</a>
                    <a href="../Paginas Macedo/inscricao.php" class="btn-funcionalidade">Inscrições</a>
                    <a href="../Paginas Macedo/criar_evento.php" class="btn-funcionalidade">Gestão</a>
                    <a href="empresas.php" class="btn-funcionalidade">Relatórios</a>
                    <a href="../Paginas Macedo/cadastro_normal.php" class="btn-funcionalidade">Participantes</a>
                    <a href="agenda_consultores.php" class="btn-funcionalidade">Consultores</a>
                </div>
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
        <a href="cases.php">› Corporativos</a>
        <a href="cases.php">› Workshops e Palestras</a>
        <a href="cases.php">› Treinamentos</a>
        <a href="cases.php">› Feiras e Exposições</a>
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
        <a href="empresas.php">› Relatórios e Métricas</a>
        <a href="agenda_consultores.php">› Agendamento com Consultores</a>
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
                <a href="agenda_consultores.php" class="btn-fale"> Fale conosco <span>→</span> </a>
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
