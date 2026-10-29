<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim((string) ($_POST['nome'] ?? ''));
    $email    = trim((string) ($_POST['email'] ?? ''));
    $telefone = trim((string) ($_POST['telefone'] ?? ''));
    $senha    = (string) ($_POST['senha'] ?? '');

    if ($nome !== '' && $email !== '' && $telefone !== '' && $senha !== '') {
        if (cadastrar_mock('organizador', [
            'nome'     => $nome,
            'email'    => $email,
            'telefone' => $telefone,
        ])) {
            flash('ok', 'Conta de organizador criada com sucesso!');
            redirect_to('dashboard');
        } else {
            $erro = 'Por favor, informe um endereço de e-mail válido.';
        }
    } else {
        $erro = 'Por favor, preencha todos os campos obrigatórios.';
    }
}

$pageTitle = 'Cadastro do Organizador | EventCop';
$pageCss   = ['pages/flow.css'];
$menuAtivo = 'admin';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main>
    <section class="banner">
        <div class="banner-texto">
            <h1>Junte-se à EventCop</h1>
            <p>“A EventCop tornou a organização do nosso evento muito mais simples.
               Conseguimos centralizar as inscrições, acompanhar os participantes e disponibilizar todas as informações em um só lugar.”
            </p>
        </div>
    </section>

    <div class="form-wizard">
        <section class="cadastro_organizador active">
            <h1>Bem-vindo ao time EventCop!</h1>
            <p>Crie sua conta para começar a publicar e gerenciar seus eventos:</p>

            <?php if ($erro !== ''): ?>
                <div class="alert alert-erro"><?= e($erro) ?></div>
            <?php endif; ?>

            <form class="formulario_organizador" action="<?= route('cadastro_admin') ?>" method="POST">
                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= e($_POST['nome'] ?? '') ?>" placeholder="Nome do responsável ou empresa" required>

                <label for="email">E-mail corporativo:</label>
                <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="contato@empresa.com.br" required>

                <label for="telefone">Telefone de contato:</label>
                <input type="tel" id="telefone" name="telefone" value="<?= e($_POST['telefone'] ?? '') ?>" placeholder="(11) 99999-9999" required>

                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Criar Conta de Organizador</button>
                </div>

                <p class="text-muted">Já possui uma conta? <a href="<?= route('login_admin') ?>">Entrar como Organizador</a></p>
            </form>
        </section>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
