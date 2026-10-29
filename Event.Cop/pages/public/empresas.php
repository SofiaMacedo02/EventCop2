<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$pageTitle = 'EventCop Empresas - Gestão Corporativa de Eventos';
$pageCss   = ['pages/public.css'];
$menuAtivo = 'empresas';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="hero-empresas">
        <div class="hero-empresas-texto" data-reveal="left">
            <h1>Centralize todos os<br>seus eventos em um só<br>lugar</h1>
            <p>Gerencie eventos, inscrições, participantes e<br>resultados de forma simples e organizada com o<br>EventCop Empresas.</p>
            <a href="<?= route('agenda') ?>" class="btn-consultor-claro">Fale com um consultor<span>›</span></a>
        </div>
        <div class="hero-empresas-imagem" data-reveal="right" data-delay="120">
            <img src="<?= asset('img/imagem conectando pessoas e conhecimento.png') ?>" alt="Gestão de eventos EventCop" class="imagem-hero-empresas">
        </div>
    </section>

    <section class="beneficios-empresas">
        <div class="card-beneficio" data-reveal data-delay="0">
            <img src="<?= asset('img/imagem portal de eventos.png') ?>" alt="Portal de Eventos" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Portal de Eventos</h3>
                <p>Organize e apresente<br>todos os eventos da<br>sua empresa em um<br>único espaço.</p>
            </div>
        </div>
        <div class="card-beneficio" data-reveal data-delay="120">
            <img src="<?= asset('img/imagem fortaleca sua marca.png') ?>" alt="Fortaleça sua Marca" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Fortaleça sua Marca</h3>
                <p>Personalize a<br>experiência dos<br>participantes com a<br>identidade da sua<br>empresa.</p>
            </div>
        </div>
        <div class="card-beneficio" data-reveal data-delay="240">
            <img src="<?= asset('img/imagem gere novos contatos.png') ?>" alt="Gere novos contatos" class="imagem-card-beneficio">
            <div class="conteudo-card-beneficio">
                <h3>Gere novos contatos</h3>
                <p>Transforme<br>participantes e<br>interessados em novas<br>oportunidades para o<br>seu negócio.</p>
            </div>
        </div>
    </section>

    <section class="gestao-equipe">
        <div class="titulo-gestao" data-reveal>
            <h2>Tudo o que sua equipe precisa para<br>gerenciar seus eventos</h2>
            <p>Centralize informações, acompanhe resultados e simplifique a rotina da sua equipe.</p>
        </div>

        <div class="bloco-gestao bloco-resultados">
            <div class="texto-gestao" data-reveal="left">
                <h3>Acompanhe os resultados</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_visualize_receitas.png') ?>" alt="Receitas">
                    </div>
                    <p>Visualize receitas, inscrições e outros<br>indicadores;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_analise_desempenho.png') ?>" alt="Desempenho">
                    </div>
                    <p>Analise o desempenho de cada evento;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_consulte_relatorios.png') ?>" alt="Relatórios">
                    </div>
                    <p>Consulte relatórios personalizados.</p>
                </div>
            </div>
            <div class="imagem-gestao" data-reveal="right" data-delay="100">
                <img src="<?= asset('img/imagem Acompanhe os resultados.png') ?>" alt="Resultados dos eventos" class="imagem-resultados">
            </div>
        </div>

        <div class="bloco-gestao bloco-organizacao">
            <div class="imagem-gestao" data-reveal="left">
                <img src="<?= asset('img/imagem Organize seus eventos.png') ?>" alt="Organização de eventos" class="imagem-organizacao">
            </div>
            <div class="texto-gestao" data-reveal="right" data-delay="100">
                <h3>Organize seus eventos</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_gerencie_eventos.png') ?>" alt="Gerenciar">
                    </div>
                    <p>Gerencie diferentes eventos em um só lugar;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_categorize_eventos.png') ?>" alt="Categorias">
                    </div>
                    <p>Categorize eventos por tipo ou finalidade;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_mantenha_organizado.png') ?>" alt="Organização">
                    </div>
                    <p>Mantenha todas as informações organizadas.</p>
                </div>
            </div>
        </div>

        <div class="bloco-gestao bloco-ferramentas">
            <div class="texto-gestao" data-reveal="left">
                <h3>Conecte suas ferramentas</h3>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_integre_ferramentas.png') ?>" alt="Integração">
                    </div>
                    <p>Integre o EventCop às ferramentas utilizadas<br>pela sua empresa;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/icone_centralize_informacoes.png') ?>" alt="Informações">
                    </div>
                    <p>Centralize informações importantes;</p>
                </div>
                <div class="item-gestao">
                    <div class="icone-gestao">
                        <img src="<?= asset('img/Simplifique o fluxo de trabalho da equipe..png') ?>" alt="Fluxo de trabalho">
                    </div>
                    <p>Simplifique o fluxo de trabalho da equipe.</p>
                </div>
            </div>
            <div class="imagem-gestao" data-reveal="right" data-delay="100">
                <img src="<?= asset('img/imagem Conecte suas ferramentas.png') ?>" alt="Integração de ferramentas" class="imagem-ferramentas">
            </div>
        </div>

        <a href="<?= route('agenda') ?>" class="btn-consultor-vinho" data-reveal>Fale com um consultor<span>→</span></a>
    </section>

    <section class="faq" data-reveal>
        <h2>Perguntas frequentes</h2>
        <details class="pergunta">
            <summary>O que é a EventCop? <span>⌄</span></summary>
            <p>A EventCop é uma plataforma especializada na organização e gestão de workshops e eventos corporativos. Ela centraliza inscrições, programação e informações em um só lugar, facilitando o planejamento e o gerenciamento dos eventos.</p>
        </details>
        <details class="pergunta">
            <summary>Só posso usar o EventCop se eu tiver um CNPJ? <span>⌄</span></summary>
            <p>Não. A EventCop pode ser utilizada tanto por empresas quanto por profissionais responsáveis pela organização de eventos corporativos. O CNPJ pode ser solicitado apenas em recursos específicos da plataforma.</p>
        </details>
        <details class="pergunta">
            <summary>Posso criar eventos apenas para meus colaboradores? <span>⌄</span></summary>
            <p>Sim. Você pode criar eventos restritos para colaboradores ou convidados específicos, controlando quem terá acesso às informações e inscrições.</p>
        </details>
        <details class="pergunta">
            <summary>Com quanto tempo recebo o valor das inscrições? <span>⌄</span></summary>
            <p>Os valores das inscrições são repassados após a confirmação dos pagamentos, em até 10 dias úteis.</p>
        </details>
    </section>

    <section class="outras-solucoes" data-reveal>
        <div class="linha-solucoes" style="margin-bottom: 45px;"></div>
        <h2>Conheça outras soluções</h2>
        <div class="imagem-solucoes-container">
            <img src="<?= asset('img/imagem_conheca_outras_solucoes.png') ?>" alt="Outras soluções EventCop" class="imagem-solucoes">
            <a href="<?= route('recursos', [], 'divulgacao') ?>" class="btn-solucao btn-solucao-1">Saiba mais</a>
            <a href="<?= route('recursos', [], 'gestao-de-inscricoes') ?>" class="btn-solucao btn-solucao-2">Saiba mais</a>
            <a href="<?= route('recursos', [], 'gestao-de-eventos') ?>" class="btn-solucao btn-solucao-3">Saiba mais</a>
            <a href="<?= route('relatorios') ?>" class="btn-solucao btn-solucao-4">Saiba mais</a>
            <a href="<?= route('recursos', [], 'gestao-de-participantes') ?>" class="btn-solucao btn-solucao-5">Saiba mais</a>
            <a href="<?= route('agenda') ?>" class="btn-solucao btn-solucao-6">Saiba mais</a>
        </div>
    </section>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
