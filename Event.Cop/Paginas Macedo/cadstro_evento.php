<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Evento</title>
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

    <form class="form-wizard" action="cadastro_evento.php" method="POST">
        <div class="completed" hidden>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <h3>Cadastro Realizado com Sucesso!</h3>
            <p>O seu evento foi criado.</p>
        </div>

        <div class="formularios_eventos">
            <section class="cadastro_evento">
                <h1>Vamos Criar seu Evento!</h1>
                <div class="barra">
                    <p class="barra_txt">Passo 1 de 3</p>
                    <div class="barra_progresso" role="progressbar" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                        <div class="progresso" style="width: 33.3%;"></div>
                    </div>
                </div>
                <div class="div_cep">
                    <div>
                        <label for="cidade">Cidade:</label>
                        <input type="text" id="cidade" name="cidade" required>
                    </div>
                    <div>
                        <label for="estado">Estado:</label>
                        <input type="text" id="estado" name="estado" required>
                    </div>
                </div>
                <label for="nome_evento">Nome do Evento:</label>
                <input type="text" id="nome_evento" name="nome_evento" required>
                <label for="descricao">Descrição do Evento:</label>
                <textarea id="descricao" name="descricao" required></textarea>
                <div class="div_selects">
                    <div>
                        <label for="tipo">Tipo do Evento:</label>
                        <select id="tipo" name="tipo" required>
                            <option value="1">Evento Público</option>
                            <option value="2">Evento Privado</option>
                        </select>
                    </div>
                    <div>
                        <label for="categoria">Categoria do Evento:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="1">Workshop</option>
                            <option value="2">Corporativo</option>
                            <option value="3">Network</option>
                            <option value="4">Educaçional</option>
                        </select>
                    </div> 
                </div>
                <div class="checkboxes_selects">
                    <label>O seu evento será?</label>
                    <label><input type="radio" name="formato" value="presencial" required> Evento presencial</label>
                    <label><input type="radio" name="formato" value="online"> Evento online</label>
                    <label><input type="radio" name="formato" value="hibrido"> Evento híbrido</label>
                </div>
                <div class="botoes">
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <h1>Perfeito! Conte-nos mais sobre você</h1>
                <div class="barra">
                    <p class="barra_txt">Passo 2 de 3</p>
                    <div class="barra_progresso" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100">
                        <div class="progresso" style="width: 66.6%;"></div>
                    </div>
                </div>

                <label for="nome">Seu Nome:</label>
                <input type="text" id="nome" name="nome" required>
                <label for="email">Seu e-mail:</label>
                <input type="email" id="email" name="email" required>
                <label for="telefone">Seu telefone:</label>
                <input type="tel" id="telefone" name="telefone" required>
                <label for="senha">Crie uma senha de acesso:</label>
                <input type="password" id="senha" name="senha" required>  

                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <h1>Do que o seu evento precisa?</h1>
                <div class="barra">
                    <p class="barra_txt">Passo 3 de 3</p>
                    <div class="barra_progresso" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progresso" style="width: 100%;"></div>
                    </div>
                </div>

                <div class="checkboxs_eventos">
                    <label class="checkbox_evento" for="inscricoes">
                        <h4>Inscrições</h4>
                        <p>Criar inscrições personalizadas e permitir que participantes se inscrevam de forma simples e rápida</p>
                        <input type="checkbox" id="inscricoes" name="recursos[]" value="inscricoes">
                    </label>
                    <label class="checkbox_evento" for="certificados">
                        <h4>Certificados</h4>
                        <p>Gere e disponibilize certificados para os participantes</p>
                        <input type="checkbox" id="certificados" name="recursos[]" value="certificados">
                    </label>
                    <label class="checkbox_evento" for="programacao">
                        <h4>Programação</h4>
                        <p>Organize horários, palestras, workshops e atividades do seu evento</p>
                        <input type="checkbox" id="programacao" name="recursos[]" value="programacao">
                    </label>
                    <label class="checkbox_evento" for="credenciais">
                        <h4>Credenciais</h4>
                        <p>Facilite a entrada dos participantes e acompanhe os inscritos</p>
                        <input type="checkbox" id="credenciais" name="recursos[]" value="credenciais">
                    </label>
                    <label class="checkbox_evento" for="submissoes">
                        <h4>Submissões de Trabalhos</h4>
                        <p>Receba e gerencie submissões de trabalhos, projetos e apresentações</p>
                        <input type="checkbox" id="submissoes" name="recursos[]" value="submissoes">
                    </label>
                    <label class="checkbox_evento" for="gestao_eventos">
                        <h4>Gestão de eventos</h4>
                        <p>Acompanhe e gerencie inscrições e informações para manter o controle do seu evento</p>
                        <input type="checkbox" id="gestao_eventos" name="recursos[]" value="gestao_eventos">
                    </label>
                </div>

                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="submit" class="btn_cadastrar">Cadastrar Evento</button>
                </div>
            </section>

        </div>
    </form>
</main>
</body>
</html>