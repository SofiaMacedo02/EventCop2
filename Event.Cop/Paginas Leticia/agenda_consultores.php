<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Agenda - Consultores | EventCop</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>
 <header class="header">
    <a href="index.php">
        <img src="../imgs/logo_footer.jpeg" alt="EventCop" class="logo-header">
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

<main class="pagina-agenda">
    <section class="area-consultores">
        <h1>Consultores disponívei <br> no momento</h1>
        <div class="consultores-grid">
            <button class="consultor-card ativo" data-consultor="juliana">
                <div class="foto-consultor">
                    <img src="img/imagem juliana.png" alt="Juliana Campos">
                </div>
                <div class="consultor-info">
                    <strong>Juliana Campos</strong>
                    <span>Consultora de Eventos</span>
                    <small>São Paulo, SP</small>
                </div>
            </button>
            <button class="consultor-card"
                    data-consultor="marina">
                <div class="foto-consultor">
                    <img src="img/imagem marina.png"alt="Marina Oliveira">
                </div>
                <div class="consultor-info">
                    <strong>Marina Oliveira</strong>
                    <span>Consultora de Eventos</span>
                    <small>Rio de Janeiro, RJ</small>
                </div>
            </button>
            <button class="consultor-card" data-consultor="rafael">
                <div class="foto-consultor">
                    <img src="img/imagem rafael.png" alt="Rafael Santos">
                </div>
                <div class="consultor-info">
                    <strong>Rafael Santos</strong>
                    <span>Consultor de Negócios</span>
                    <small>Salvador, BA</small>
                </div>
            </button>
            <button class="consultor-card" data-consultor="isabela">
                <div class="foto-consultor">
                    <img src="img/imagem isabela.png" alt="Isabela Ferreira">
                </div>
                <div class="consultor-info">
                    <strong>Isabela Ferreira</strong>
                    <span>Consultora de Atendimento</span>
                    <small>Curitiba, PR</small>
                </div>
            </button>
            <button class="consultor-card" data-consultor="lucas">
                <div class="foto-consultor">
                    <img src="img/imagem lucas.png" alt="Lucas Mendes">
                </div>
                <div class="consultor-info">
                    <strong>Lucas Mendes</strong>
                    <span>Consultor de Tecnologia</span>
                    <small>Belo Horizonte, MG</small>
                </div>
            </button>
            <button class="consultor-card"
                    data-consultor="pedro">
                <div class="foto-consultor">
                    <img src="img/imagem pedro.png" alt="Pedro Almeida">
                </div>
                <div class="consultor-info">
                    <strong>Pedro Almeida</strong>
                    <span>Consultor de Soluções</span>
                    <small>Fortaleza, CE</small>
                </div>
            </button>
        </div>
    </section>
    <section class="area-agenda">
        <h2>Agenda:</h2>
        <!-- CALENDÁRIO -->
        <div class="calendario">
            <div class="calendario-topo">
                <button class="btn-mes" id="mesAnterior">‹</button>
                <strong id="mesAtual">Setembro de 2026</strong>
                <button class="btn-mes" id="mesProximo">›</button>
            </div>
            <div class="dias-semana">
                <span>Dom</span>
                <span>Seg</span>
                <span>Ter</span>
                <span>Qua</span>
                <span>Qui</span>
                <span>Sex</span>
                <span>Sáb</span>
            </div>
            <div class="dias-calendario" id="diasCalendario">
            </div>
            <div class="legenda">
                <span><i class="bolinha disponivel"></i>Disponível</span>
                <span> <i class="bolinha limitado"></i> Disponibilidade limitada </span>
                <span> <i class="bolinha indisponivel"></i> Indisponível</span>
            </div>
        </div>
        <div class="seta-agenda">⌄</div>
        <div class="horarios-box">
            <div class="horarios-cabecalho">
                <div>
                    <h3>▣ Horários disponíveis</h3>
                    <p id="dataSelecionada">Selecione uma data disponível</p>
                </div>
                <span>Duração da reunião: 60 min ◷</span>
            </div>
            <div class="horarios" id="listaHorarios"></div>
            <div class="aviso">
                ⓘ
                <span>Após escolher o horário, você receberá a confirmação por e-mail e WhatsApp.</span>
            </div>
            <button id="confirmarHorario" class="btn-confirmar" disabled> ▣ Confirmar horário selecionado</button>
        </div>
    </section>
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
            <p>Avenida das Nações, nº 850 <br> São José dos Campos - SP <br> CEP: 12227-000 </p>
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
    <script src="script.js"></script>
</body>
</html>