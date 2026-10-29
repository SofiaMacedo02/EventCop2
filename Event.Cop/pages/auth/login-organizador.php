<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$erro    = '';
$sucesso = '';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso') {
    $sucesso = 'Organizador cadastrado com sucesso! Faça login para gerenciar seus eventos.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $senha = (string) ($_POST['senha'] ?? '');

    if (login_mock('organizador', $email, $senha)) {
        flash('ok', 'Bem-vinda ao painel do organizador, Marina Oliveira!');
        redirect_to('dashboard');
    } else {
        $erro = 'Por favor, preencha o e-mail e a senha de organizador.';
    }
}

$flashes   = flash_consumir();
$pageTitle = 'Login do Organizador | EventCop';
$pageCss   = ['pages/flow.css'];
$menuAtivo = 'admin';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="banner">
        <div class="banner-texto">
            <h1>Área do Organizador</h1>
            <p>“A EventCop tornou a organização do nosso evento muito mais simples.
               Conseguimos centralizar as inscrições, acompanhar os participantes e disponibilizar todas as informações em um só lugar.”
            </p>
        </div>
    </section>

    <div class="form-wizard">
        <section class="cadastro_organizador active">
            <h1>Acesse sua Conta</h1>
            <p>Preencha os campos abaixo para gerenciar e criar seus eventos:</p>

            <?php foreach ($flashes as $f): ?>
                <div class="alert alert-<?= $f['tipo'] === 'ok' ? 'ok' : ($f['tipo'] === 'erro' ? 'erro' : 'info') ?>">
                    <?= e($f['msg']) ?>
                </div>
            <?php endforeach; ?>

            <?php if ($erro !== ''): ?>
                <div class="alert alert-erro"><?= e($erro) ?></div>
            <?php endif; ?>

            <?php if ($sucesso !== ''): ?>
                <div class="alert alert-ok"><?= e($sucesso) ?></div>
            <?php endif; ?>

            <form class="formulario_organizador" action="<?= route('login_admin') ?>" method="POST">
                <label for="email">E-mail do organizador:</label>
                <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="marina@empresa.com.br" required>

                <label for="senha">Sua senha:</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Entrar como Organizador</button>
                </div>

                <p class="text-muted">Novo organizador? <a href="<?= route('cadastro_admin') ?>">Criar conta de organizador</a></p>
                <p class="text-muted">É participante? <a href="<?= route('login') ?>">Login de Participante</a></p>
            </form>
        </section>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
