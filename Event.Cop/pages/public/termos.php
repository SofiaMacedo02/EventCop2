<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$pageTitle = 'Termos de Uso | EventCop';
$pageCss   = ['pages/termos.css'];
$bodyClass = 'pagina-termos';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main class="termos-wrapper">
    <div class="termos-cabecalho" data-reveal>
        <h1>Termos de uso - EventCop</h1>
        <p class="data-atualizacao">Última atualização: agosto de 2026</p>
    </div>

    <div class="termos-container">
        <p class="introducao" data-reveal>
            Bem-vindo à EventCop. Ao utilizar nossa plataforma, você concorda com os termos apresentados abaixo. Eles estabelecem as condições para utilização dos recursos oferecidos pela plataforma.
        </p>

        <section class="termos-secao" data-reveal>
            <h2>1. Uso da plataforma</h2>
            <p>A EventCop oferece ferramentas para criação, divulgação, organização e gerenciamento de eventos corporativos e workshops.</p>
            <p>Ao utilizar a plataforma, o usuário se compromete a:</p>
            <ul>
                <li>Fornecer informações verdadeiras e atualizadas;</li>
                <li>Utilizar os recursos de maneira responsável;</li>
                <li>Não utilizar a plataforma para atividades ilegais ou inadequadas;</li>
                <li>Respeitar os demais usuários, participantes e organizadores.</li>
            </ul>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>2. Cadastro e conta</h2>
            <p>Alguns recursos podem exigir a criação de uma conta.</p>
            <p>O usuário é responsável por:</p>
            <ul>
                <li>Manter seus dados cadastrais atualizados;</li>
                <li>Proteger sua senha e informações de acesso;</li>
                <li>Não compartilhar sua conta com terceiros;</li>
                <li>Informar qualquer acesso não autorizado à sua conta.</li>
            </ul>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>3. Criação e gerenciamento de eventos</h2>
            <p>Os organizadores são responsáveis pelas informações cadastradas em seus eventos, incluindo:</p>
            <ul>
                <li>Nome e descrição;</li>
                <li>Data, horário e local;</li>
                <li>Programação;</li>
                <li>Valores e condições de inscrição;</li>
                <li>Informações destinadas aos participantes.</li>
            </ul>
            <p>A EventCop disponibiliza as ferramentas de gerenciamento, enquanto o conteúdo e a realização do evento são responsabilidade de seu organizador.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>4. Inscrições e pagamentos</h2>
            <p>Quando houver eventos pagos, os valores, taxas e condições aplicáveis serão apresentadas ao participante antes da confirmação da inscrição.</p>
            <p>O usuário deverá verificar todas as informações antes de finalizar o pagamento.</p>
            <p>Em eventos gratuitos, nenhuma cobrança de inscrição será realizada ao participante.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>5. Cancelamentos e alterações</h2>
            <p>Eventos podem sofrer alterações de data, horário, local ou programação.</p>
            <p>Sempre que possível, os participantes deverão ser informados sobre mudanças relevantes pelos canais disponibilizados na plataforma.</p>
            <p>As condições de cancelamento e reembolso poderão variar conforme o evento e deverão ser informadas pelo organizador.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>6. Responsabilidades do usuário</h2>
            <p>Não é permitido utilizar a EventCop para:</p>
            <ul>
                <li>Divulgar informações falsas ou enganosas;</li>
                <li>Prejudicar outros usuários;</li>
                <li>Tentar acessar contas ou informações sem autorização;</li>
                <li>Utilizar a plataforma para práticas ilegais;</li>
                <li>Inserir conteúdos ofensivos ou que violem direitos de terceiros.</li>
            </ul>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>7. Privacidade e dados</h2>
            <p>Os dados fornecidos pelos usuários serão utilizados para permitir o funcionamento dos serviços da plataforma, como cadastro, inscrições, comunicação e gerenciamento dos eventos.</p>
            <p>O tratamento dessas informações deverá seguir as regras apresentadas na <a href="<?= route('politicas') ?>" class="termos-link">Política de Privacidade</a> da EventCop e a legislação aplicável.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>8. Propriedade intelectual</h2>
            <p>O nome, identidade visual, interface e demais elementos desenvolvidos pela EventCop não devem ser utilizados ou reproduzidos indevidamente.</p>
            <p>Conteúdos adicionados pelos organizadores permanecem sob responsabilidade de seus respectivos autores.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>9. Disponibilidade da plataforma</h2>
            <p>A EventCop busca manter seus serviços disponíveis e funcionando adequadamente. Entretanto, poderão ocorrer interrupções temporárias devido a:</p>
            <ul>
                <li>Manutenções;</li>
                <li>Atualizações;</li>
                <li>Problemas técnicos;</li>
                <li>Situações externas fora do controle da plataforma.</li>
            </ul>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>10. Alterações nos Termos de Uso</h2>
            <p>Estes Termos de Uso poderão ser atualizados sempre que necessário para acompanhar mudanças nos serviços oferecidos pela EventCop.</p>
            <p>A versão mais recente ficará disponível nesta página.</p>
        </section>

        <section class="termos-secao" data-reveal>
            <h2>11. Aceitação dos termos</h2>
            <p>Ao criar uma conta, realizar uma inscrição ou utilizar os serviços da EventCop, o usuário declara que leu e concorda com estes Termos de Uso e com a <a href="<?= route('politicas') ?>" class="termos-link">Política de Privacidade</a> da plataforma.</p>
        </section>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
