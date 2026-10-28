<?php
/**
 * Abre a casca do PAINEL do organizador (topbar + sidebar + <main class="panel-main">).
 * Variáveis: $painelAtivo = 'inicio' | 'relatorios' | 'pagamentos'.
 * Feche com includes/layout/panel_close.php.
 */
$painelAtivo = $painelAtivo ?? 'inicio';
$__u = usuario_logado() ?? ['nome' => 'Marina Oliveira', 'avatar' => 'img/imagem marina.png'];
$__itens = [
    'inicio'     => ['Início', 'dashboard', 'M3 10.5 12 3l9 7.5V21h-6v-6H9v6H3z'],
    'relatorios' => ['Relatórios e métricas', 'relatorios', 'M3 3v18h18M7 15l4-4 3 3 5-6'],
    'pagamentos' => ['Pagamentos e pendências', 'pagamentos', 'M6 2h9l5 5v15H6zM14 2v6h6M9 13h6M9 17h6'],
];
?>
<header class="panel-topbar">
    <a href="<?= route('dashboard') ?>" class="panel-logo">
        <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop">
    </a>
    <button type="button" class="panel-burger" aria-label="Abrir menu lateral" data-panel-toggle><span></span><span></span><span></span></button>
    <div class="panel-topbar-right">
        <a href="<?= route('home') ?>" class="panel-top-link">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M3 10.5 12 3l9 7.5V21h-6v-6H9v6H3z" fill="currentColor"/></svg>
            Início
        </a>
        <button type="button" class="panel-bell" aria-label="Notificações" data-toast="Você não tem novas notificações.">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 22a2.5 2.5 0 0 0 2.5-2.5h-5A2.5 2.5 0 0 0 12 22zm7-6V11a7 7 0 0 0-5-6.7V3a2 2 0 0 0-4 0v1.3A7 7 0 0 0 5 11v5l-2 2v1h18v-1z" fill="currentColor"/></svg>
            <span class="panel-bell-dot"></span>
        </button>
        <div class="panel-user">
            <img src="<?= asset($__u['avatar'] ?? 'img/imagem marina.png') ?>" alt="">
            <span><?= e($__u['nome']) ?></span>
        </div>
    </div>
</header>

<div class="panel-shell">
    <aside class="panel-sidebar" data-panel-sidebar>
        <nav class="panel-nav">
<?php foreach ($__itens as $chave => [$rotulo, $rota, $icone]): ?>
            <a href="<?= route($rota) ?>" class="panel-nav-item<?= ativo($painelAtivo, $chave) ?>">
                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="<?= $icone ?>" fill="<?= $chave === 'inicio' ? 'currentColor' : 'none' ?>" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?= e($rotulo) ?>
            </a>
<?php endforeach; ?>
        </nav>
        <a href="<?= route('logout') ?>" class="panel-nav-item panel-logout">
            <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M9 21H5V3h4M16 17l5-5-5-5M21 12H9" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Sair
        </a>
    </aside>
    <div class="panel-backdrop" data-panel-backdrop></div>

    <main class="panel-main">
