<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$estaLogado = isset($_SESSION["user_id"]);
$nomeUsuario = $_SESSION["user_nome"] ?? "Usuário";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EventCop Empresas - Gestão Corporativa de Eventos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header class="header">
    <a href="index.php">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header">
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
    <section class="hero-empresas">
        <div class="hero-empresas-texto">
            <h1>Centralize todos os<br>seus eventos em um só<br>lugar</h1>
            <p>Gerencie eventos, inscrições, participantes e<br>resultados de forma simples e organizada com o<br>EventCop Empresas.</p>
            <a href="agenda_consultores.php" class="btn-consultor-claro">Fale com um consultor<span>›</span></a>
        </div>
        <div class="hero-empresas-imagem">
            <img src="../imgs/imagem conectando pessoas e conhecimento.png" alt="Gestão de eventos EventCop" class="imagem-hero-empresas">
        </div>
    </section>

    <section class="beneficios-empresas">
        <div class="card-beneficio">
            <img src="../imgs/imagem portal de eventos.png" alt="Portal de Eventos" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Portal de Eventos</h3>
                <p>Organize e apresente<br>todos os eventos da<br>sua empresa em um<br>único espaço.</p>
            </div>
        </div>
        <div class="card-beneficio">
            <img src="../imgs/imagem fortaleca sua marca.png" alt="Fortaleça sua Marca" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Fortaleça sua Marca</h3>
                <p>Personalize a<br>experiência dos<br>participantes com a<br>identidade da sua<br>empresa.</p>
            </div>
        </div>
        <div class="card-beneficio">
            <img src="../imgs/imagem gere novos contatos.png" alt="Gere novos contatos" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Gere novos contatos</h3>
                <p>Transforme<br>participantes e<br>interessados em novas<br>oportunidades para o<br>seu negócio.</p>
            </div>
        </div>
    </section>

    <section class="gestao-equipe">
        <div class="titulo-gestao">
            <h2>Tudo o que sua equipe precisa para<br>gerenciar seus eventos</h2>
            <p>Centralize informações, acompanhe resultados e simplifique a rotina da sua equipe.</p>
        </div>

        <div class="bloco-gestao bloco-resultados">
            <div class="texto-gestao">
                <h3>Acompanhe os resultados</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_visualize_receitas.png" alt="Receitas">
                    </div>
                    <p>Visualize receitas, inscrições e outros<br>indicadores;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_analise_desempenho.png" alt="Desempenho">
                    </div>
                    <p>Analise o desempenho de cada evento;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_consulte_relatorios.png" alt="Relatórios">
                    </div>
                    <p>Consulte relatórios personalizados.</p>
                </div>
            </div>
            <div class="imagem-gestao">
                <img src="../imgs/imagem Acompanhe os resultados.png" alt="Resultados dos eventos" class="imagem-resultados">
            </div>
        </div>

        <div class="bloco-gestao bloco-organizacao">
            <div class="imagem-gestao">
                <img src="../imgs/imagem Organize seus eventos.png" alt="Organização de eventos" class="imagem-organizacao">
            </div>
            <div class="texto-gestao">
                <h3>Organize seus eventos</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_gerencie_eventos.png" alt="Gerenciar">
                    </div>
                    <p>Gerencie diferentes eventos em um só lugar;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_categorize_eventos.png" alt="Categorias">
                    </div>
                    <p>Categorize eventos por tipo ou finalidade;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_mantenha_organizado.png" alt="Organização">
                    </div>
                    <p>Mantenha todas as informações organizadas;</p>
                </div>
            </div>
        </div>

        <div class="bloco-gestao bloco-ferramentas">
            <div class="texto-gestao">
                <h3>Conecte suas ferramentas</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_integre_ferramentas.png" alt="Integração">
                    </div>
                    <p>Integre o EventCop às ferramentas utilizadas<br>pela sua empresa;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/icone_centralize_informacoes.png" alt="Informações">
                    </div>
                    <p>Centralize informações importantes;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="../imgs/Simplifique o fluxo de trabalho da equipe..png" alt="Fluxo de trabalho">
                    </div>
                    <p>Simplifique o fluxo de trabalho da equipe.</p>
                </div>
            </div>
            <div class="imagem-gestao">
                <img src="../imgs/imagem Conecte suas ferramentas.png" alt="Integração de ferramentas" class="imagem-ferramentas">
            </div>
        </div>

        <a href="agenda_consultores.php" class="btn-consultor-vinho"> Fale com um consultor<span>→</span></a>
    </section>

    <section class="faq">
        <h2>Perguntas frequentes</h2>
        <details class="pergunta"><summary> O que é a EventCop? <span>⌄</span> </summary>
            <p> A EventCop é uma plataforma especializada na organização e gestão de workshops e eventos corporativos. Ela centraliza inscrições, programação e informações em um só lugar, facilitando o planejamento e o gerenciamento dos eventos.</p>
        </details>
        <details class="pergunta"><summary>Só posso usar o EventCop se eu tiver um CNPJ?<span>⌄</span></summary>
            <p> Não. A EventCop pode ser utilizada tanto por empresas quanto por profissionais responsáveis pela organização de eventos corporativos. O CNPJ pode ser solicitado apenas em recursos específicos da plataforma.</p>
        </details>
        <details class="pergunta"><summary>Posso criar eventos apenas para meus colaboradores?<span>⌄</span></summary>
            <p>Sim. Você pode criar eventos restritos para colaboradores ou convidados específicos, controlando quem terá acesso às informações e inscrições.</p>
        </details>
        <details class="pergunta"><summary>Com quanto tempo recebo o valor das inscrições?<span>⌄</span></summary>
            <p>Os valores das inscrições são repassados após a confirmação dos pagamentos, em até 10 dias úteis.</p>
        </details>
    </section>

    <section class="outras-solucoes">
        <h2>Conheça outras soluções</h2>
        <div class="imagem-solucoes-container">
            <img src="../imgs/imagem_conheca_outras_solucoes.png" alt="Outras soluções EventCop" class="imagem-solucoes">
            <a href="planos_precos.php" class="btn-solucao btn-solucao-1">Saiba mais</a>
            <a href="planos_precos.php" class="btn-solucao btn-solucao-2">Saiba mais</a>
            <a href="planos_precos.php" class="btn-solucao btn-solucao-3">Saiba mais</a>
            <a href="planos_precos.php" class="btn-solucao btn-solucao-4">Saiba mais</a>
            <a href="planos_precos.php" class="btn-solucao btn-solucao-5">Saiba mais</a>
            <a href="planos_precos.php" class="btn-solucao btn-solucao-6">Saiba mais</a>
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
            <p> Avenida das Nações, nº 850<br> São José dos Campos - SP<br> CEP: 12227-000 </p>
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
