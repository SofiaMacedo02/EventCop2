<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';

$id         = isset($_GET['id']) ? (int) $_GET['id'] : 1;
$evento     = evento_por_id($id) ?? eventos_todos()[0];
$categorias = eventos_categorias();
$catRotulo  = mb_strtoupper($categorias[$evento['categoria']] ?? $evento['categoria'], 'UTF-8');
$localTexto = evento_local($evento);
$formatoTxt = match ($evento['formato']) {
    'online'  => 'Online',
    'hibrido' => 'Híbrido',
    default   => 'Presencial',
};
$statusBadge = match ($evento['status'] ?? 'em-andamento') {
    'em-andamento'    => ['classe' => 'badge-ok badge-dot', 'rotulo' => 'Em andamento'],
    'em-breve'        => ['classe' => 'badge-warn',         'rotulo' => 'Em breve'],
    'vagas-limitadas' => ['classe' => 'badge-bad',          'rotulo' => 'Vagas limitadas'],
    'finalizado'      => ['classe' => 'badge-info',         'rotulo' => 'Finalizado'],
    default           => ['classe' => 'badge-ok badge-dot', 'rotulo' => 'Em andamento'],
};

$programacao = [
    ['hora' => '08h00 - 09h00', 'titulo' => 'Credenciamento e Coffee Break de Boas-vindas', 'desc' => ''],
    ['hora' => '09h00 - 09h30', 'titulo' => 'Abertura Oficial', 'desc' => 'Boas-vindas e apresentação do evento'],
    ['hora' => '09h30 - 10h30', 'titulo' => 'Inteligência Artificial: Tendências e Aplicações', 'desc' => 'Como a IA está transformando negócios e o futuro do trabalho.'],
    ['hora' => '10h30 - 10h45', 'titulo' => 'Coffee Break', 'desc' => ''],
    ['hora' => '10h45 - 12h00', 'titulo' => 'Segurança da Informação na Prática', 'desc' => 'Estratégias e ferramentas para proteger dados e sistemas.'],
    ['hora' => '12h00 - 13h30', 'titulo' => 'Almoço', 'desc' => ''],
    ['hora' => '13h30 - 14h30', 'titulo' => 'Cloud Computing e Infraestrutura Escalável', 'desc' => 'Como escalar soluções com segurança e eficiência na nuvem.'],
    ['hora' => '14h30 - 15h30', 'titulo' => 'Cases de Sucesso: Empresas Inovadoras', 'desc' => 'Histórias reais de transformação digital.'],
    ['hora' => '15h30 - 15h45', 'titulo' => 'Coffee Break', 'desc' => ''],
    ['hora' => '15h45 - 17h00', 'titulo' => 'Painel de Discussão', 'desc' => 'O futuro da tecnologia e os desafios do mercado.'],
    ['hora' => '17h00 - 18h00', 'titulo' => 'Networking & Encerramento', 'desc' => 'Conexões, trocas e encerramento do evento.'],
];

$palestrantes = [
    ['nome' => 'Lucas Moreira',   'cargo' => 'Especialista em Inteligência Artificial', 'foto' => 'img/imagem lucas.png'],
    ['nome' => 'Juliana Mendes',  'cargo' => 'Gerente de Segurança da Informação',      'foto' => 'img/imagem juliana.png'],
    ['nome' => 'Rafael Costa',    'cargo' => 'Arquiteto de Cloud Solutions',             'foto' => 'img/imagem rafael.png'],
    ['nome' => 'Camila Ferreira', 'cargo' => 'CTO na TechSolutions',                     'foto' => 'img/imagem isabela.png'],
    ['nome' => 'Bruno Almeida',   'cargo' => 'Consultor de Transformação Digital',       'foto' => 'img/imagem pedro.png'],
];

$faqs = [
    ['q' => 'O evento emite certificado?',      'a' => 'Sim! Todos os participantes com presença confirmada recebem certificado digital de 10 horas emitido diretamente pela plataforma EventCop.'],
    ['q' => 'As vagas são limitadas?',          'a' => 'Sim, as vagas presenciais são limitadas à capacidade do auditório para garantir conforto e networking de qualidade.'],
    ['q' => 'Posso transferir minha inscrição?', 'a' => 'Sim, a titularidade do ingresso pode ser transferida gratuitamente até 48 horas antes do início do evento.'],
    ['q' => 'Haverá estacionamento no local?',  'a' => 'Sim, o Centro de Convenções possui estacionamento conveniado no local com vagas cobertas e segurança 24h.'],
];

