<?php
require_once "../Paginas Vitoria/config.php";
require_once "../Paginas Vitoria/auth.php";

$erro = "";
$sucesso = "";

if (isset($_GET["cadastro"]) && $_GET["cadastro"] === "sucesso") {
    $sucesso = "Organizador cadastrado com sucesso! Faça login para gerenciar seus eventos.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"] ?? "");
    $senha = $_POST["senha"] ?? "";

    if (!empty($email) && !empty($senha)) {
        try {
            $sql = "SELECT * FROM organizadores WHERE email_orga = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            $userBanco = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userBanco && password_verify($senha, $userBanco["senha_orga"])) {
                session_regenerate_id(true);
                $_SESSION["user_id"] = $userBanco["id_orga"];
                $_SESSION["user_nome"] = $userBanco["nome_orga"];
                $_SESSION["user_email"] = $userBanco["email_orga"];
                $_SESSION["user_tipo"] = "organizador";

                header("Location: criar_evento.php");
                exit;
            } else {
                $erro = "E-mail ou senha de organizador incorretos.";
            }
        } catch (PDOException $e) {
            error_log("Erro no login organizador: " . $e->getMessage());
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
    <title>Login do Organizador - EventCop</title>
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

            <form class="formulario_organizador" action="login_organizadores.php" method="POST">
                <label for="email">E-mail do organizador:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                
                <label for="senha">Sua senha:</label>
                <input type="password" id="senha" name="senha" required>  
                
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Entrar como Organizador</button>
                </div>

                <p style="margin-top: 15px; text-align: center;">Novo organizador? <a href="cadastro_organizador.php">Criar conta de organizador</a></p>
                <p style="margin-top: 5px; text-align: center;">É participante? <a href="login_normal.php">Login de Participante</a></p>
            </form>
        </section>
    </div>
</main>
</body>
</html>
