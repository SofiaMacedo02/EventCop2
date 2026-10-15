<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body class="body_criar_evento">
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
<main class="main_criar_evento">
    <section class="topo">
        <div class="testos">
            <h1>Hora da Ação</h1>
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
            <p>Siga as etapas para criar e publicar seu evento.</p>

            <section class="cadastro_evento">
                <div class="barra_progresso" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                        <div><span>1</span></div>
                        <div class="progresso" style="width: 25%;"></div>
                </div>
                <label for="nome_evento">Nome do Evento:</label>
                <input type="text" id="nome_evento" name="nome_evento" required>
                
                <label for="descricao">Descrição do Evento:</label>
                <textarea id="descricao" name="descricao" required></textarea>
                
                <div class="div_selects">
                    <div>
                        <label for="categoria">Categoria do Evento:</label>
                        <select id="categoria" name="categoria" required>
                            <option value="" disabled selected>Selecione a categoria</option>
                            <option value="1">Workshop</option>
                            <option value="2">Corporativo</option>
                            <option value="3">Network</option>
                            <option value="4">Educacional</option>
                        </select>
                    </div> 
                </div>

                <div class="botoes">
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <div class="barra_progresso" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">
                    <div><span>2</span></div>
                    <div class="progresso" style="width: 50%;"></div>
                </div>
                <section class="data_hora">
                    <h3>Data e Hora</h3>
                    <label for="data_inicio">Data e Hora de Início:</label>
                    <input type="datetime-local" id="data_inicio" name="data_inicio" required>

                    <label for="data_termino">Data e Hora de Término:</label>
                    <input type="datetime-local" id="data_termino" name="data_termino" required>
                </section>
                
                <section class="local">
                    <h3>Local do evento</h3>
                    <label for="nome_local">Nome do Local:</label>
                    <input type="text" id="nome_local" name="nome_local" required>
                    
                    <label for="endereco">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" required>
                    
                    <div class="como_sera_select">
                        <label>
                            <input type="radio" name="formato" value="presencial" required checked>
                            <span>Presencial</span>
                        </label>
                        <label>
                            <input type="radio" name="formato" value="online">
                            <span>Online</span>
                        </label>
                        <label>
                            <input type="radio" name="formato" value="hibrido">
                            <span>Híbrido</span>
                        </label>
                    </div>
                </section>

                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <div class="barra_progresso" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                    <div><span>3</span></div>
                    <div class="progresso" style="width: 75%;"></div>
                </div>
                <section class="atividades">
                    <h3>Atividades</h3>
                    <div class="como_sera_select">
                        <label class="btn-radio">
                            <input type="radio" name="tipo_atividade" value="palestra" required checked> 
                            <span>Palestra</span>
                        </label>
                        <label class="btn-radio">
                            <input type="radio" name="tipo_atividade" value="oficina"> 
                            <span>Oficina</span>
                        </label>
                        <label class="btn-radio">
                            <input type="radio" name="tipo_atividade" value="painel"> 
                            <span>Painel</span>
                        </label>
                        <label class="btn-radio">
                            <input type="radio" name="tipo_atividade" value="networking"> 
                            <span>Networking</span>
                        </label>
                    </div>
                    <label for="titulo_atividade">Título da atividade</label>
                    <input type="text" id="titulo_atividade" name="titulo_atividade" required placeholder="Ex.: Futuro da Tecnologia">
                    
                    <label for="responsavel">Palestrante / Responsável</label>
                    <input type="text" id="responsavel" name="responsavel" required placeholder="Nome do palestrante">
                    
                    <label for="descricao_curta">Descrição curta (opcional)</label>
                    <textarea id="descricao_curta" name="descricao_curta" placeholder="Breve descrição da atividade..."></textarea>
                </section>
                <section class="cronograma">
                    <h3>Cronograma do evento</h3>
                    <div class="cronograma-topo">
                        <span class="cronograma-data">15 de setembro de 2026</span>
                        <button type="button" class="btn-adicionar-atividade">
                            <span>+</span> Adicionar atividade
                        </button>
                    </div>
                </section>
                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="button" class="btn_avancar">Avançar</button>
                </div>
            </section>

            <section class="cadastro_evento" hidden>
                <div class="barra_progresso" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                    <div><span>4</span></div>
                    <div class="progresso" style="width: 100%;"></div>
                </div>
                <section class="inscricoes">
                    <div class="tipo-inscricao-container">
                        <h3>Tipo de inscrição</h3>
                        <label class="card-opcao">
                            <input type="radio" name="tipo_inscricao" value="gratuito" checked>
                            <div class="card-conteudo">
                                <div class="radio-circle"></div>
                                <div class="texto-opcao">
                                    <strong>Gratuito</strong>
                                    <p>Inscrição sem custo.</p>
                                </div>
                            </div>
                        </label>
                        <label class="card-opcao">
                            <input type="radio" name="tipo_inscricao" value="pago">
                            <div class="card-conteudo">
                                <div class="radio-circle"></div>
                                <div class="texto-opcao">
                                    <strong>Pago</strong>
                                    <p>Com valor de inscrição.</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </section>
                
                <section class="limite_publico">
                    <h3>Limites e público</h3>
                    <div class="linha-vagas-espera">
                        <div class="campo-grupo">
                            <label for="vagas">Vagas disponíveis</label>
                            <input type="number" id="vagas" name="vagas" value="300" required>
                        </div>
                        <div class="campo-grupo toggle-inline">
                            <span class="toggle-label">Lista de espera</span>
                            <label class="toggle-wrapper">
                                <input type="checkbox" name="lista_espera" checked>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="campo-grupo">
                        <label for="publico">Público-alvo</label>
                        <select id="publico" name="publico" required>
                            <option value="" disabled selected>Selecione o público</option>
                            <option value="geral">Público Geral</option>
                            <option value="estudantes">Estudantes</option>
                            <option value="profissionais">Profissionais</option>
                        </select>
                    </div>
                </section>
                <section class="informacoes_extras">
                    <h3>Informações extras</h3>
                    <label class="toggle-wrapper">
                        <span>Exigir aprovação manual</span>
                        <input type="checkbox" name="exigir_aprovacao">
                        <span class="slider"></span>
                    </label>
                    <label class="toggle-wrapper">
                        <span>Permitir cancelamento</span>
                        <input type="checkbox" name="permitir_cancelamento" checked>
                        <span class="slider"></span>
                    </label>
                    <label class="toggle-wrapper">
                        <span>Enviar e-mail de confirmação</span>
                        <input type="checkbox" name="enviar_email_confirmacao" checked>
                        <span class="slider"></span>
                    </label>
                </section>
                <div class="botoes">
                    <button type="button" class="btn_voltar">Voltar</button>
                    <button type="submit" class="btn_cadastrar">Criar Evento</button>
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