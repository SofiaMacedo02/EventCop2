<?php
/**
 * Footer padrão (idêntico ao dos wireframes) + scripts + fechamento do documento.
 * Variável opcional: $pageJs (string[]) com JS relativo a /assets/js (ex.: ['pages/flow.js']).
 * Use $semFooter = true para telas cheias (ex.: confirmação) e só fechar o documento.
 */
$pageJs    = $pageJs ?? [];
$semFooter = $semFooter ?? false;
if (!$semFooter):
?>
<footer class="footer">
    <div class="footer-coluna footer-empresa">
        <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop" class="logo-footer">
        <p class="descricao-footer">
            A plataforma completa para planejar,
            organizar e executar eventos
            corporativos com eficiência.
        </p>
        <div class="traco"></div>
        <div class="footer-info">
            <img src="<?= asset('img/imagem localizacao footer.png') ?>" alt="Localização">
            <p>Avenida das Nações, nº 850<br>São José dos Campos - SP<br>CEP: 12227-000</p>
        </div>
        <div class="footer-info">
            <img src="<?= asset('img/imagem CNPJ footer.png') ?>" alt="Documento">
            <p>CNPJ: 48.729.315/0001-62</p>
        </div>
        <div class="footer-info">
            <img src="<?= asset('img/imagem e-mail footer.png') ?>" alt="E-mail">
            <p>contato@eventcop.com.br</p>
        </div>
        <div class="footer-info">
            <img src="<?= asset('img/imagem telefone footer.png') ?>" alt="Telefone">
            <p>(12) 3456-7890</p>
        </div>
    </div>

    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="<?= asset('img/imagem calendario footer.png') ?>" alt="Calendário">
            <div>
                <h3>Tipos de Eventos</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="<?= route('galeria', ['categoria' => 'negocios']) ?>">› Corporativos</a>
        <a href="<?= route('galeria', ['categoria' => 'tecnologia']) ?>">› Workshops e Palestras</a>
        <a href="<?= route('galeria', ['categoria' => 'lideranca']) ?>">› Treinamentos</a>
        <a href="<?= route('galeria', ['categoria' => 'inovacao']) ?>">› Feiras e Exposições</a>
    </div>

    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="<?= asset('img/imagem recursos plataforma footer.png') ?>" alt="Recursos">
            <div>
                <h3>Recursos da Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="<?= route('recursos', [], 'gestao-de-eventos') ?>">› Gestão de Eventos</a>
        <a href="<?= route('recursos', [], 'gestao-de-inscricoes') ?>">› Inscrições e Convites</a>
        <a href="<?= route('recursos', [], 'divulgacao') ?>">› Relatórios e Métricas</a>
        <a href="<?= route('agenda') ?>">› Agendamento com Consultores</a>
    </div>

    <div class="footer-coluna">
        <div class="footer-titulo">
            <img src="<?= asset('img/imagem comece na plataforma footer.png') ?>" alt="Comece na plataforma">
            <div>
                <h3>Comece na Plataforma</h3>
                <div class="traco"></div>
            </div>
        </div>
        <a href="<?= route('cadastro') ?>">› Criar minha conta</a>
        <a href="<?= route('cadastro_admin') ?>">› Quero organizar um evento</a>
        <div class="ajuda">
            <img src="<?= asset('img/imagem precisa de ajuda footer.png') ?>" alt="Atendimento" class="fone-ajuda">
            <div>
                <h3>Precisa de ajuda?</h3>
                <p>Nossa equipe está pronta<br>para te atender!</p>
                <a href="<?= route('agenda') ?>" class="btn-fale">Fale conosco <span>→</span></a>
            </div>
        </div>
    </div>

    <div class="footer-baixo">
        <div class="redes">
            <strong>Siga-nos</strong>
            <img src="<?= asset('img/imagem redes sociais footer.png') ?>" alt="Instagram, LinkedIn e YouTube">
        </div>
        <p>© <?= date('Y') ?> EventCop. Todos os direitos reservados.</p>
        <div class="footer-politicas">
            <a href="<?= route('politicas') ?>">Política de Privacidade</a>
            <span>|</span>
            <a href="<?= route('termos') ?>">Termos de Uso</a>
        </div>
    </div>
</footer>
<?php endif; ?>

<div class="toast-stack" data-toast-stack aria-live="polite"></div>

<script src="<?= asset('js/core/ui.js') ?>"></script>
<?php foreach ($pageJs as $js): ?>
<script src="<?= asset('js/' . $js) ?>"></script>
<?php endforeach; ?>
</body>
</html>
