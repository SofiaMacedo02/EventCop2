<?php 
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

$erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = trim($_POST["nome"] ?? "");
    $email = trim($_POST["email"] ?? "");
    $telefone = trim($_POST["telefone"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha)) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erro = "Por favor, informe um endereço de e-mail válido.";
        } else {
            try {
                // Verificar se o email já existe
                $checkSql = "SELECT id_user FROM usuarios WHERE email_user = :email LIMIT 1";
                $checkStmt = $pdo->prepare($checkSql);
                $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
                $checkStmt->execute();

                if ($checkStmt->fetch()) {
                    $erro = "Este e-mail já está cadastrado como participante. Faça login.";
                } else {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO usuarios (nome_user, email_user, senha_user, telefone_user) VALUES (:nome, :email, :senha, :telefone)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
                    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                    $stmt->execute();

                    header("Location: login_normal.php?cadastro=sucesso");
                    exit;
                }
            } catch (PDOException $e) {
                error_log("Erro no cadastro de participante: " . $e->getMessage());
                $erro = "Erro ao realizar cadastro. Tente novamente mais tarde.";
            }
        }
    } else {
        $erro = "Por favor, preencha todos os campos obrigatórios.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Participante - EventCop</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="header">
    <a href="../Paginas Leticia/index.php">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="../Paginas Leticia/index.php">Home</a></li>
            <li><a href="../Paginas Leticia/empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Leticia/cases.php">Cases</a></li>
            <li><a href="../Paginas Leticia/planos_precos.php">Planos e Preços</a></li>
            <li><a href="login_organizadores.php">Sou um organizador</a></li>
            <li><a href="criar_evento.php" class="btn-header">Criar Evento</a></li>
        </ul>
    </nav>
</header>

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

            <?php if (!empty($erro)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid #f5c6cb;">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form class="formulario_user" action="cadastro_normal.php" method="POST">
                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                
                <label for="telefone">Seu telefone:</label>
                <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" required>
                
                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  
                
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Criar Conta</button>
                </div>

                <p style="margin-top: 15px; text-align: center;">Já possui uma conta? <a href="login_normal.php">Entrar</a></p>
            </form>
        </section>
    </div>
</main>
</body>
</html>
