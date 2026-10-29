<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/organizador.php';

if (!eh_organizador()) {
    login_mock('organizador', 'marina@eventcop.com.br', 'demo');
}

$kpis            = organizador_pagamentos_kpis();
$receitasMensais = organizador_receitas_mensais();
$metodos         = organizador_metodos_pagamento();
$pagamentos      = organizador_ultimos_pagamentos();
$pendencias      = organizador_pendencias();

$pageTitle   = 'Pagamentos e pendências | EventCop';
$pageCss     = ['pages/panel.css', 'pages/organizer.css'];
$pageJs      = ['pages/organizer.js'];
$painelAtivo = 'pagamentos';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/panel_open.php';
?>

<section class="org-page-head" data-reveal>
    <div>
        <h1 class="org-page-title">Pagamentos e pendências</h1>
        <p class="org-page-subtitle">Acompanhe os pagamentos dos seus eventos e gerencie as pendências.</p>
    </div>

    <div class="org-select-wrap">
        <label for="selectFiltroPagamentos" class="sr-only">Filtrar pagamentos por evento</label>
        <select id="selectFiltroPagamentos" class="org-select-white">
            <option value="todos">Todos os eventos</option>
            <option value="congresso-inovacao-2026">Congresso de Inovação 2026</option>
            <option value="workshop-lideranca-2026">Workshop de Liderança 2026</option>
            <option value="seminario-gestao-2026">Seminário de Gestão 2026</option>
            <option value="workshop-tecnologia-2026">Workshop de Tecnologia 2026</option>
            <option value="palestra-inovacao-pratica">Palestra: Inovação na Prática</option>
        </select>
    </div>
</section>

<!-- 4 Cards Financeiros no Topo -->
<section class="org-kpi-grid" aria-label="Resumo financeiro">
<?php foreach ($kpis as $idx => $kpi): ?>
    <article class="org-fin-card card card-hover" data-reveal data-delay="<?= $idx * 80 ?>">
        <div class="org-fin-top">
            <span class="org-fin-circle is-<?= e($kpi['cor']) ?>" aria-hidden="true">
                <?php if ($kpi['icone'] === 'wallet'): ?>
                    <svg viewBox="0 0 24 24"><rect x="4" y="6" width="16" height="12" rx="2" fill="#fff"/></svg>
                <?php elseif ($kpi['icone'] === 'check'): ?>
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="5" fill="#fff"/></svg>
                <?php elseif ($kpi['icone'] === 'clock'): ?>
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="6" fill="none" stroke="#fff" stroke-width="2"/><path d="M12 9v3.5l2 1.5" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                <?php else: ?>
                    <svg viewBox="0 0 24 24"><path d="M9 14 4 9l5-5" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M20 20v-7a4 4 0 0 0-4-4H4" fill="none" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php endif; ?>
            </span>
            <div class="org-fin-info">
                <span class="org-fin-label"><?= e($kpi['rotulo']) ?></span>
                <strong class="org-fin-value is-<?= e($kpi['cor']) ?>"
                        data-count="<?= (float) $kpi['valor'] ?>"
                        data-prefix="R$ "
                        data-decimals="2"><?= e(moeda((float) $kpi['valor'])) ?></strong>
            </div>
        </div>
        <p class="org-fin-trend is-<?= e($kpi['cor']) ?>"><?= e($kpi['tendencia']) ?></p>
    </article>
<?php endforeach; ?>
</section>

