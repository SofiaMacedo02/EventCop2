<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/organizador.php';

if (!eh_organizador()) {
    login_mock('organizador', 'marina@eventcop.com.br', 'demo');
}

$relatorios = organizador_relatorios_por_evento();
$eventoSlug = $_GET['evento'] ?? 'workshop-tecnologia-2026';
if (!isset($relatorios[$eventoSlug])) {
    $eventoSlug = 'workshop-tecnologia-2026';
}
$atual = $relatorios[$eventoSlug];

$pageTitle   = 'Relatórios e Métricas | EventCop';
$pageCss     = ['pages/panel.css', 'pages/organizer.css'];
$pageJs      = ['pages/organizer.js'];
$painelAtivo = 'relatorios';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/panel_open.php';
?>

<section class="org-page-head org-page-head-stack" data-reveal>
    <div>
        <h1 class="org-page-title">Relatórios e Métricas</h1>
        <p class="org-page-subtitle">Acompanhe o desempenho do seu evento através de dados e indicadores importantes.</p>
    </div>

    <div class="org-toolbar">
        <div class="org-select-wrap">
            <label for="selectEventoRelatorio" class="sr-only">Selecionar evento</label>
            <select id="selectEventoRelatorio" class="org-select-pill">
                <?php foreach ($relatorios as $slug => $item): ?>
                    <option value="<?= e($slug) ?>"<?= $slug === $eventoSlug ? ' selected' : '' ?>><?= e($item['titulo']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="button" id="btnExportarRelatorio" class="org-action-btn is-peach">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/><path d="M14 2v6h6M12 18v-6M9.5 15.5 12 18l2.5-2.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Exportar relatório
        </button>

        <button type="button" id="btnGerarRelatorio" class="org-action-btn is-solid">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M21 12a9 9 0 1 1-2.64-6.36M21 3v6h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Gerar relatório
        </button>
    </div>
</section>

<!-- 4 KPI Cards -->
<section class="org-kpi-grid" aria-label="Indicadores do evento">
    <article class="org-kpi-card card card-hover" data-reveal>
        <div class="org-kpi-top">
            <span class="org-kpi-icon is-vinho" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><circle cx="9" cy="7" r="4" fill="currentColor"/><path d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </span>
            <strong class="org-kpi-number" id="kpiInscritos" data-count="<?= (int) $atual['kpis']['inscritos'] ?>"><?= (int) $atual['kpis']['inscritos'] ?></strong>
        </div>
        <div class="org-kpi-body">
            <span class="org-kpi-pill is-vinho">Inscritos</span>
            <p class="org-kpi-desc">Total de pessoas inscritas no evento.</p>
        </div>
    </article>

    <article class="org-kpi-card card card-hover" data-reveal data-delay="80">
        <div class="org-kpi-top">
            <span class="org-kpi-icon is-laranja" aria-hidden="true">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="currentColor"/><path d="m8.5 12.2 2.3 2.3 4.8-4.8" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <strong class="org-kpi-number" id="kpiParticipantes" data-count="<?= (int) $atual['kpis']['participantes'] ?>"><?= (int) $atual['kpis']['participantes'] ?></strong>
        </div>
        <div class="org-kpi-body">
            <span class="org-kpi-pill is-laranja">Participantes</span>
            <p class="org-kpi-desc">Total de pessoas que participaram do evento.</p>
        </div>
    </article>

    <article class="org-kpi-card card card-hover" data-reveal data-delay="160">
        <div class="org-kpi-top">
            <span class="org-kpi-icon is-verde" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="M3 3v18h18M7 15l4-4 3 3 5-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </span>
            <strong class="org-kpi-number" id="kpiTaxaPresenca" data-count="<?= (float) $atual['kpis']['taxa_presenca'] ?>" data-decimals="1" data-suffix="%"><?= number_format((float) $atual['kpis']['taxa_presenca'], 1, ',', '.') ?>%</strong>
        </div>
        <div class="org-kpi-body">
            <span class="org-kpi-pill is-verde">Taxa de presença</span>
            <p class="org-kpi-desc">Participantes ÷ inscritos × 100.</p>
        </div>
    </article>

    <article class="org-kpi-card card card-hover" data-reveal data-delay="240">
        <div class="org-kpi-top">
            <span class="org-kpi-icon is-vinho" aria-hidden="true">
                <svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/></svg>
            </span>
            <strong class="org-kpi-number" id="kpiAvaliacao" data-count="<?= (float) $atual['kpis']['avaliacao'] ?>" data-decimals="1" data-suffix="/5"><?= number_format((float) $atual['kpis']['avaliacao'], 1, ',', '.') ?>/5</strong>
        </div>
        <div class="org-kpi-body">
            <span class="org-kpi-pill is-laranja">Avaliação média</span>
            <p class="org-kpi-desc">Média das notas dadas pelos participantes.</p>
        </div>
    </article>
</section>

<!-- Linha de gráficos: Evolução das inscrições + Inscritos e participantes -->
<section class="org-charts-row">
    <!-- Gráfico 1: Evolução das inscrições -->
    <article class="org-widget card" data-reveal>
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Evolução das inscrições</h2>
                <p class="org-widget-sub">Acompanhe o crescimento das inscrições durante o período de divulgação do evento.</p>
            </div>
            <button type="button" class="org-dots-btn" aria-label="Opções do gráfico" data-toast="Dados atualizados em tempo real.">•••</button>
        </header>

        <div class="org-linechart-wrap" id="evolucaoChartWrap">
            <?php
            // Coordenadas SVG (viewBox 0 0 560 220): Y de 175 (0) a 35 (400), X de 75 a 515
            $xs = [75, 163, 251, 339, 427, 515];
            $maxY = 400;
            $pts = [];
            foreach ($atual['evolucao'] as $idx => $ponto) {
                $x = $xs[$idx] ?? 75;
                $y = (int) round(175 - (($ponto['valor'] / $maxY) * 140));
                $pts[] = ['x' => $x, 'y' => $y, 'data' => $ponto['data'], 'valor' => $ponto['valor'], 'ultimo' => $idx === count($atual['evolucao']) - 1];
            }
            $polyPoints = implode(' ', array_map(fn($p) => "{$p['x']},{$p['y']}", $pts));
            ?>
            <svg viewBox="0 0 560 215" class="org-linechart-svg" id="svgEvolucao" role="img" aria-label="Evolução das inscrições de 01/09 a 25/09">
                <!-- Linhas horizontais de grade e rótulos Y -->
                <?php foreach ([400 => 35, 300 => 70, 200 => 105, 100 => 140, 0 => 175] as $labelY => $posY): ?>
                    <text x="12" y="<?= $posY + 4 ?>" class="org-svg-axis"><?= $labelY ?></text>
                    <line x1="48" y1="<?= $posY ?>" x2="540" y2="<?= $posY ?>" class="org-svg-grid"/>
                <?php endforeach; ?>

                <!-- Linha conectando os pontos -->
                <polyline id="polyEvolucao" points="<?= e($polyPoints) ?>" fill="none" stroke="rgba(238, 143, 102, 0.45)" stroke-width="2.5" stroke-dasharray="4 4"/>

                <!-- Pontos, valores e datas -->
                <g id="grupoPontosEvolucao">
                    <?php foreach ($pts as $p): ?>
                        <g class="org-svg-point-group" data-tooltip="<?= e($p['data'] . ': ' . $p['valor'] . ' inscrições') ?>">
                            <line x1="<?= $p['x'] ?>" y1="<?= $p['y'] ?>" x2="<?= $p['x'] ?>" y2="175" stroke="rgba(90,5,5,0.06)" stroke-width="1"/>
                            <text x="<?= $p['x'] ?>" y="<?= $p['y'] - 12 ?>" text-anchor="middle" class="org-svg-val"><?= (int) $p['valor'] ?></text>
                            <circle cx="<?= $p['x'] ?>" cy="<?= $p['y'] ?>" r="6.5" class="org-svg-dot <?= $p['ultimo'] ? 'is-wine' : 'is-orange' ?>">
                                <title><?= e($p['data'] . ': ' . $p['valor'] . ' inscrições') ?></title>
                            </circle>
                            <text x="<?= $p['x'] ?>" y="<?= $p['y'] + 22 ?>" text-anchor="middle" class="org-svg-date"><?= e($p['data']) ?></text>
                        </g>
                    <?php endforeach; ?>
                </g>
            </svg>
        </div>
    </article>

    <!-- Gráfico 2: Inscritos e participantes -->
    <article class="org-widget card" data-reveal data-delay="100">
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Inscritos e participantes</h2>
                <p class="org-widget-sub">Veja o comparativo entre inscritos, confirmados e presentes no evento.</p>
            </div>
            <button type="button" class="org-dots-btn" aria-label="Opções do gráfico" data-toast="Comparativo de funil de presença.">•••</button>
        </header>

        <div class="org-hbars" id="comparativoContainer">
            <?php foreach ($atual['comparativo'] as $idx => $item):
                $pct = max(8, min(100, round(($item['valor'] / $item['max']) * 100, 1)));
            ?>
                <div class="org-hbar-row">
                    <span class="org-hbar-label"><?= e($item['rotulo']) ?></span>
                    <div class="org-hbar-track">
                        <div class="org-hbar-fill is-<?= e($item['cor']) ?> bar-grow-x" style="width: <?= $pct ?>%; --reveal-delay: <?= 100 + $idx * 90 ?>ms;">
                            <span class="org-hbar-val"><?= (int) $item['valor'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="org-hbar-scale" id="comparativoScale">
                <span>0</span><span>50</span><span>100</span><span>150</span><span>200</span><span>250</span><span>300</span><span>350</span>
            </div>
        </div>
    </article>
</section>

<!-- Card largo: Avaliação dos participantes -->
<section class="org-widget card org-rating-card" data-reveal>
    <header class="org-widget-head">
        <div>
            <h2 class="org-widget-title">Avaliação dos participantes</h2>
            <p class="org-widget-sub">Distribuição das notas atribuídas ao evento pelos participantes.</p>
        </div>
        <button type="button" class="org-dots-btn" aria-label="Opções de avaliação" data-toast="Pesquisa de satisfação pós-evento.">•••</button>
    </header>

    <div class="org-rating-grid">
        <div class="org-rating-summary">
            <strong class="org-rating-score" id="ratingMedia"><?= e($atual['avaliacao']['media']) ?></strong>
            <span class="org-rating-label">Avaliação média</span>
            <div class="org-rating-stars" aria-label="5 de 5 estrelas">
                <span>★</span><span>★</span><span>★</span><span>★</span><span class="is-half">★</span>
            </div>
            <p class="org-rating-count" id="ratingRespondentes"><?= (int) $atual['avaliacao']['respondentes'] ?> participantes responderam à pesquisa</p>
        </div>

        <div class="org-rating-bars" id="ratingBarsContainer">
            <?php foreach ($atual['avaliacao']['estrelas'] as $estrela => $pct): ?>
                <div class="org-star-row">
                    <span class="org-star-label"><?= $estrela ?> <?= $estrela === 1 ? 'estrela' : 'estrelas' ?></span>
                    <span class="org-star-icons" aria-hidden="true"><?= str_repeat('★', (int) $estrela) ?></span>
                    <div class="org-star-track">
                        <div class="org-star-fill bar-grow-x" style="width: <?= max(2, (int) $pct) ?>%;"></div>
                    </div>
                    <strong class="org-star-pct"><?= (int) $pct ?>%</strong>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Linha inferior: Interações durante o evento + Insights do evento -->
<section class="org-bottom-grid">
    <!-- Interações durante o evento -->
    <article class="org-widget card" data-reveal>
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Interações durante o evento</h2>
                <p class="org-widget-sub">Confira o engajamento dos participantes durante o evento.</p>
            </div>
            <button type="button" class="org-dots-btn" aria-label="Opções de interações" data-toast="Métricas coletadas pelo app do evento.">•••</button>
        </header>

        <div class="org-interactions-grid">
            <div class="org-interaction-box">
                <span class="org-interaction-icon is-vinho" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" fill="currentColor"/></svg>
                </span>
                <strong id="intComentarios" data-count="<?= (int) $atual['interacoes']['comentarios'] ?>"><?= (int) $atual['interacoes']['comentarios'] ?></strong>
                <span>Comentários</span>
            </div>

            <div class="org-interaction-box">
                <span class="org-interaction-icon is-vinho" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z" fill="currentColor"/></svg>
                </span>
                <strong id="intReacoes" data-count="<?= (int) $atual['interacoes']['reacoes'] ?>"><?= (int) $atual['interacoes']['reacoes'] ?></strong>
                <span>Reações</span>
            </div>

            <div class="org-interaction-box">
                <span class="org-interaction-icon is-vinho" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" fill="none" stroke="currentColor" stroke-width="2"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3M12 17h.01" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/></svg>
                </span>
                <strong id="intPerguntas" data-count="<?= (int) $atual['interacoes']['perguntas'] ?>"><?= (int) $atual['interacoes']['perguntas'] ?></strong>
                <span>Perguntas enviadas</span>
            </div>

            <div class="org-interaction-box">
                <span class="org-interaction-icon is-vinho" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="3" fill="currentColor"/><path d="M8 16v-4M12 16V8M16 16v-6" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg>
                </span>
                <strong id="intPesquisas" data-count="<?= (int) $atual['interacoes']['pesquisas'] ?>"><?= (int) $atual['interacoes']['pesquisas'] ?></strong>
                <span>Pesquisas respondidas</span>
            </div>
        </div>
    </article>

    <!-- Insights do evento -->
    <article class="org-widget card" data-reveal data-delay="120">
        <header class="org-widget-head">
            <div>
                <h2 class="org-widget-title">Insights do evento</h2>
                <p class="org-widget-sub">Principais insights com base nos dados do evento.</p>
            </div>
            <button type="button" class="org-dots-btn" aria-label="Opções de insights" data-toast="Insights gerados automaticamente.">•••</button>
        </header>

        <div class="org-insights-list" id="insightsContainer">
            <?php foreach ($atual['insights'] as $ins): ?>
                <div class="org-insight-item">
                    <span class="org-insight-icon is-<?= e($ins['cor']) ?>" aria-hidden="true">
                        <?php if ($ins['icone'] === 'chart'): ?>
                            <svg viewBox="0 0 24 24"><path d="M3 3v18h18M7 15l4-4 3 3 5-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php elseif ($ins['icone'] === 'star'): ?>
                            <svg viewBox="0 0 24 24"><path d="m12 2 3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" fill="currentColor"/></svg>
                        <?php else: ?>
                            <svg viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" fill="currentColor"/></svg>
                        <?php endif; ?>
                    </span>
                    <div>
                        <strong><?= e($ins['titulo']) ?></strong>
                        <p><?= e($ins['texto']) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </article>
</section>

<script>
window.EVENTCOP_RELATORIOS = <?= json_encode($relatorios, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?>;
</script>

<?php require ROOT_PATH . '/includes/layout/panel_close.php'; ?>
