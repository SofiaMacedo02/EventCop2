<?php
/**
 * Header público. Use $menuAtivo = 'home' | 'empresas' | 'admin' | 'divulgar' para destacar o item.
 */
$menuAtivo = $menuAtivo ?? '';
$__u = usuario_logado();
?>
<header class="header">
    <a href="<?= route('home') ?>" class="logo-link">
        <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop" class="logo-header">
    </a>

    <button type="button" class="menu-toggle" aria-label="Abrir menu" aria-expanded="false" data-menu-toggle>
        <span></span><span></span><span></span>
    </button>

    <nav class="menu" data-menu>
        <ul>
            <li><a href="<?= route('home') ?>" class="<?= $menuAtivo === 'home' ? 'is-active' : '' ?>">Home</a></li>
            <li><a href="<?= route('empresas') ?>" class="<?= $menuAtivo === 'empresas' ? 'is-active' : '' ?>">EventCop Empresas</a></li>
            <li>
                <?php if ($__u && $__u['tipo'] === 'organizador'): ?>
                    <a href="<?= route('dashboard') ?>" class="<?= $menuAtivo === 'admin' ? 'is-active' : '' ?>">Meu painel</a>
                <?php else: ?>
                    <a href="<?= route('login_admin') ?>" class="<?= $menuAtivo === 'admin' ? 'is-active' : '' ?>">Sou um adm</a>
                <?php endif; ?>
            </li>
            <?php if ($__u && $__u['tipo'] === 'participante'): ?>
                <li><a href="<?= route('galeria') ?>">Olá, <?= e(explode(' ', $__u['nome'])[0]) ?></a></li>
                <li><a href="<?= route('logout') ?>" class="btn-header">Sair</a></li>
            <?php else: ?>
                <li><a href="<?= route('criar_evento') ?>" class="btn-header">Divulgar meu evento</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
