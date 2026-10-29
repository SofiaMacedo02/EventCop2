<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';

$inscricao = $_SESSION['ultima_inscricao'] ?? [];
$idEvento  = isset($_GET['id_evento']) ? (int) $_GET['id_evento'] : (int) ($inscricao['id_evento'] ?? 1);
$evento    = evento_por_id($idEvento) ?? eventos_todos()[0];

$pageTitle = 'Evento confirmado! | EventCop';
$pageCss   = ['pages/evento.css'];
$semFooter = true;

require ROOT_PATH . '/includes/layout/head.php';
?>
<main class="evc-fullscreen">
    <header class="evc-top">
        <a href="<?= route('home') ?>" class="evc-logo-link">
            <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop - Eventos Corporativos" class="evc-logo">
        </a>
    </header>

    <section class="evc-center anim-fade-up">
        <div class="evc-art-wrap">
            <img
                src="<?= asset('img/imagem conectando pessoas e conhecimento.png') ?>"
                alt="Time EventCop comemorando sua inscrição confirmada"
                class="evc-art anim-float">
        </div>

        <h1 class="evc-title">Evento confirmado!</h1>
        <p class="evc-subtitle">
            Agora que você faz parte do time EventCop, explore alguns dos
            eventos que foram divulgados por nós disponíveis na nossa galeria de
            eventos
        </p>

        <?php if (!empty($inscricao['nome']) || !empty($evento['titulo'])): ?>
            <p class="evc-meta-pill">
                ✓ Inscrição garantida em <strong><?= e($evento['titulo']) ?></strong>
                <?php if (!empty($inscricao['codigo'])): ?>
                    · Código <strong><?= e($inscricao['codigo']) ?></strong>
                <?php endif; ?>
            </p>
        <?php endif; ?>

        <div class="evc-actions">
            <a href="<?= route('galeria') ?>" class="evc-btn-primary">Acessar galeria</a>
            <a href="<?= route('home') ?>" class="evc-btn-link">Retornar ao início</a>
        </div>
    </section>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
