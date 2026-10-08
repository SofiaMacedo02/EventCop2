<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Workshop | EventCop</title>
    <link rel="stylesheet" href="css_leticia.css">
</head>

<body>

    <header class="header">

        <a href="index.php">
            <img src="img/logo bege eventcop.jpg" alt="EventCop" class="logo-header">
        </a>

        <nav class="menu">
            <a href="index.php">Home</a>
            <a href="empresas.php">EventCop Empresas</a>
            <a href="cases.php">Cases</a>
            <a href="planos.php">Planos e Preços</a>
            <a href="organizador.php">Sou um organizador</a>

            <a href="criar-evento.php" class="btn-header">
                Criar Evento
            </a>
        </nav>

    </header>


    <main>

        <section class="hero">

            <h1>Crie seu Workshop com a EventCop</h1>

            <p>
                Divulgue patrocinadores, distribua materiais de apoio e facilite
                a organização das principais etapas do seu workshop com uma
                plataforma de eventos.
            </p>

            <a href="criar-workshop.php" class="btn-claro">
                Crie seu Workshop →
            </a>

        </section>

        <section class="vantagens">

            <h2>
                Conheça as vantagens da EventCop para seu Workshop
            </h2>

            <img
                src="img/Imagem do ChatGPT 26 de set. de 2026, 15_06_16.png"
                alt="Vantagens da EventCop"
                class="imagem-vantagens">


            <div class="linha"></div>

            <div class="organizadores">

                <div class="numero-organizadores">

                    <strong>+1 mil</strong>

                    <p>
                        Organizadores no<br>
                        Brasil inteiro fazem<br>
                        parte da EventCop
                    </p>

                </div>

                <img
                    src="img/organizadores.png"
                    alt="Organizadores EventCop no Brasil"
                    class="mapa-organizadores">

            </div>

        </section>

        <section class="precos">

            <h2>Quanto custa criar um Workshop?</h2>


            <div class="planos">


                <div class="plano">

                    <h3>Workshop Gratuito</h3>

                    <div class="valor-gratis">

                        <span>R$</span>

                        <strong>0</strong>

                    </div>

                    <p>Grátis para inscrições gratuitas</p>

                    <p>Participantes ilimitados</p>

                    <p>Importe seus participantes</p>

                    <p>Site personalizado</p>

                    <p>E-mails ilimitados</p>

                    <p>Inscrições via boleto, cartão e Pix</p>

                </div>

                <div class="plano">

                    <h3>Workshop Pago</h3>

                    <strong class="cifrao">$</strong>

                    <p>Todos os recursos do gratuito</p>

                    <p>Taxa de 10% sobre as inscrições</p>

                    <p>Seu dinheiro em 10 dias</p>

                    <p>Certificados ilimitados</p>

                </div>

            </div>


            <a href="criar-workshop.php" class="btn-vinho">
                Crie seu Workshop
                <span>→</span>
            </a>

        </section>

        <section class="dashboard">

            <div class="dashboard-imagem">

                <img
                    src="img/imagem dashboard.png"
                    alt="Dashboard EventCop">

            </div>


            <div class="dashboard-texto">

                <h2>
                    Planeje e organize seu Workshop<br>
                    2x mais rápido
                </h2>

                <p>
                    Inicie seus cursos e oficinas práticas agora mesmo.
                    Conte com a EventCop e não perca tempo organizando
                    as inscrições online, distribuição de certificados
                    e muito mais.
                </p>

                <a href="criar-workshop.php" class="btn-claro">
                    Crie seu Workshop →
                </a>

            </div>

        </section>

        <section class="atendimento">

            <h2>
                Solicite um orçamento e descubra todas as<br>
                vantagens da EventCop
            </h2>

            <p class="subtitulo-atendimento">
                Nosso(a) consultor(a) especialista entra em contato com você
            </p>


            <div class="atendimento-conteudo">

                <div class="consultora">

                    <img
                        src="img/imagem consultor.png"
                        alt="Atendimento personalizado EventCop">

                </div>


                <form
                    class="formulario"
                    action="atendimento.php"
                    method="POST">


                    <label for="nome">Nome*</label>

                    <div class="campo">

                        <div class="icone-campo">
                            <img src="img/imagem usuario 2.png" alt="Símbolo usuário">
                        </div>

                        <input
                            type="text"
                            id="nome"
                            name="nome"
                            placeholder="Nome"
                            required>

                    </div>

                    <label for="telefone">Telefone*</label>

                    <div class="campo">

                        <div class="icone-campo">
                            <img src="img/imagem telefone.png" alt="Símbolo telefone">
                        </div>

                        <input
                            type="tel"
                            id="telefone"
                            name="telefone"
                            placeholder="(DDD) Telefone"
                            required>

                    </div>

                    <label for="email">E-mail*</label>

                    <div class="campo">

                        <div class="icone-campo">
                            <img src="img/imagem e-mail.png" alt="Símbolo e-mail">
                        </div>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="Digite seu e-mail"
                            required>

                    </div>

                    <label for="motivo">Motivo do Contato*</label>

                    <div class="campo">

                        <div class="icone-campo">
                            <img src="img/imagem motivo do contato.png" alt="Símbolo contato">
                        </div>

                        <select
                            id="motivo"
                            name="motivo"
                            required>

                            <option value="" disabled selected>
                                Selecione uma opção
                            </option>

                            <option value="orcamento">
                                Solicitar orçamento
                            </option>

                            <option value="evento">
                                Organizar um evento
                            </option>

                            <option value="consultoria">
                                Falar com consultor
                            </option>

                            <option value="duvida">
                                Tirar uma dúvida
                            </option>

                        </select>

                    </div>

                    <button
                        type="submit"
                        class="btn-atendimento">

                        <img
                            src="img/logo receber atendimento personalizado.png"
                            alt="EventCop"
                            class="logo-botao">

                        <span>
                            Receber atendimento personalizado
                        </span>

                        <strong>→</strong>

                    </button>

                </form>

            </div>

        </section>