$pageTitle = $evento['titulo'] . ' | EventCop';
$pageCss   = ['pages/evento.css'];
$menuAtivo = 'home';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main class="evw-page">
    <div class="evw-sheet" data-reveal>

        <!-- TOPO / BREADCRUMB -->
        <div class="evw-topbar">
            <nav class="evw-breadcrumb" aria-label="Navegação estrutural">
                <a href="<?= route('galeria') ?>" class="evw-back">← Voltar</a>
                <span class="evw-sep">›</span>
                <a href="<?= route('galeria') ?>">Todos os eventos</a>
                <span class="evw-sep">›</span>
                <span class="evw-current"><?= e($evento['titulo']) ?></span>
            </nav>
            <a href="<?= route('relatorios') ?>" class="evw-top-metricas">Relatórios e métricas</a>
        </div>

        <!-- HERO DO EVENTO -->
        <section class="evw-hero">
            <div class="evw-hero-media">
                <img src="<?= asset($evento['imagem']) ?>" alt="<?= e($evento['titulo']) ?>">
                <span class="badge <?= e($statusBadge['classe']) ?> evw-hero-status"><?= e($statusBadge['rotulo']) ?></span>
            </div>

            <div class="evw-hero-info">
                <span class="evw-cat-tag"><?= e($catRotulo) ?></span>
                <h1 class="evw-title"><?= e($evento['titulo']) ?></h1>
                <p class="evw-desc"><?= e($evento['descricao']) ?></p>

                <ul class="evw-meta-list">
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><rect x="3" y="4" width="18" height="18" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M16 2v4M8 2v4M3 10h18" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <span><?= e(data_extenso($evento['data'])) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="12" cy="12" r="9" fill="none" stroke="currentColor" stroke-width="2"/><path d="M12 7v5l3 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        <span><?= e(str_replace(':', 'h', $evento['hora_inicio'])) ?> - <?= e(str_replace(':', 'h', $evento['hora_fim'])) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M12 21s-7-6.2-7-11a7 7 0 1 1 14 0c0 4.8-7 11-7 11z" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="12" cy="10" r="2.5" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <span><?= e($localTexto) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <span><?= e($formatoTxt) ?></span>
                    </li>
                    <li>
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm14 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        <span><?= (int) ($evento['confirmados'] ?: 120) ?> participantes confirmados</span>
                    </li>
                </ul>

                <div class="evw-hero-actions">
                    <a href="<?= route('inscricao', ['id_evento' => $evento['id']]) ?>" class="btn btn-solid evw-btn-participar">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2M9 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm10-3v6m3-3h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Quero participar
                    </a>
                    <button type="button" class="btn btn-outline evw-btn-share" data-toast="Link do evento copiado para a área de transferência!" data-toast-type="ok">
                        <svg viewBox="0 0 24 24" aria-hidden="true"><circle cx="18" cy="5" r="3" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="6" cy="12" r="3" fill="none" stroke="currentColor" stroke-width="2"/><circle cx="18" cy="19" r="3" fill="none" stroke="currentColor" stroke-width="2"/><path d="m8.6 13.5 6.8 4M15.4 6.5l-6.8 4" fill="none" stroke="currentColor" stroke-width="2"/></svg>
                        Compartilhar
                    </button>
                </div>
            </div>
        </section>

        <!-- ABAS DE NAVEGAÇÃO INTERNA -->
        <div class="tabs evw-tabs" role="tablist" data-tabs>
            <button type="button" role="tab" class="is-active" aria-selected="true" data-tab="sec-sobre">Sobre o evento</button>
            <button type="button" role="tab" aria-selected="false" data-tab="sec-programacao">Programação</button>
            <button type="button" role="tab" aria-selected="false" data-tab="sec-palestrantes">Palestrantes</button>
            <button type="button" role="tab" aria-selected="false" data-tab="sec-local">Local</button>
            <button type="button" role="tab" aria-selected="false" data-tab="sec-faq">Perguntas frequentes</button>
        </div>

        <!-- SEÇÃO SOBRE + INFORMAÇÕES IMPORTANTES -->
        <section id="sec-sobre" class="evw-about-grid" data-reveal>
            <div class="evw-card evw-about-card">
                <p class="evw-about-lead">
                    O <?= e($evento['titulo']) ?> reúne profissionais, estudantes e entusiastas para um dia de imersão em tendências, inovações e práticas que estão transformando o mercado.
                </p>

                <h2 class="evw-subtitle">Você vai aprender sobre:</h2>
                <ul class="evw-learn-list">
                    <li><span class="evw-check">✓</span> Inteligência Artificial e o futuro do trabalho</li>
                    <li><span class="evw-check">✓</span> Segurança da informação e proteção de dados</li>
                    <li><span class="evw-check">✓</span> Cloud Computing e infraestrutura escalável</li>
                    <li><span class="evw-check">✓</span> Cases reais de empresas inovadoras</li>
                    <li><span class="evw-check">✓</span> Networking com profissionais do setor</li>
                </ul>
            </div>

            <div class="evw-side-stack">
                <div class="evw-card evw-info-card">
                    <h2 class="evw-subtitle">Informações importantes</h2>
                    <dl class="evw-info-dl">
                        <div>
                            <dt>📅 Inscrições até</dt>
                            <dd>05 de setembro de 2026</dd>
                        </div>
                        <div>
                            <dt>Certificado</dt>
                            <dd>Sim, incluso</dd>
                        </div>
                        <div>
                            <dt>Alimentação</dt>
                            <dd>Coffee break + Almoço</dd>
                        </div>
                        <div>
                            <dt>Material de apoio</dt>
                            <dd>Digital</dd>
                        </div>
                        <div>
                            <dt>Público-alvo</dt>
                            <dd>Profissionais e estudantes</dd>
                        </div>
                    </dl>
                </div>

                <div class="evw-card evw-org-card">
                    <h2 class="evw-subtitle">Organizador</h2>
                    <div class="evw-org-row">
                        <div class="evw-org-avatar" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm0 2c-4.4 0-8 2.2-8 5v1h16v-1c0-2.8-3.6-5-8-5z" fill="currentColor"/></svg>
                        </div>
                        <div class="evw-org-text">
                            <strong>EventCop</strong>
                            <span>Eventos Corporativos</span>
                        </div>
                        <a href="<?= route('empresas') ?>" class="evw-btn-perfil">Ver perfil</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- PROGRAMAÇÃO DO EVENTO -->
        <section id="sec-programacao" class="evw-card evw-block" data-reveal>
            <div class="evw-section-head">
                <span class="evw-section-icon" aria-hidden="true">🗓️</span>
                <h2>Programação do evento</h2>
            </div>

            <ol class="evw-timeline">
                <?php foreach ($programacao as $item): ?>
                    <li class="evw-tl-row">
                        <div class="evw-tl-time">
                            <span class="evw-tl-clock" aria-hidden="true">🕒</span>
                            <strong><?= e($item['hora']) ?></strong>
                        </div>
                        <span class="evw-tl-dot" aria-hidden="true"></span>
                        <div class="evw-tl-content">
                            <strong><?= e($item['titulo']) ?></strong>
                            <?php if ($item['desc'] !== ''): ?>
                                <p><?= e($item['desc']) ?></p>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        </section>

        <!-- PALESTRANTES CONFIRMADOS -->
        <section id="sec-palestrantes" class="evw-block" data-reveal>
            <div class="evw-speakers-header">
                <div class="evw-section-head">
                    <span class="evw-section-icon" aria-hidden="true">👥</span>
                    <h2>Palestrantes confirmados</h2>
                </div>
                <div class="evw-speakers-nav">
                    <button type="button" class="evw-circle-btn" aria-label="Palestrante anterior" data-spk-prev>←</button>
                    <button type="button" class="evw-circle-btn" aria-label="Próximo palestrante" data-spk-next>→</button>
                </div>
            </div>

            <div class="evw-speakers-grid" id="evwSpeakersTrack">
                <?php foreach ($palestrantes as $p): ?>
                    <article class="evw-speaker-card card-hover">
                        <img src="<?= asset($p['foto']) ?>" alt="<?= e($p['nome']) ?>" class="evw-speaker-photo">
                        <h3><?= e($p['nome']) ?></h3>
                        <p><?= e($p['cargo']) ?></p>
                        <button type="button" class="evw-linkedin-btn" aria-label="LinkedIn de <?= e($p['nome']) ?>" data-toast="Abrindo perfil profissional de <?= e($p['nome']) ?>">in</button>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- LOCAL DO EVENTO + PERGUNTAS FREQUENTES -->
        <section id="sec-local" class="evw-bottom-grid" data-reveal>
            <div class="evw-card evw-local-card">
                <div class="evw-section-head">
                    <span class="evw-section-icon" aria-hidden="true">📍</span>
                    <h2>Local do evento</h2>
                </div>
                <div class="evw-address">
                    <strong>Centro de Convenções de <?= e($evento['cidade']) ?></strong>
                    <p>Av. Eng. Francisco José Longo, 777<br><?= e($localTexto) ?>, 12245-000</p>
                </div>

                <div class="evw-map-box" role="img" aria-label="Mapa da localização do evento">
                    <svg viewBox="0 0 500 180" class="evw-map-svg" aria-hidden="true">
                        <rect width="500" height="180" fill="#eef2ea"/>
                        <path d="M0 40 L500 120 M80 0 L180 180 M310 0 L240 180 M0 135 L500 65" stroke="#d5ddd0" stroke-width="10" fill="none"/>
                        <path d="M0 95 Q220 75 500 25" stroke="#bcc9e6" stroke-width="14" fill="none"/>
                        <path d="M130 0 L340 180" stroke="#f7d88c" stroke-width="8" fill="none"/>
                        <circle cx="250" cy="92" r="24" fill="rgba(125,26,26,0.16)"/>
                        <path d="M250 56c-11 0-20 9-20 20 0 15 20 34 20 34s20-19 20-34c0-11-9-20-20-20z" fill="#7d1a1a"/>
                        <circle cx="250" cy="76" r="7" fill="#fff8f2"/>
                    </svg>
                </div>

                <a href="https://maps.google.com/?q=<?= rawurlencode('Centro de Convenções ' . $localTexto) ?>" target="_blank" rel="noopener" class="evw-map-btn">
                    Ver no Google Maps <span>↗</span>
                </a>
            </div>

            <div id="sec-faq" class="evw-card evw-faq-card">
                <div class="evw-section-head">
                    <span class="evw-section-icon" aria-hidden="true">💬</span>
                    <h2>Perguntas frequentes</h2>
                </div>

                <div class="evw-faq-list">
                    <?php foreach ($faqs as $idx => $f): ?>
                        <div class="accordion-item<?= $idx === 0 ? ' is-open' : '' ?>" data-accordion>
                            <button type="button" class="accordion-trigger" aria-expanded="<?= $idx === 0 ? 'true' : 'false' ?>">
                                <span><?= e($f['q']) ?></span>
                                <svg viewBox="0 0 24 24" aria-hidden="true"><path d="m6 9 6 6 6-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                            </button>
                            <div class="accordion-panel" style="<?= $idx === 0 ? 'max-height: 160px;' : '' ?>">
                                <div><?= e($f['a']) ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- BANNER FINAL DE GARANTIA DE VAGA -->
        <section class="evw-cta-banner" data-reveal>
            <div class="evw-cta-left">
                <div class="evw-cta-mail-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 2 8 6 8-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div>
                    <h2>Garanta sua vaga no <?= e($evento['titulo']) ?></h2>
                    <p>Inscreva-se agora e não perca essa oportunidade!</p>
                </div>
            </div>

            <form class="evw-cta-form" action="<?= route('inscricao') ?>" method="GET">
                <input type="hidden" name="id_evento" value="<?= (int) $evento['id'] ?>">
                <input type="email" name="email" placeholder="Seu melhor e-mail" aria-label="Seu melhor e-mail" required>
                <button type="submit">Quero participar</button>
            </form>
        </section>

    </div>
</main>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const track = document.getElementById('evwSpeakersTrack');
    const prev = document.querySelector('[data-spk-prev]');
    const next = document.querySelector('[data-spk-next]');
    if (track && prev && next) {
        prev.addEventListener('click', () => track.scrollBy({ left: -240, behavior: 'smooth' }));
        next.addEventListener('click', () => track.scrollBy({ left: 240, behavior: 'smooth' }));
    }
});
</script>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