<!-- Linha de gráficos: Receitas por mês + Métodos de pagamento -->
<section class="org-charts-row org-charts-row-fin">
    <!-- Gráfico 1: Receitas por mês -->
    <article class="org-widget card" data-reveal>
        <header class="org-widget-head">
            <h2 class="org-widget-title">Receitas por mês</h2>
            <select id="selectAnoReceitas" class="org-select-mini" aria-label="Selecionar ano">
                <option value="2026" selected>2026</option>
                <option value="2025">2025</option>
            </select>
        </header>

        <div class="org-mchart">
            <div class="org-mchart-yaxis" aria-hidden="true">
                <span>80 mil</span>
                <span>60 mil</span>
                <span>40 mil</span>
                <span>20 mil</span>
                <span>0</span>
            </div>
            <div class="org-mchart-bars" id="mchartBars">
                <?php foreach ($receitasMensais['2026'] as $i => $m):
                    $hRec = round(($m['recebido'] / 80) * 100, 1);
                    $hPen = round(($m['pendente'] / 80) * 100, 1);
                    $hEst = round(($m['estornado'] / 80) * 100, 1);
                    $totalMes = $m['recebido'] + $m['pendente'] + $m['estornado'];
                ?>
                    <div class="org-mchart-col" title="<?= e($m['mes'] . ': R$ ' . $totalMes . ' mil') ?>">
                        <div class="org-mchart-stack bar-grow-y" style="--reveal-delay: <?= 60 + $i * 45 ?>ms;">
                            <span class="org-mbar-seg is-estornado" style="height: <?= $hEst ?>%;"></span>
                            <span class="org-mbar-seg is-pendente" style="height: <?= $hPen ?>%;"></span>
                            <span class="org-mbar-seg is-recebido" style="height: <?= $hRec ?>%;"></span>
                        </div>
                        <span class="org-mchart-lbl"><?= e($m['mes']) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="org-chart-legend">
            <span><i class="is-recebido"></i> Recebido</span>
            <span><i class="is-pendente"></i> Pendente</span>
            <span><i class="is-estornado"></i> Estornado</span>
        </div>
    </article>

    <!-- Gráfico 2: Métodos de pagamento (Donut SVG) -->
    <article class="org-widget card" data-reveal data-delay="120">
        <header class="org-widget-head">
            <h2 class="org-widget-title">Métodos de pagamento</h2>
        </header>

        <div class="org-donut-layout">
            <div class="org-donut-wrap">
                <?php
                // Circunferência para r = 15.9154943 -> C = 100
                $offset = 25;
                ?>
                <svg viewBox="0 0 42 42" class="org-donut-svg" role="img" aria-label="Distribuição por métodos de pagamento">
                    <circle cx="21" cy="21" r="15.9155" fill="transparent" stroke="#f3ebe3" stroke-width="5.5"/>
                    <?php foreach ($metodos as $m):
                        $pct = (float) $m['percentual'];
                        $rest = 100 - $pct;
                    ?>
                        <circle cx="21" cy="21" r="15.9155"
                                fill="transparent"
                                stroke="<?= e($m['cor']) ?>"
                                stroke-width="5.5"
                                stroke-dasharray="<?= $pct ?> <?= $rest ?>"
                                stroke-dashoffset="<?= $offset ?>">
                            <title><?= e($m['metodo'] . ': ' . $pct . '%') ?></title>
                        </circle>
                    <?php
                        $offset -= $pct;
                    endforeach; ?>
                </svg>
                <div class="org-donut-center">
                    <strong data-count="248">248</strong>
                    <span>inscrições</span>
                </div>
            </div>

            <ul class="org-donut-legend">
                <?php foreach ($metodos as $m): ?>
                    <li>
                        <span class="org-donut-name">
                            <i style="background: <?= e($m['cor']) ?>;"></i>
                            <?= e($m['metodo']) ?>
                        </span>
                        <strong><?= (int) $m['percentual'] ?>%</strong>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </article>
</section>

<!-- Tabela: Últimos pagamentos -->
<section class="org-widget card org-table-card" data-reveal>
    <header class="org-widget-head">
        <h2 class="org-widget-title org-title-with-icon">
            <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 3v4M8 3v4M3 10h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            Últimos pagamentos
        </h2>
        <button type="button" id="btnVerTodosPagamentos" class="org-link-action">Ver todos</button>
    </header>

    <div class="org-table-responsive">
        <table class="org-table" id="tabelaPagamentos">
            <thead>
                <tr>
                    <th>Data</th>
                    <th>Participante / Empresa</th>
                    <th>Evento</th>
                    <th>Método</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pagamentos as $pg): ?>
                    <tr data-evento="<?= e($pg['evento_slug']) ?>"<?= !empty($pg['extra']) ? ' class="is-extra-row" hidden' : '' ?>>
                        <td class="org-td-muted"><?= e($pg['data']) ?></td>
                        <td><strong><?= e($pg['participante']) ?></strong></td>
                        <td class="org-td-muted"><?= e($pg['evento']) ?></td>
                        <td class="org-td-muted"><?= e($pg['metodo']) ?></td>
                        <td><strong><?= e(moeda((float) $pg['valor'])) ?></strong></td>
                        <td>
                            <span class="org-status-pill is-<?= e($pg['status']) ?>">
                                • <?= e($pg['status_label']) ?>
                            </span>
                        </td>
                        <td>
                            <button type="button"
                                    class="org-row-action"
                                    aria-label="Opções do pagamento de <?= e($pg['participante']) ?>"
                                    data-pagamento-acao="<?= e($pg['participante']) ?>"
                                    data-pagamento-status="<?= e($pg['status_label']) ?>"
                                    data-pagamento-valor="<?= e(moeda((float) $pg['valor'])) ?>">•••</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p id="msgSemPagamentos" class="org-empty-msg" hidden>Nenhum pagamento encontrado para o filtro selecionado.</p>
    </div>
