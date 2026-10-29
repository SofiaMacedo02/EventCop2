<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$erro    = '';
$sucesso = '';

if (isset($_GET['cadastro']) && $_GET['cadastro'] === 'sucesso') {
    $sucesso = 'Cadastro realizado com sucesso! Faça login para continuar.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim((string) ($_POST['email'] ?? ''));
    $senha = (string) ($_POST['senha'] ?? '');

    if (login_mock('participante', $email, $senha)) {
        flash('ok', 'Login realizado com sucesso!');
        redirect_to('galeria');
    } else {
        $erro = 'Por favor, preencha seu e-mail e senha para entrar.';
    }
}

$flashes   = flash_consumir();
$pageTitle = 'Login de Participante | EventCop';
$pageCss   = ['pages/flow.css'];
$menuAtivo = 'home';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="banner">
        <div class="banner-texto">
            <h1>Você está em boas mãos</h1>
            <p>“A EventCop tornou a organização do nosso evento muito mais simples.
               Conseguimos centralizar as inscrições, acompanhar os participantes e disponibilizar todas as informações em um só lugar.”
            </p>
        </div>
    </section>

    <div class="form-wizard">
        <section class="cadastro_organizador active">
            <h1>Bem-vindo de Volta!</h1>
            <p>Preencha os campos abaixo para realizar o seu acesso como participante:</p>

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

            <form class="formulario_organizador" action="<?= route('login') ?>" method="POST">
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="seuemail@exemplo.com" required>

                <label for="senha">Sua senha de acesso:</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Entrar</button>
                </div>

                <p class="text-muted">Não possui conta? <a href="<?= route('cadastro') ?>">Cadastre-se</a></p>
                <p class="text-muted">É organizador? <a href="<?= route('login_admin') ?>">Login de Organizador</a></p>
            </form>
        </section>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
