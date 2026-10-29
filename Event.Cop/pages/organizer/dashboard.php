<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/organizador.php';

if (!eh_organizador()) {
    login_mock('organizador', 'marina@eventcop.com.br', 'demo');
}

$usuario       = usuario_logado();
$primeiroNome  = explode(' ', $usuario['nome'] ?? 'Marina')[0];
$kpis          = organizador_dashboard_kpis();
$resultados    = organizador_dashboard_resultados();
$atalhos       = organizador_atalhos_rapidos();
$eventosSessao = organizador_eventos_sessao();
$flashes       = flash_consumir();

$pageTitle   = 'Painel do Organizador | EventCop';
$pageCss     = ['pages/panel.css', 'pages/organizer.css'];
$pageJs      = ['pages/organizer.js'];
$painelAtivo = 'inicio';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/panel_open.php';
?>

<?php foreach ($flashes as $f): ?>
    <div class="alert alert-<?= e($f['tipo'] === 'ok' ? 'ok' : ($f['tipo'] === 'erro' ? 'erro' : 'info')) ?>" role="status">
        <?= e($f['msg']) ?>
    </div>
<?php endforeach; ?>

<section class="org-page-head" data-reveal>
    <div>
        <h1 class="org-page-title">Olá <?= e($primeiroNome) ?>!</h1>
        <p class="org-page-subtitle">Pronta para organizar seu evento?</p>
    </div>
    <div class="org-head-actions">
        <a href="<?= route('certificados') ?>" class="btn btn-peach btn-sm">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 15a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm-3.5 1.8L7 22l5-2.5L17 22l-1.5-5.2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Emitir certificados
        </a>
        <a href="<?= route('criar_evento') ?>" class="btn btn-solid btn-sm">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 5v14M5 12h14" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
            Criar evento
        </a>
    </div>
</section>

<!-- 4 KPI Cards -->
<section class="org-kpi-grid" aria-label="Indicadores principais">
<?php foreach ($kpis as $idx => $kpi):
    $valorInt = (int) $kpi['valor'];
    $prefixo  = ($kpi['pad'] === 2 && $valorInt < 10) ? '0' : '';
    $valorFmt = $prefixo . number_format($valorInt, 0, ',', '.');
?>
    <article class="org-kpi-card card card-hover" data-reveal data-delay="<?= $idx * 80 ?>">
        <div class="org-kpi-top">
            <span class="org-kpi-icon is-<?= e($kpi['cor']) ?>" aria-hidden="true">
                <?php if ($kpi['icone'] === 'calendar'): ?>
                    <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 3v4M8 3v4M3 10h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><rect x="7" y="13" width="3" height="3" rx=".5" fill="currentColor"/><rect x="14" y="13" width="3" height="3" rx=".5" fill="currentColor"/></svg>
                <?php elseif ($kpi['icone'] === 'play'): ?>
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="currentColor"/><path d="m10 8.5 6 3.5-6 3.5z" fill="#fff"/></svg>
                <?php elseif ($kpi['icone'] === 'check'): ?>
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="currentColor"/><path d="m8.5 12.2 2.3 2.3 4.8-4.8" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="7" r="4" fill="currentColor"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                <?php endif; ?>
            </span>
            <strong class="org-kpi-number" data-count="<?= $valorInt ?>" data-prefix="<?= e($prefixo) ?>"><?= e($valorFmt) ?></strong>
        </div>
        <div class="org-kpi-body">
            <span class="org-kpi-pill is-<?= e($kpi['cor']) ?>"><?= e($kpi['badge']) ?></span>
            <p class="org-kpi-desc"><?= e($kpi['descricao']) ?></p>
        </div>
    </article>
<?php endforeach; ?>
</section>

