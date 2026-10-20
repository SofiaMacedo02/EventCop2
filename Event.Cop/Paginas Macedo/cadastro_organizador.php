<?php 
require_once "../Paginas Vitoria/config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
$nome = trim($_POST["nome"]);
$email = trim($_POST["email"]);
$telefone = trim($_POST["telefone"]);
$senha = $_POST["senha"];

    if (!empty($nome) && !empty($email) && !empty($telefone) && !empty($senha)) {
        try {
            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO organizadores (nome_orga, email_orga, telefone_orga, senha_orga) 
                    VALUES (:nome, :email, :telefone, :senha)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':telefone', $telefone, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $senhaHash, PDO::PARAM_STR);
            $stmt->execute();

            header("Location: criar_evento.php");
            exit;
        } catch (PDOException $e) {
            echo "Erro" . $e->getMessage();
        }
    }
} else {
    $erro = "Por favor, preencha todos os campos obrigatórios.";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Usuário - EventCop</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>

<header class="header">
    <a href="index.php">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-header">
    </a>
    <nav class="menu">
        <ul>
            <li><a href="../Paginas Leticia/index.php">Home</a></li>
            <li><a href="../Paginas Leticia/empresas.php">EventCop Empresas</a></li>
            <li><a href="../Paginas Leticia/cases.php">Cases</a></li>
            <li><a href="../Paginas Leticia/planos_preços">Planos e Preços</a></li>
            <li><a href="">Sou um organizador</a></li>
            <li><a href="" class="btn-header">Criar Evento</a></li>
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
            <h1>Bem-vindo ao time EventCop!</h1>
            <p>Parabéns por se juntar a nós!</p>
            <p>Preencha os campos abaixo para criar sua conta:</p>

            <form class="formulario_organizador" action="cadastro_organizador.php" method="POST">
                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" required>
                <label for="telefone">Seu telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>
                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Criar Conta</button>
                </div>

                <p>Já possui uma conta? <a href="login_normal">Entrar</a></p>
            </form>
        </section>
    </div>
</main>
</body>
</html>

