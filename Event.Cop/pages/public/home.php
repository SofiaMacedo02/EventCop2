<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$pageTitle = 'EventCop - A Plataforma Completa para seus Eventos';
$pageCss   = ['pages/public.css'];
$menuAtivo = 'home';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="hero" data-reveal>
        <h1>Crie seu Workshop com a EventCop</h1>
        <p>
            Divulgue patrocinadores, distribua materiais de apoio e facilite
            a organização das principais etapas do seu workshop com uma
            plataforma de eventos moderna e segura.
        </p>
        <div class="hero-acoes">
            <a href="<?= route('criar_evento') ?>" class="btn-claro">
                Crie seu Workshop <span>→</span>
            </a>
            <a href="<?= route('galeria') ?>" class="btn-hero-secundario">
                Explorar eventos <span>›</span>
            </a>
        </div>
    </section>

    <section class="vantagens">
        <h2 data-reveal>
            Conheça as vantagens da EventCop para seu Workshop
        </h2>
        <img
            src="<?= asset('img/Imagem do ChatGPT 26 de set. de 2026.png') ?>"
            alt="Vantagens da EventCop"
            class="imagem-vantagens"
            data-reveal="zoom"
            data-delay="80">

        <div class="linha"></div>
        <div class="organizadores">
            <div class="numero-organizadores" data-reveal="left">
                <strong>+1 mil</strong>
                <p>
                    Organizadores no<br>
                    Brasil inteiro fazem<br>
                    parte da EventCop
                </p>
            </div>
            <img
                src="<?= asset('img/organizadores.png') ?>"
                alt="Organizadores EventCop no Brasil"
                class="mapa-organizadores"
                data-reveal="right"
                data-delay="120">
        </div>
    </section>

    <section class="dashboard">
        <div class="dashboard-imagem" data-reveal="left">
            <img src="<?= asset('img/WhatsApp Image 2026-10-08 at 11.27.35.jpeg') ?>" alt="Dashboard EventCop">
        </div>
        <div class="dashboard-texto" data-reveal="right" data-delay="100">
            <h2>Planeje e organize seu Workshop<br>2x mais rápido</h2>
            <p>
                Inicie seus cursos e oficinas práticas agora mesmo.
                Conte com a EventCop e não perca tempo organizando
                as inscrições online, distribuição de certificados
                e muito mais.
            </p>
            <a href="<?= route('criar_evento') ?>" class="btn-claro">Crie seu Evento <span>→</span></a>
        </div>
    </section>

    <section class="funcionalidades" data-reveal>
        <h2>Explore mais funcionalidades para o seu Workshop</h2>
        <div class="funcionalidades-conteudo">
            <div class="container-imagem-funcionalidades">
                <img src="<?= asset('img/imagem funcionalidades3.png') ?>" alt="Funcionalidades EventCop" class="imagem-funcionalidades">
                <div class="botoes-funcionalidades">
                    <a href="<?= route('recursos', [], 'divulgacao') ?>" class="btn-funcionalidade">Divulgação</a>
                    <a href="<?= route('recursos', [], 'gestao-de-inscricoes') ?>" class="btn-funcionalidade">Inscrições</a>
                    <a href="<?= route('recursos', [], 'gestao-de-eventos') ?>" class="btn-funcionalidade">Gestão</a>
                    <a href="<?= route('relatorios') ?>" class="btn-funcionalidade">Relatórios</a>
                    <a href="<?= route('recursos', [], 'gestao-de-participantes') ?>" class="btn-funcionalidade">Participantes</a>
                    <a href="<?= route('agenda') ?>" class="btn-funcionalidade">Consultores</a>
                </div>
            </div>
        </div>
    </section>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
