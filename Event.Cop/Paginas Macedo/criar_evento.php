<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
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
    <section class="topo">
        <div class="testos">
            <h1>Hora da Ação</h1> <!-- php com o neme da pessoa -->
            <p>Gerencie seus eventos, crie novos, veja seus participantes e gere certificações em apenas um só lugar.</p>
        </div>
    </section>

    <section class="eventos">
        <div class="filtros"></div>
        <div class="evento"></div>
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
            <h1>Criar Evento</h1>
            <section class="cadastro_evento">
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
                <div class="botoes">
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <h3>Data e Hora</h3>
                
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
<footer class="footer">
    <div class="footer-coluna footer-empresa">
        <img src="../imgs/logonv.jpeg" alt="EventCop" class="logo-footer">
        <p class="descricao-footer">
            A plataforma completa para planejar,
            organizar e executar eventos
            corporativos com eficiência.
        </p>
        <div class="traco"></div>
        <div class="footer-info">
            <img src="../imgs/imagem localizacao footer.png" alt="Localização">
            <p>
                Avenida das Nações, nº 850<br>
                São José dos Campos - SP<br>
                CEP: 12227-000
            </p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem CNPJ footer.png" alt="Documento">
            <p>CNPJ: 48.729.315/0001-62</p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem e-mail footer.png" alt="E-mail">
            <p> contato@eventcop.com.br </p>
        </div>
        <div class="footer-info">
            <img src="../imgs/imagem telefone footer.png" alt="Telefone">
            <p> (12) 3456-7890</p>
        </div>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem calendario footer.png" alt="Calendário">
            <div>
                <h3>Tipos de Eventos</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="">› Corporativos</a>
        <a href="">› Workshops e Palestras</a>
        <a href="">› Treinamentos</a>
        <a href="">› Feiras e Exposições</a>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem recursos plataforma footer.png" alt="Recursos">
            <div>
                <h3>Recursos da<br>Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="">› Gestão de Eventos</a>
        <a href="">› Inscrições e Convites</a>
        <a href="">› Relatórios e Métricas</a>
        <a href="">› Agendamento com Consultores</a>
    </div>
    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="../imgs/imagem comece na plataforma footer.png" alt="Comece na plataforma">
            <div>
                <h3></h3>Comece na<br>Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="">› Criar minha conta</a>
        <a href="">› Quero organizar um evento</a>
        <div class="ajuda">
            <img src="../imgs/imagem precisa de ajuda footer.png" alt="Atendimento" class="fone-ajuda">
            <div>
                <h3>Precisa de ajuda?</h3>
                <p>Nossa equipe está pronta<br>para te atender!</p>
                <a href="" class="btn-fale"> Fale conosco <span>→</span> </a>
            </div>
        </div>
    </div>
    <div class="footer-baixo">
        <div class="redes">
            <strong>Siga-nos</strong>
            <img src="../imgs/imagem redes sociais footer.png" alt="Instagram, LinkedIn e YouTube">
        </div>
        <p> ©️ 2026 EventCop. Todos os direitos reservados.</p>
        <div class="footer-politicas">
            <a href=""> Política de Privacidade</a>
            <span>|</span>
            <a href="">Termos de Uso</a>
        </div>
    </div>
</footer>

</body>
</html>