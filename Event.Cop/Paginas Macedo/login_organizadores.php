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
            <li><a href="index.php">Home</a></li>
            <li><a href="">EventCop Empresas</a></li>
            <li><a href="">Cases</a></li>
            <li><a href="">Planos e Preços</a></li>
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
            <h1>Bem-vindo ao time de Volta!</h1>
            <p>Preencha os campos abaixo para realizar o seu acesso:</p>

            <form class="formulario_organizador" action="cadastro_organizador.php" method="POST">
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" required>
                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  
                <div class="botoes">
                    <button type="submit" class="btn_cadastrar">Entrar</button>
                </div>
            </form>
        </section>
    </div>
</main>

</body>
</html>