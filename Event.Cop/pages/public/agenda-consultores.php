<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$pageTitle = 'Agendamento com Consultores | EventCop';
$pageCss   = ['pages/public.css'];
$pageJs    = ['pages/agenda-consultores.js'];

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main class="pagina-agenda">
    <section class="area-consultores" data-reveal="left">
        <h1>Consultores disponíveis<br>no momento</h1>
        <div class="consultores-grid">
            <button type="button" class="consultor-card ativo" data-consultor="juliana">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem juliana.png') ?>" alt="Juliana Campos">
                </div>
                <div class="consultor-info">
                    <strong>Juliana Campos</strong>
                    <span>Consultora de Eventos</span>
                    <small>São Paulo, SP</small>
                </div>
            </button>
            <button type="button" class="consultor-card" data-consultor="marina">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem marina.png') ?>" alt="Marina Oliveira">
                </div>
                <div class="consultor-info">
                    <strong>Marina Oliveira</strong>
                    <span>Consultora de Eventos</span>
                    <small>Rio de Janeiro, RJ</small>
                </div>
            </button>
            <button type="button" class="consultor-card" data-consultor="rafael">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem rafael.png') ?>" alt="Rafael Santos">
                </div>
                <div class="consultor-info">
                    <strong>Rafael Santos</strong>
                    <span>Consultor de Negócios</span>
                    <small>Salvador, BA</small>
                </div>
            </button>
            <button type="button" class="consultor-card" data-consultor="isabela">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem isabela.png') ?>" alt="Isabela Ferreira">
                </div>
                <div class="consultor-info">
                    <strong>Isabela Ferreira</strong>
                    <span>Consultora de Atendimento</span>
                    <small>Curitiba, PR</small>
                </div>
            </button>
            <button type="button" class="consultor-card" data-consultor="lucas">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem lucas.png') ?>" alt="Lucas Mendes">
                </div>
                <div class="consultor-info">
                    <strong>Lucas Mendes</strong>
                    <span>Consultor de Tecnologia</span>
                    <small>Belo Horizonte, MG</small>
                </div>
            </button>
            <button type="button" class="consultor-card" data-consultor="pedro">
                <div class="foto-consultor">
                    <img src="<?= asset('img/imagem pedro.png') ?>" alt="Pedro Almeida">
                </div>
                <div class="consultor-info">
                    <strong>Pedro Almeida</strong>
                    <span>Consultor de Soluções</span>
                    <small>Fortaleza, CE</small>
                </div>
            </button>
        </div>
    </section>

    <section class="area-agenda" data-reveal="right" data-delay="120">
        <h2>Selecione o Dia e Horário:</h2>
        <div class="calendario">
            <div class="calendario-topo">
                <strong id="mesAtual">Outubro de 2026</strong>
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
            <div class="dias-calendario" id="diasCalendario"></div>
            <div class="legenda">
                <span><i class="bolinha disponivel"></i>Disponível</span>
                <span><i class="bolinha limitado"></i>Vagas limitadas</span>
                <span><i class="bolinha indisponivel"></i>Indisponível</span>
            </div>
        </div>

        <div class="seta-agenda">↓</div>

        <div class="horarios-box">
            <div class="horarios-cabecalho">
                <div>
                    <h3>Horários disponíveis</h3>
                    <p id="dataSelecionada">Clique em um dia disponível para ver os horários</p>
                </div>
                <span>Duração: 60 min ⏱</span>
            </div>
            <div class="horarios" id="listaHorarios"></div>
            <div class="aviso" style="margin-top: 15px;">
                ⓘ <span>Após escolher o horário, você receberá a confirmação por e-mail e WhatsApp.</span>
            </div>
            <button type="button" id="confirmarHorario" class="btn-confirmar" disabled style="margin-top: 15px; width: 100%;">
                Confirmar Reunião com Consultor
            </button>
        </div>
    </section>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
