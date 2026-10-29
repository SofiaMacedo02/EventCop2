<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome     = trim((string) ($_POST['nome'] ?? ''));
    $email    = trim((string) ($_POST['email'] ?? ''));
    $telefone = trim((string) ($_POST['telefone'] ?? ''));
    $senha    = (string) ($_POST['senha'] ?? '');

    if ($nome !== '' && $email !== '' && $telefone !== '' && $senha !== '') {
        if (cadastrar_mock('participante', [
            'nome'     => $nome,
            'email'    => $email,
            'telefone' => $telefone,
        ])) {
            flash('ok', 'Conta criada com sucesso! Bem-vindo à EventCop.');
            redirect_to('galeria');
        } else {
            $erro = 'Por favor, informe um endereço de e-mail válido.';
        }
    } else {
        $erro = 'Por favor, preencha todos os campos obrigatórios.';
    }
}

$pageTitle = 'Cadastro de Participante | EventCop';
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
        <section class="cadastro_user active">
            <h1>Bem-vindo à EventCop!</h1>
            <p>Preencha os campos abaixo para criar sua conta de participante:</p>

            <?php if ($erro !== ''): ?>
                <div class="alert alert-erro"><?= e($erro) ?></div>
            <?php endif; ?>

            <form class="formulario_user" action="<?= route('cadastro') ?>" method="POST">
                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= e($_POST['nome'] ?? '') ?>" placeholder="Digite seu nome completo" required>

                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" value="<?= e($_POST['email'] ?? '') ?>" placeholder="seuemail@exemplo.com" required>

                <label for="telefone">Seu telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?= e($_POST['telefone'] ?? '') ?>" placeholder="(11) 99999-9999" required>

                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>

                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Criar Conta</button>
                </div>

                <p class="text-muted">Já possui uma conta? <a href="<?= route('login') ?>">Entrar</a></p>
            </form>
        </section>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