</section>

<!-- Linha inferior: Pendências + Ações rápidas -->
<section class="org-bottom-grid">
    <!-- Card Pendências -->
    <article class="org-widget card" data-reveal>
        <header class="org-widget-head">
            <h2 class="org-widget-title org-title-with-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" fill="currentColor"/><path d="M12 9v4M12 17h.01" stroke="#fff" stroke-width="2" stroke-linecap="round"/></svg>
                Pendências
            </h2>
            <button type="button" class="org-link-action" data-toast="Exibindo todas as 28 pendências ativas.">Ver todas</button>
        </header>

        <div class="org-pending-list">
            <?php foreach ($pendencias as $p): ?>
                <button type="button" class="org-pending-item" data-toast="<?= e($p['toast']) ?>">
                    <span class="org-pending-icon" aria-hidden="true">
                        <?php if ($p['icone'] === 'clock'): ?>
                            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <?php elseif ($p['icone'] === 'calendar'): ?>
                            <svg viewBox="0 0 24 24"><rect x="3" y="5" width="18" height="16" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 3v4M8 3v4M3 10h18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <?php elseif ($p['icone'] === 'doc'): ?>
                            <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M14 2v6h6M9 13h6M9 17h4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <?php else: ?>
                            <svg viewBox="0 0 24 24"><path d="M17 2.1l4 4-4 4M3 12.2v-2a4 4 0 0 1 4-4h14M7 21.9l-4-4 4-4M21 11.8v2a4 4 0 0 1-4 4H3" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <?php endif; ?>
                    </span>
                    <span class="org-pending-text">
                        <strong><?= e($p['titulo']) ?></strong>
                        <small><?= e($p['subtitulo']) ?></small>
                    </span>
                    <span class="org-shortcut-arrow" aria-hidden="true">›</span>
                </button>
            <?php endforeach; ?>
        </div>
    </article>

    <!-- Card Ações rápidas -->
    <article class="org-widget card" data-reveal data-delay="120">
        <header class="org-widget-head">
            <h2 class="org-widget-title org-title-with-icon">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M13 2 3 14h9l-1 8 10-12h-9l1-8z" fill="currentColor"/></svg>
                Ações rápidas
            </h2>
        </header>

        <div class="org-qactions-list">
            <button type="button" class="org-qaction-btn" data-quick-action="lembrete">
                <span class="org-qaction-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M22 2 11 13M22 2l-7 20-4-9-9-4 20-7z" fill="currentColor"/></svg>
                </span>
                <strong>Enviar lembrete de pagamento</strong>
            </button>

            <button type="button" class="org-qaction-btn" data-quick-action="relatorio-financeiro">
                <span class="org-qaction-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4M7 10l5 5 5-5M12 15V3" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </span>
                <strong>Baixar relatório financeiro</strong>
            </button>

            <button type="button" class="org-qaction-btn" data-quick-action="exportar-pendencias">
                <span class="org-qaction-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" fill="none" stroke="currentColor" stroke-width="2"/><path d="M14 2v6h6M9 15h6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </span>
                <strong>Exportar lista de pendências</strong>
            </button>

            <button type="button" class="org-qaction-btn" data-quick-action="configurar-pagamento">
                <span class="org-qaction-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M2 10h20" stroke="currentColor" stroke-width="2"/></svg>
                </span>
                <strong>Configurar formas de pagamento</strong>
            </button>
        </div>
    </article>
</section>

<script>
window.EVENTCOP_RECEITAS = <?= json_encode($receitasMensais, JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?>;
</script>

<?php require ROOT_PATH . '/includes/layout/panel_close.php'; ?>