<!-- Grid inferior: Resumo dos resultados + Acesso rápido -->
<section class="org-dash-grid">
    <!-- Coluna esquerda: Resumo dos resultados -->
    <article class="org-widget card" data-reveal>
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Resumo dos resultados</h2>
                <p class="org-widget-sub">Participantes por evento</p>
            </div>
        </header>

        <div class="org-vchart" role="img" aria-label="Gráfico de barras de participantes por evento">
            <?php foreach ($resultados as $i => $bar): ?>
                <div class="org-vchart-col">
                    <div class="org-vchart-track">
                        <?php if ($bar['participantes'] > 0): ?>
                            <div class="org-vchart-bar is-<?= e($bar['cor']) ?> bar-grow-y" style="height: <?= (int) $bar['altura_pct'] ?>%; --reveal-delay: <?= 120 + $i * 120 ?>ms;">
                                <span class="org-vchart-val"><?= (int) $bar['participantes'] ?></span>
                            </div>
                        <?php else: ?>
                            <div class="org-vchart-zero-wrap">
                                <span class="org-vchart-bar-zero"></span>
                                <span class="org-vchart-zero-num">0</span>
                            </div>
                        <?php endif; ?>
                    </div>
                    <p class="org-vchart-label">
                        <?= e($bar['linhas_rotulo'][0] ?? $bar['titulo']) ?><br>
                        <span><?= e($bar['linhas_rotulo'][1] ?? '') ?></span>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="org-widget-foot">
            <a href="<?= route('relatorios') ?>" class="org-btn-results">
                Ver todos os resultados
                <span aria-hidden="true">→</span>
            </a>
        </div>
    </article>

    <!-- Coluna direita: Acesso rápido -->
    <article class="org-widget card" data-reveal data-delay="120">
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Acesso rápido</h2>
                <p class="org-widget-sub">Atalhos frequentes</p>
            </div>
        </header>

        <div class="org-shortcuts">
            <?php foreach ($atalhos as $atalho): ?>
                <a href="<?= route($atalho['rota']) ?>" class="org-shortcut-item">
                    <span class="org-shortcut-icon" aria-hidden="true">
                        <?php if ($atalho['icone'] === 'chart'): ?>
                            <svg viewBox="0 0 24 24"><path d="M3 3v18h18M7 15l4-4 3 3 5-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php elseif ($atalho['icone'] === 'wallet'): ?>
                            <svg viewBox="0 0 24 24"><rect x="3" y="6" width="18" height="13" rx="2" fill="currentColor"/><path d="M16 12.5h2" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                        <?php elseif ($atalho['icone'] === 'plus'): ?>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 8v8M8 12h8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <?php else: ?>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="9" r="5" fill="none" stroke="currentColor" stroke-width="2"/><path d="m9.5 13.5-1.5 7 4-2 4 2-1.5-7" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </span>
                    <span class="org-shortcut-text">
                        <strong><?= e($atalho['titulo']) ?></strong>
                        <small><?= e($atalho['subtitulo']) ?></small>
                    </span>
                    <span class="org-shortcut-arrow" aria-hidden="true">›</span>
                </a>
            <?php endforeach; ?>
        </div>
    </article>
</section>

<?php if (!empty($eventosSessao)): ?>
<section class="org-widget card org-created-section" data-reveal>
    <header class="org-widget-head">
        <div>
            <h2 class="org-widget-title">Eventos recém-criados nesta sessão</h2>
            <p class="org-widget-sub">Eventos publicados por você agora há pouco</p>
        </div>
        <a href="<?= route('criar_evento') ?>" class="btn btn-outline btn-sm">+ Novo evento</a>
    </header>
    <div class="org-created-list">
        <?php foreach ($eventosSessao as $ev): ?>
            <div class="org-created-item">
                <div>
                    <strong><?= e($ev['titulo'] ?? 'Evento') ?></strong>
                    <p><?= e(($ev['cidade'] ?? 'São José dos Campos') . ' - ' . ($ev['estado'] ?? 'SP')) ?> • <?= e(ucfirst((string) ($ev['formato'] ?? 'presencial'))) ?> • Expectativa: <?= e($ev['expectativa'] ?? 'Até 100 pessoas') ?></p>
                </div>
                <span class="badge badge-ok badge-dot">Publicado</span>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<?php require ROOT_PATH . '/includes/layout/panel_close.php'; ?>
