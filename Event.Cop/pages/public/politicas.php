<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Políticas de privacidade - EventCop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #5A0505;
            color: #FFF8F2;
        }

        a {
            text-decoration: none;
        }

        /* HEADER */
        .header {
            width: 100%;
            height: 120px;
            padding: 0 50px;
            background: #5A0505;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding-top: 20px;
        }

        .logo-header {
            width: 180px;
            height: auto;
            object-fit: contain;
            position: relative;
            top: 0;
            left: 0;
        }

        .menu {
            display: flex;
            align-items: center;
            gap: 28px;
            margin-top: 10px;
        }

        .menu a {
            color: #FFF8F2;
            font-size: 15px;
            font-weight: bold;
        }

        .menu a:hover {
            opacity: 0.8;
        }

        .btn-header {
            padding: 8px 17px;
            border: 1px solid #FFF8F2;
            border-radius: 25px;
        }

        /* POLÍTICAS DE PRIVACIDADE (CONTEÚDO PRINCIPAL) */
        .termos-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px 80px 20px;
        }

        .termos-container h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #FFF8F2;
        }

        .termos-container .data-atualizacao {
            font-size: 16px;
            opacity: 0.9;
            margin-bottom: 35px;
        }

        .termos-container .introducao {
            font-size: 17px;
            line-height: 1.6;
            margin-bottom: 35px;
            opacity: 0.95;
        }

        .termos-secao {
            margin-bottom: 30px;
        }

        .termos-secao h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 12px;
            color: #FFF8F2;
        }

        .termos-secao p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
            opacity: 0.95;
        }

        .termos-secao ul {
            list-style-type: disc;
            padding-left: 25px;
            margin-bottom: 15px;
        }

        .termos-secao li {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 6px;
            opacity: 0.95;
        }

        /* FOOTER */
        .footer {
            width: 100%;
            padding: 50px 4% 25px;
            background: #5A0505;
            color: #FFF8F2;
            display: grid;
            grid-template-columns: 1.25fr 1fr 1.1fr 1.15fr;
            column-gap: 40px;
            border-top: 1px solid rgba(255, 248, 242, 0.2);
        }

        .footer-coluna {
            position: relative;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .footer-coluna:not(:first-child) {
            border-left: 1px solid rgba(125, 26, 26, 0.35);
            padding-left: 35px;
        }

        .logo-footer {
            width: 320px;
            height: auto;
        }

        .descricao-footer {
            max-width: 310px;
            font-size: 16px;
            line-height: 1.55;
        }

        .traco {
            width: 48px;
            height: 4px;
            margin-top: 7px;
            background: #FFF8F2;
            border-radius: 10px;
        }

        .footer-info {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .footer-info img {
            width: 30px;
            height: 30px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .footer-info p {
            font-size: 15px;
            line-height: 1.55;
        }

        .footer-titulo {
            min-height: 85px;
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .footer-titulo > img {
            width: 50px;
            height: 50px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .footer-titulo h3 {
            font-size: 21px;
            line-height: 1.2;
            font-weight: 700;
        }

        .footer-coluna > a {
            color: #FFF8F2;
            font-size: 16px;
            line-height: 1.4;
        }

        .footer-coluna > a:hover {
            opacity: 0.75;
        }

        .ajuda {
            margin-top: 8px;
            width: 300px;
            padding: 18px 20px;
            background: #7D1A1A;
            border-radius: 13px;
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .fone-ajuda {
            width: 42px;
            height: 42px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .ajuda h3 {
            margin: 2px 0 6px;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.1;
        }

        .ajuda p {
            margin: 0 0 14px;
            font-size: 12px;
            line-height: 1.45;
        }

        .btn-fale {
            width: 160px;
            min-width: 0;
            padding: 10px 15px;
            background: #FFF8F2;
            color: #5A0505;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 13px;
            font-weight: 700;
        }

        .btn-fale span {
            font-size: 17px;
        }

        .footer-baixo {
            grid-column: 1 / -1;
            margin-top: 40px;
            padding-top: 22px;
            border-top: 1px solid rgba(125, 26, 26, 0.35);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .redes {
            display: flex;
            align-items: center;
            gap: 22px;
        }

        .redes strong {
            font-size: 15px;
        }

        .redes img {
            width: 180px;
            height: auto;
        }

        .footer-baixo > p {
            font-size: 14px;
        }

        .footer-politicas {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .footer-politicas a,
        .footer-politicas span {
            color: #FFF8F2;
            font-size: 14px;
        }

        /* RESPONSIVIDADE */
        @media (max-width: 1100px) {
            .menu {
                gap: 18px;
            }
            .footer {
                grid-template-columns: 1fr 1fr;
                row-gap: 45px;
            }
            .footer-coluna:not(:first-child) {
                border-left: none;
                padding-left: 0;
            }
        }

        @media (max-width: 800px) {
            .header {
                flex-direction: column;
                height: auto;
                padding-bottom: 20px;
            }
            .logo-header {
                top: 0;
                left: 0;
                width: 180px;
            }
            .menu {
                justify-content: center;
                flex-wrap: wrap;
            }
            .termos-container h1 {
                font-size: 36px;
            }
        }

        @media (max-width: 600px) {
            .footer {
                grid-template-columns: 1fr;
            }
            .footer-baixo {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }
        }
    </style>
</head>

<body>

    <header class="header">
        <a href="../index.php">
            <img src="logo bege.jpeg" alt="EventCop" class="logo-header">
        </a>

        <nav class="menu">
            <a href="../index.php">Home</a>
            <a href="">EventCop Empresas</a>
            <a href="">Cases</a>
            <a href="">Planos e Preços</a>
            <a href="">Sou um organizador</a>
            <a href="" class="btn-header">Criar Evento</a>
        </nav>
    </header>

    <main class="termos-container">
        <h1>Politicas de privacidade - EventCop</h1>
        <p class="data-atualizacao">Última atualização: agosto de 2026</p>

        <p class="introducao">
            A EventCop valoriza a privacidade e a segurança de seus usuários. Esta Política de Privacidade explica quais informações podem ser coletadas pela plataforma, como elas são utilizadas e quais cuidados são adotados para protegê-las.
        </p>

        <section class="termos-secao">
            <h2>1. Informações coletadas</h2>
            <p>Ao utilizar a EventCop, algumas informações podem ser solicitadas para permitir o funcionamento da plataforma, como:</p>
            <ul>
                <li>Nome completo;</li>
                <li>E-mail e telefone;</li>
                <li>Dados de cadastro e acesso;</li>
                <li>Informações relacionadas às inscrições em eventos;</li>
                <li>Dados fornecidos durante a criação ou organização de eventos;</li>
                <li>Informações necessárias para pagamentos, quando aplicável.</li>
            </ul>
        </section>

        <section class="termos-secao">
            <h2>2. Como utilizamos os dados</h2>
            <p>As informações coletadas podem ser utilizadas para:</p>
            <ul>
                <li>Criar e gerenciar contas;</li>
                <li>Realizar e confirmar inscrições;</li>
                <li>Gerenciar participantes e eventos;</li>
                <li>Enviar informações importantes sobre os eventos;</li>
                <li>Permitir a comunicação entre participantes e organizadores;</li>
                <li>Gerar relatórios e indicadores;</li>
                <li>Melhorar a experiência e o funcionamento da plataforma.</li>
            </ul>
        </section>

        <section class="termos-secao">
            <h2>3. Compartilhamento de informações</h2>
            <p>A EventCop não utiliza os dados pessoais dos usuários para finalidades diferentes daquelas relacionadas aos serviços oferecidos.</p>
            <p>Quando necessário, algumas informações poderão ser compartilhadas com:</p>
            <ul>
                <li>Organizadores dos eventos nos quais o usuário se inscrever;</li>
                <li>Serviços necessários para processamento de pagamentos;</li>
                <li>Prestadores de serviços utilizados no funcionamento da plataforma;</li>
                <li>Autoridades competentes, quando houver obrigação legal.</li>
            </ul>
        </section>

        <section class="termos-secao">
            <h2>4. Dados dos participantes</h2>
            <p>Os organizadores poderão acessar informações necessárias para administrar seus eventos, como nome, inscrição, confirmação e presença dos participantes.</p>
            <p>Essas informações deverão ser utilizadas exclusivamente para atividades relacionadas ao evento e seu gerenciamento.</p>
        </section>

        <section class="termos-secao">
            <h2>5. Segurança das informações</h2>
            <p>A EventCop busca adotar medidas adequadas para proteger os dados contra:</p>
            <ul>
                <li>Acessos não autorizados;</li>
                <li>Perda ou alteração indevida;</li>
                <li>Uso inadequado das informações;</li>
                <li>Divulgação não autorizada.</li>
            </ul>
            <p>Mesmo com essas medidas, nenhum sistema digital pode garantir segurança absoluta das informações.</p>
        </section>

        <section class="termos-secao">
            <h2>6. Pagamentos</h2>
            <p>Nos eventos pagos, algumas informações poderão ser necessárias para concluir a inscrição.</p>
            <p>Quando o pagamento for processado por serviços especializados, os dados financeiros deverão ser tratados de acordo com as políticas de segurança e privacidade do respectivo serviço.</p>
        </section>

        <section class="termos-secao">
            <h2>7. Cookies e tecnologias semelhantes</h2>
            <p>A plataforma poderá utilizar cookies e tecnologias semelhantes para:</p>
            <ul>
                <li>Manter o usuário conectado;</li>
                <li>Salvar preferências;</li>
                <li>Melhorar a navegação;</li>
                <li>Entender como os recursos da plataforma são utilizados.</li>
            </ul>
            <p>O usuário poderá controlar determinadas permissões por meio das configurações de seu navegador.</p>
        </section>

        <section class="termos-secao">
            <h2>8. Direitos do usuário</h2>
            <p>O usuário poderá solicitar informações relacionadas aos seus dados pessoais e, quando aplicável:</p>
            <ul>
                <li>Confirmar a existência de tratamento de dados;</li>
                <li>Solicitar acesso aos seus dados;</li>
                <li>Corrigir informações incorretas ou desatualizadas;</li>
                <li>Solicitar a exclusão de determinados dados;</li>
                <li>Solicitar informações sobre o uso e compartilhamento de seus dados.</li>
            </ul>
            <p>Esses direitos serão atendidos conforme as condições e obrigações previstas na legislação aplicável.</p>
        </section>

        <section class="termos-secao">
            <h2>9. Armazenamento dos dados</h2>
            <p>As informações serão mantidas somente pelo período necessário para oferecer os serviços da plataforma, cumprir obrigações legais ou atender às finalidades para as quais foram coletadas.</p>
            <p>Quando não forem mais necessárias, poderão ser excluídas ou anonimizadas.</p>
        </section>

        <section class="termos-secao">
            <h2>10. Proteção de dados e LGPD</h2>
            <p>O tratamento de dados pessoais realizado pela EventCop deverá respeitar os princípios estabelecidos pela Lei Geral de Proteção de Dados Pessoais (LGPD — Lei nº 13.709/2018), incluindo transparência, segurança, necessidade e respeito aos direitos dos titulares.</p>
        </section>

        <section class="termos-secao">
            <h2>11. Alterações nesta Política</h2>
            <p>Esta Política de Privacidade poderá ser atualizada para acompanhar alterações na plataforma ou na legislação.</p>
            <p>A versão mais recente permanecerá disponível nesta página.</p>
        </section>

        <section class="termos-secao">
            <h2>12. Contato</h2>
            <p>Em caso de dúvidas relacionadas à privacidade, segurança ou utilização de dados pessoais, o usuário poderá entrar em contato com a equipe responsável pela EventCop através dos canais de atendimento disponibilizados na plataforma.</p>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-coluna footer-empresa">
            <img src="logo footer.jpg.jpeg" alt="EventCop" class="logo-footer">
            <p class="descricao-footer">
                A plataforma completa para planejar, organizar e executar eventos corporativos com eficiência.
            </p>
            <div class="traco"></div>

            <div class="footer-info">
                <img src="imagem localizacao footer.png" alt="Localização">
                <p>
                    Avenida das Nações, nº 850<br>
                    São José dos Campos - SP<br>
                    CEP: 12227-000
                </p>
            </div>

            <div class="footer-info">
                <img src="imagem CNPJ footer.png" alt="Documento">
                <p>CNPJ: 48.729.315/0001-62</p>
            </div>

            <div class="footer-info">
                <img src="imagem e-mail footer.png" alt="E-mail">
                <p>contato@eventcop.com.br</p>
            </div>

            <div class="footer-info">
                <img src="imagem telefone footer.png" alt="Telefone">
                <p>(12) 3456-7890</p>
            </div>
        </div>

        <div class="footer-coluna">
            <div class="footer-titulo">
                <img src="imagem calendario footer.png" alt="Calendário">
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
                <img src="imagem recursos plataforma footer.png" alt="Recursos">
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
                <img src="imagem comece na plataforma footer.png" alt="Comece na plataforma">
                <div>
                    <h3>Comece na<br>Plataforma</h3>
                    <div class="traco"></div>
                </div>
            </div>
            <a href="">› Criar minha conta</a>
            <a href="">› Quero organizar um evento</a>

            <div class="ajuda">
                <img src="imagem precisa de ajuda footer.png" alt="Atendimento" class="fone-ajuda">
                <div>
                    <h3>Precisa de ajuda?</h3>
                    <p>Nossa equipe está pronta<br>para te atender!</p>
                    <a href="" class="btn-fale">
                        Fale conosco
                        <span>→</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="footer-baixo">
            <div class="redes">
                <strong>Siga-nos</strong>
                <img src="imagem redes sociais footer.png" alt="Instagram, LinkedIn e YouTube">
            </div>
            <p>©️ 2026 EventCop. Todos os direitos reservados.</p>
            <div class="footer-politicas">
                <a href="">Política de Privacidade</a>
                <span>|</span>
                <a href="">Termos de Uso</a>
            </div>
        </div>
    </footer>

</body>
</html>