<section class="funcionalidades">

    <h2>
        Explore mais funcionalidades para o seu Workshop
    </h2>

    <div class="funcionalidades-conteudo">

        <div class="container-imagem-funcionalidades">
    <img
        src="img/imagem funcionalidades3.png"
        alt="Funcionalidades EventCop"
        class="imagem-funcionalidades">

    <div class="botoes-funcionalidades">

        <a href="divulgacao.php" class="btn-funcionalidade">Saiba mais</a>

        <a href="inscricoes.php" class="btn-funcionalidade">Saiba mais</a>

        <a href="eventos.php" class="btn-funcionalidade">Saiba mais</a>

        <a href="relatorios.php" class="btn-funcionalidade">Saiba mais</a>

        <a href="participantes.php" class="btn-funcionalidade">Saiba mais</a>

        <a href="consultores.php" class="btn-funcionalidade">Saiba mais</a>

    </div>

</div>



</section>

</main>


    <footer class="footer">


        <div class="footer-coluna footer-empresa">

            <img
                src="img/logo footer.jpg"
                alt="EventCop"
                class="logo-footer">

            <p class="descricao-footer">
                A plataforma completa para planejar,
                organizar e executar eventos
                corporativos com eficiência.
            </p>

            <div class="traco"></div>


            <div class="footer-info">

                <img
                    src="img/imagem localizacao footer.png"
                    alt="Localização">

                <p>
                    Avenida das Nações, nº 850<br>
                    São José dos Campos - SP<br>
                    CEP: 12227-000
                </p>

            </div>


            <div class="footer-info">

                <img
                    src="img/imagem CNPJ footer.png"
                    alt="Documento">

                <p>
                    CNPJ: 48.729.315/0001-62
                </p>

            </div>

            <div class="footer-info">

                <img
                    src="img/imagem e-mail footer.png"
                    alt="E-mail">

                <p>
                    contato@eventcop.com.br
                </p>

            </div>

            <div class="footer-info">

                <img
                    src="img/imagem telefone footer.png"
                    alt="Telefone">

                <p>
                    (12) 3456-7890
                </p>

            </div>

        </div>


        <div class="footer-coluna">

            <div class="footer-titulo">

                <img
                    src="img/imagem calendario footer.png"
                    alt="Calendário">

                <div>

                    <h3>Tipos de Eventos</h3>

                    <div class="traco"></div>

                </div>

            </div>


            <a href="corporativos.php">› Corporativos</a>

            <a href="workshops.php">
                › Workshops e Palestras
            </a>

            <a href="treinamentos.php">
                › Treinamentos
            </a>

            <a href="feiras.php">
                › Feiras e Exposições
            </a>

        </div>


        <div class="footer-coluna">

            <div class="footer-titulo">

                <img
                    src="img/imagem recursos plataforma footer.png"
                    alt="Recursos">

                <div>

                    <h3>
                        Recursos da<br>
                        Plataforma
                    </h3>

                    <div class="traco"></div>

                </div>

            </div>


            <a href="gestao-eventos.php">
                › Gestão de Eventos
            </a>

            <a href="inscricoes.php">
                › Inscrições e Convites
            </a>

            <a href="metricas.php">
                › Relatórios e Métricas
            </a>

            <a href="consultores.php">
                › Agendamento com Consultores
            </a>

        </div>


        <div class="footer-coluna">

            <div class="footer-titulo">

                <img
                    src="img/imagem comece na plataforma footer.png"
                    alt="Comece na plataforma">

                <div>

                    <h3>
                        Comece na<br>
                        Plataforma
                    </h3>

                    <div class="traco"></div>

                </div>

            </div>


            <a href="cadastro.php">
                › Criar minha conta
            </a>

            <a href="organizador.php">
                › Quero organizar um evento
            </a>


            <div class="ajuda">

                <img
                    src="img/imagem precisa de ajuda footer.png"
                    alt="Atendimento"
                    class="fone-ajuda">

                <div>

                    <h3>Precisa de ajuda?</h3>

                    <p>
                        Nossa equipe está pronta<br>
                        para te atender!
                    </p>

                    <a
                        href="contato.php"
                        class="btn-fale">

                        Fale conosco

                        <span>→</span>

                    </a>

                </div>

            </div>

        </div>


        <div class="footer-baixo">


            <div class="redes">

                <strong>Siga-nos</strong>

                <img
                    src="img/imagem redes sociais footer.png"
                    alt="Instagram, LinkedIn e YouTube">

            </div>


            <p>
                ©️ 2026 EventCop. Todos os direitos reservados.
            </p>


            <div class="footer-politicas">

                <a href="privacidade.php">
                    Política de Privacidade
                </a>

                <span>|</span>

                <a href="termos.php">
                    Termos de Uso
                </a>

            </div>

        </div>

    </footer>

</body>

</html>