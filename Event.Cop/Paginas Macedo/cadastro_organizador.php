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
                // Verificar se o e-mail de organizador já existe
                $checkSql = "SELECT id_orga FROM organizadores WHERE email_orga = :email LIMIT 1";
                $checkStmt = $pdo->prepare($checkSql);
                $checkStmt->bindParam(':email', $email, PDO::PARAM_STR);
                $checkStmt->execute();

                if ($checkStmt->fetch()) {
                    $erro = "Este e-mail já está cadastrado como organizador. Acesse pelo login.";
                } else {
                    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO organizadores (nome_orga, email_orga, telefone_orga, senha_orga) 
                            VALUES (:nome, :email, :telefone, :senha)";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
                    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                    $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
                    $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
                    $stmt->execute();

                    $novoId = $pdo->lastInsertId();

                    // Iniciar a sessão do organizador imediatamente
                    session_regenerate_id(true);
                    $_SESSION["user_id"] = $novoId;
                    $_SESSION["user_nome"] = $nome;
                    $_SESSION["user_email"] = $email;
                    $_SESSION["user_tipo"] = "organizador";

                    header("Location: criar_evento.php");
                    exit;
                }
            } catch (PDOException $e) {
                error_log("Erro no cadastro de organizador: " . $e->getMessage());
                $erro = "Erro ao cadastrar organizador. Tente novamente mais tarde.";
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
    <title>Cadastro do Organizador - EventCop</title>
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

            <?php if (!empty($erro)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 12px; border-radius: 6px; margin-bottom: 16px; border: 1px solid #f5c6cb;">
                    <?= htmlspecialchars($erro) ?>
                </div>
            <?php endif; ?>

            <form class="formulario_organizador" action="cadastro_organizador.php" method="POST">
                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
                
                <label for="email">E-mail corporativo:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                
                <label for="telefone">Telefone de contato:</label>
                <input type="tel" id="telefone" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>" required>
                
                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  
                
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Criar Conta de Organizador</button>
                </div>

                <p style="margin-top: 15px; text-align: center;">Já possui uma conta? <a href="login_organizadores.php">Entrar como Organizador</a></p>
            </form>
        </section>
    </div>
</main>
</body>
</html>
