<?php
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

$erro = "";
$sucesso = "";

if (isset($_GET["cadastro"]) && $_GET["cadastro"] === "sucesso") {
    $sucesso = "Cadastro realizado com sucesso! Faça login para continuar.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (!empty($email) && !empty($senha)) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email_user = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $userBanco = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userBanco && password_verify($senha, $userBanco["senha_user"])) {
                session_regenerate_id(true);
                $_SESSION["user_id"] = $userBanco["id_user"];
                $_SESSION["user_nome"] = $userBanco["nome_user"];
                $_SESSION["user_email"] = $userBanco["email_user"];
                $_SESSION["user_tipo"] = "usuario";

                header("Location: ../Paginas Leticia/index.php");
                exit;
            } else {
                $erro = "E-mail ou senha incorretos.";
            }
        } catch (PDOException $e) {
            error_log("Erro no login: " . $e->getMessage());
            $erro = "Erro ao processar login. Tente novamente mais tarde.";
        }
    } else {
        $erro = "Por favor, preencha todos os campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Participante - EventCop</title>
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
            <li><a href="login_organizadores.php">Sou adm</a></li>
            <li><a href="criar_evento.php" class="btn-header">Divulgar o seu evento</a></li>
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
        <section class="cadastro_organizador active">
            <h1>Bem-vindo de Volta!</h1>
            <p>Preencha os campos abaixo para realizar o seu acesso como participante:</p>

            <?php if (!empty($erro)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid #f5c6cb;">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($sucesso)): ?>
                <div style="background-color: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid #c3e6cb;">
                    <?= htmlspecialchars($sucesso) ?>
                </div>
            <?php endif; ?>

            <form class="formulario_organizador" action="login_normal.php" method="POST">
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                
                <label for="senha">Sua senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  
                
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Entrar</button>
                </div>

                <p style="margin-top: 15px; text-align: center;">Não possui conta? <a href="cadastro_normal.php">Cadastre-se</a></p>
                <p style="margin-top: 5px; text-align: center;">É organizador? <a href="login_organizadores.php">Login de Organizador</a></p>
            </form>
        </section>
    </div>
</main>
</body>
</html>
