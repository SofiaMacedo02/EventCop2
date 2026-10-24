<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos e Preços - EventCop</title>
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
            <li><a href="../Paginas Macedo/login_organizadores.php">Sou um organizador</a></li>
            <li><a href="../Paginas Macedo/criar_evento.php" class="btn-header">Criar Evento</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="hero">
        <h1>Quanto custa criar<br>eventos com a EventCop?</h1>
        <p>Crie eventos gratuitos sem taxas. Para eventos<br>pagos, cobramos apenas 10% por inscrição vendida.</p>
    </section>

    <section class="planos">
        <div class="plano-card">
            <h2>Workshop Gratuito</h2>
            <div class="preco">
                <span>R$</span>
                <strong>0</strong>
            </div>
            <ul>
                <li>Grátis para inscrições gratuitas</li>
                <li>Participantes ilimitados</li>
                <li>Transmissão online ou presencial</li>
                <li>Programação e atividades</li>
                <li>Credenciamento digital</li>
                <li>Pesquisa de satisfação</li>
                <li>E-mail marketing ilimitado</li>
                <li>Certificados digitais</li>
                <li>Submissão de trabalhos</li>
            </ul>
        </div>

        <div class="plano-card">
            <h2>Workshop Pago</h2>
            <div class="preco preco-pago">
                <strong>$</strong>
            </div>
            <ul>
                <li>Todos os recursos do gratuito</li>
                <li>Taxa de apenas 10% sobre as inscrições</li>
                <li>Seu dinheiro liberado em até 10 dias</li>
                <li>Certificados ilimitados</li>
                <li>Inscrições via Boleto, Cartão e Pix</li>
                <li>Relatórios avançados de conversão</li>
            </ul>
        </div>
    </section>

    <div class="area-botao" style="text-align: center; margin: 30px 0;">
        <a href="../Paginas Macedo/criar_evento.php" class="btn-claro" style="display: inline-block;">
            Crie seu Workshop Agora <span>→</span>
        </a>
    </div>

    <section class="personalizado">
        <div class="linha"></div>
        <div class="imagem-personalizado">
            <img src="../imgs/imagem precisa de um plano personalizado.png" alt="Plano personalizado EventCop">
        </div>
        <a href="agenda_consultores.php" class="btn-claro">Fale com um consultor</a>
    </section>

    <section class="faq">
        <h2>Perguntas Frequentes</h2>
        <div class="faq-lista">
            <details class="pergunta">
                <summary>O que é a EventCop? <span>⌄</span></summary>
                <p>A EventCop é uma plataforma especializada na organização e gestão de workshops e eventos corporativos. Ela centraliza inscrições, programação e informações em um só lugar, facilitando o planejamento e o gerenciamento dos eventos.</p>
            </details>
            <details class="pergunta">
                <summary>Só posso usar o EventCop se eu tiver um CNPJ? <span>⌄</span></summary>
                <p>Não. A EventCop pode ser utilizada tanto por empresas quanto por profissionais autônomos responsáveis pela organização de eventos. O CNPJ é opcional.</p>
            </details>
            <details class="pergunta">
                <summary>Posso criar eventos apenas para meus colaboradores? <span>⌄</span></summary>
                <p>Sim. Você pode criar eventos restritos e privados, controlando quem terá acesso às informações e inscrições.</p>
            </details>
            <details class="pergunta">
                <summary>Com quanto tempo recebo o valor das inscrições? <span>⌄</span></summary>
                <p>Os valores das inscrições são repassados de forma rápida após a confirmação dos pagamentos, em até 10 dias úteis.</p>
            </details>
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
