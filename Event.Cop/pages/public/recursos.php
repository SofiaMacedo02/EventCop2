<?php
require_once __DIR__ . '/../../includes/bootstrap.php';

$pageTitle = 'Recursos da Plataforma | EventCop';
$pageCss   = ['pages/public.css'];

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main class="pagina-recursos">
    <!-- HERO RECURSOS -->
    <section class="hero-recursos">
        <div class="hero-recursos-container">
            <div class="hero-recursos-texto" data-reveal="left">
                <h1>Tudo o que você precisa para<br>organizar seu evento</h1>
                <p>
                    Planeje, organize e acompanhe seu evento em<br>
                    um só lugar, com ferramentas que facilitam<br>
                    cada etapa do início ao fim.
                </p>
                <a href="<?= route('criar_evento') ?>" class="btn-recursos-hero">
                    Criar meu evento <span>›</span>
                </a>
            </div>

            <div class="hero-recursos-arte" data-reveal="right" data-delay="120">
                <div class="recursos-hero-composicao">
                    <!-- Calendário flutuante à esquerda -->
                    <div class="rh-card rh-calendario anim-float">
                        <div class="rh-cal-topo">
                            <span></span><span></span><span></span><span></span>
                        </div>
                        <div class="rh-cal-grade">
                            <i></i><i></i><i class="ativo">✓</i><i></i>
                            <i></i><i class="laranja"></i><i></i><i></i>
                            <i></i><i></i><i></i><i class="vinho"></i>
                        </div>
                    </div>

                    <!-- Painel principal EventCop -->
                    <div class="rh-painel-central">
                        <div class="rh-painel-barra">
                            <span class="dot vinho"></span>
                            <span class="dot laranja"></span>
                            <span class="dot creme"></span>
                            <strong class="rh-painel-brand">EventCop</strong>
                        </div>
                        <div class="rh-painel-corpo">
                            <div class="rh-kpis">
                                <div class="rh-kpi">
                                    <small>Eventos</small>
                                    <strong data-count="24">24</strong>
                                </div>
                                <div class="rh-kpi">
                                    <small>Inscritos</small>
                                    <strong data-count="532">532</strong>
                                </div>
                                <div class="rh-kpi">
                                    <small>Confirmados</small>
                                    <strong data-count="389">389</strong>
                                </div>
                            </div>
                            <div class="rh-graficos">
                                <div class="rh-grafico-linha">
                                    <svg viewBox="0 0 140 55" aria-hidden="true">
                                        <path d="M8 45 L36 34 L65 38 L96 20 L130 10" fill="none" stroke="#7D1A1A" stroke-width="3.5" stroke-linecap="round"/>
                                        <path d="M8 48 L36 42 L65 44 L96 32 L130 24" fill="none" stroke="#F29C66" stroke-width="3" stroke-linecap="round"/>
                                        <circle cx="36" cy="34" r="3.5" fill="#7D1A1A"/>
                                        <circle cx="96" cy="20" r="3.5" fill="#7D1A1A"/>
                                        <circle cx="130" cy="10" r="4" fill="#F29C66"/>
                                    </svg>
                                </div>
                                <div class="rh-grafico-rosca">
                                    <svg viewBox="0 0 60 60" aria-hidden="true">
                                        <circle cx="30" cy="30" r="20" fill="none" stroke="#F2E6DA" stroke-width="9"/>
                                        <circle cx="30" cy="30" r="20" fill="none" stroke="#F29C66" stroke-width="9" stroke-dasharray="85 125" stroke-dashoffset="-10"/>
                                        <circle cx="30" cy="30" r="20" fill="none" stroke="#7D1A1A" stroke-width="9" stroke-dasharray="45 125"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ingresso flutuante inferior esquerdo -->
                    <div class="rh-card rh-ingresso">
                        <span>EVENTO</span>
                        <div class="rh-ingresso-linhas">
                            <i></i><i></i>
                        </div>
                    </div>

                    <!-- Checklist flutuante inferior -->
                    <div class="rh-card rh-checklist">
                        <div><span class="chk">✓</span><i></i></div>
                        <div><span class="chk">✓</span><i></i></div>
                        <div><span class="chk">✓</span><i></i></div>
                    </div>

                    <!-- Megafone e ícones sociais à direita -->
                    <div class="rh-badge rh-megafone" aria-hidden="true">📢</div>
                    <div class="rh-badge rh-whats" aria-hidden="true">💬</div>
                    <div class="rh-badge rh-insta" aria-hidden="true">📷</div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEÇÕES DE RECURSOS (ZIGUE-ZAGUE) -->
    <div class="secoes-recursos">

        <!-- 1. DIVULGAÇÃO DE EVENTOS -->
        <section id="divulgacao" class="recurso-bloco">
            <div class="recurso-texto" data-reveal="left">
                <h2>Divulgação de Eventos</h2>
                <p>
                    A página apresenta as ferramentas da EventCop para
                    divulgação de eventos, permitindo aumentar a
                    visibilidade, atrair mais participantes, apresentar as
                    informações do evento de forma profissional,
                    compartilhar novidades e manter o público informado
                    até a realização do evento.
                </p>
            </div>

            <div class="recurso-arte" data-reveal="right" data-delay="100">
                <div class="arte-composicao arte-divulgacao">
                    <img src="<?= asset('img/imagem Conecte suas ferramentas.png') ?>" alt="Ferramentas de Divulgação de Eventos" class="arte-img-principal">
                    <div class="arte-flutuante arte-tag-coracao anim-float">♥</div>
                    <div class="arte-flutuante arte-tag-aviao">✈</div>
                    <div class="arte-flutuante arte-tag-notificacao">
                        <span>🔔</span>
                        <strong>1</strong>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. GESTÃO DE INSCRIÇÕES -->
        <section id="gestao-de-inscricoes" class="recurso-bloco recurso-invertido">
            <div class="recurso-arte" data-reveal="left">
                <div class="arte-composicao arte-inscricoes">
                    <div class="insc-ticket">
                        <span>EVENTO</span>
                        <small>VIP • 2026</small>
                    </div>
                    <div class="insc-notebook">
                        <div class="insc-tela">
                            <div class="insc-barra">
                                <span></span><span></span><span></span>
                            </div>
                            <div class="insc-corpo">
                                <div class="insc-brand">
                                    <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop">
                                </div>
                                <div class="insc-form">
                                    <div class="insc-linha"><span class="ico">👤</span><i></i></div>
                                    <div class="insc-linha"><span class="ico">✉</span><i></i></div>
                                    <div class="insc-linha"><span class="ico">🎟</span><i></i></div>
                                    <a href="<?= route('galeria') ?>" class="insc-cta">Inscrever-se</a>
                                </div>
                            </div>
                        </div>
                        <div class="insc-base"></div>
                    </div>
                    <div class="arte-flutuante insc-sino anim-float">🔔</div>
                    <div class="arte-flutuante insc-check">✓</div>
                </div>
            </div>

            <div class="recurso-texto" data-reveal="right" data-delay="100">
                <h2>Gestão de Inscrições</h2>
                <p>
                    A página apresenta as ferramentas da EventCop
                    para gerenciar as inscrições do evento, facilitando o
                    cadastro dos participantes, o acompanhamento das
                    inscrições e a organização das informações de forma
                    prática e centralizada.
                </p>
            </div>
        </section>

        <!-- 3. GESTÃO DE EVENTOS -->
        <section id="gestao-de-eventos" class="recurso-bloco">
            <div class="recurso-texto" data-reveal="left">
                <h2>Gestão de Eventos</h2>
                <p>
                    A página apresenta as ferramentas da
                    EventCop para organizar e gerenciar eventos,
                    permitindo centralizar informações, acompanhar
                    o planejamento e manter dados de
                    participantes, inscrições e atividades sempre
                    organizados e atualizados.
                </p>
            </div>

            <div class="recurso-arte" data-reveal="right" data-delay="100">
                <div class="arte-composicao arte-eventos">
                    <img src="<?= asset('img/imagem Organize seus eventos.png') ?>" alt="Gestão e Organização de Eventos" class="arte-img-principal">
                    <div class="checklist-card anim-float">
                        <h4>Checklist do Evento</h4>
                        <ul>
                            <li class="feito"><span>✓</span> Definir data</li>
                            <li class="feito"><span>✓</span> Reservar local</li>
                            <li class="feito"><span>✓</span> Convidar palestrantes</li>
                            <li class="feito"><span>✓</span> Organizar equipe</li>
                            <li><span class="pendente"></span> Divulgar evento</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. GESTÃO DE PARTICIPANTES -->
        <section id="gestao-de-participantes" class="recurso-bloco recurso-invertido">
            <div class="recurso-arte" data-reveal="left">
                <div class="arte-composicao arte-participantes">
                    <img src="<?= asset('img/imagem fortaleca sua marca.png') ?>" alt="Gestão de Participantes EventCop" class="arte-img-personagem">
                    <div class="participantes-card anim-float">
                        <div class="part-cabecalho">
                            <strong>👥 Participantes</strong>
                            <span class="part-contador">532</span>
                        </div>
                        <div class="part-lista">
                            <div class="part-item">
                                <span class="part-avatar">MC</span>
                                <div class="part-info">
                                    <strong>Mariana Costa</strong>
                                    <small>● Inscrita</small>
                                </div>
                                <span class="part-ok">✓</span>
                            </div>
                            <div class="part-item">
                                <span class="part-avatar laranja">LA</span>
                                <div class="part-info">
                                    <strong>Lucas Almeida</strong>
                                    <small>● Inscrito</small>
                                </div>
                                <span class="part-ok">✓</span>
                            </div>
                            <div class="part-item">
                                <span class="part-avatar">BS</span>
                                <div class="part-info">
                                    <strong>Beatriz Souza</strong>
                                    <small>● Inscrita</small>
                                </div>
                                <span class="part-ok">✓</span>
                            </div>
                        </div>
                        <div class="part-botao">+ Adicionar participante</div>
                    </div>
                </div>
            </div>

            <div class="recurso-texto" data-reveal="right" data-delay="100">
                <h2>Gestão de Participantes</h2>
                <p>
                    A página apresenta as ferramentas da EventCop para
                    gerenciar os participantes, permitindo centralizar
                    informações, acompanhar inscrições e presença, além
                    de facilitar a comunicação e manter todos informados
                    sobre o evento.
                </p>
            </div>
        </section>

        <!-- 5. AGENDAMENTO COM CONSULTORES -->
        <section id="agendamento-consultores" class="recurso-bloco">
            <div class="recurso-texto" data-reveal="left">
                <h2>Agendamento com<br>Consultores</h2>
                <p>
                    A página apresenta o serviço de agendamento
                    com consultores da EventCop, permitindo
                    escolher um profissional, selecionar data e
                    horário disponíveis e receber orientações
                    personalizadas para planejar e organizar o
                    evento.
                </p>
            </div>

            <div class="recurso-arte" data-reveal="right" data-delay="100">
                <div class="arte-composicao arte-consultores">
                    <img src="<?= asset('img/imagem conectando pessoas e conhecimento.png') ?>" alt="Consultores Especializados EventCop" class="arte-img-principal">
                    <div class="consultor-mini-badge anim-float">
                        <span>📅</span>
                        <div>
                            <strong>Mentoria 1:1</strong>
                            <small>Horários disponíveis hoje</small>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA INFERIOR -->
        <div class="recursos-cta-final" data-reveal>
            <a href="<?= route('agenda') ?>" class="btn-consultor-vinho">
                Fale com um consultor <span>→</span>
            </a>
        </div>
    </div>
</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
