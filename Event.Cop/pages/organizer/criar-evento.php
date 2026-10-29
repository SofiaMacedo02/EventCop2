<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';
require_once ROOT_PATH . '/data/organizador.php';

$usuario = usuario_logado();
$erro    = '';

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST') {
    $cidade      = trim((string) ($_POST['cidade'] ?? 'São José dos Campos'));
    $estado      = strtoupper(trim((string) ($_POST['estado'] ?? 'SP')));
    $nomeEvento  = trim((string) ($_POST['nome_evento'] ?? ''));
    $descricao   = trim((string) ($_POST['descricao'] ?? ''));
    $expectativa = trim((string) ($_POST['expectativa'] ?? '50 a 150 participantes'));
    $tipo        = trim((string) ($_POST['tipo'] ?? 'publico'));
    $categoria   = trim((string) ($_POST['categoria'] ?? 'tecnologia'));
    $formato     = trim((string) ($_POST['formato'] ?? 'presencial'));
    $nomeOrga    = trim((string) ($_POST['nome_organizador'] ?? ($usuario['nome'] ?? 'Marina Oliveira')));
    $emailOrga   = trim((string) ($_POST['email_organizador'] ?? ($usuario['email'] ?? 'marina@eventcop.com.br')));
    $recursos    = $_POST['recursos'] ?? ['inscricoes', 'programacao'];

    if (!in_array($formato, ['presencial', 'online', 'hibrido'], true)) {
        $formato = 'presencial';
    }

    if ($nomeEvento === '') {
        $erro = 'Por favor, informe o nome do evento para continuar.';
    } else {
        if (!eh_organizador()) {
            login_mock('organizador', $emailOrga !== '' ? $emailOrga : 'marina@eventcop.com.br', 'demo');
        }

        if (!isset($_SESSION['eventos_criados']) || !is_array($_SESSION['eventos_criados'])) {
            $_SESSION['eventos_criados'] = [];
        }

        $_SESSION['eventos_criados'][] = [
            'id'          => count($_SESSION['eventos_criados']) + 100,
            'titulo'      => $nomeEvento,
            'descricao'   => $descricao !== '' ? $descricao : 'Evento corporativo cadastrado na plataforma EventCop.',
            'cidade'      => $cidade !== '' ? $cidade : 'São José dos Campos',
            'estado'      => $estado !== '' ? substr($estado, 0, 2) : 'SP',
            'expectativa' => $expectativa !== '' ? $expectativa : '100 participantes',
            'tipo'        => $tipo,
            'categoria'   => $categoria,
            'formato'     => $formato,
            'organizador' => $nomeOrga,
            'recursos'    => is_array($recursos) ? $recursos : ['inscricoes', 'programacao'],
            'data'        => date('Y-m-d', strtotime('+14 days')),
            'hora_inicio' => '09:00',
            'confirmados' => 45,
            'vagas'       => 150,
        ];

        flash('ok', 'Evento criado com sucesso!');
        redirect_to('dashboard');
    }
}

$categorias  = eventos_categorias();
$pageTitle   = 'Criar Evento | EventCop';
$pageCss     = ['pages/organizer.css'];
$pageJs      = ['pages/organizer.js'];
$menuAtivo   = 'divulgar';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>

<main class="ce-main" id="ceMain">
    <!-- Coluna esquerda (Vinho) - Passos 1 a 3 -->
    <aside class="ce-banner" id="ceBanner">
        <div class="ce-banner-inner">
            <img src="<?= asset('img/logonv.jpeg') ?>" alt="EventCop Eventos Corporativos" class="ce-banner-logo">
            <h2 class="ce-banner-title">Você em boas mãos</h2>
            <blockquote class="ce-banner-quote">
                “A EventCop tornou a organização do nosso evento muito mais simples. Conseguimos centralizar as inscrições, acompanhar os participantes e disponibilizar todas as informações em um só lugar.”
            </blockquote>
            <p class="ce-banner-author">Marina Oliveira - Organizadora do Conecta Inovação 2026</p>
        </div>
    </aside>

    <!-- Coluna direita (Creme) - Passos 1 a 3 + Passo 4 (Tela cheia de boas-vindas) -->
    <section class="ce-wizard-col">
        <?php if ($erro !== ''): ?>
            <div class="alert alert-erro" role="alert" style="max-width: 620px; width: 100%; margin-bottom: 16px;">
                <?= e($erro) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="<?= route('criar_evento') ?>" id="formCriarEvento" class="ce-form" novalidate>

            <!-- PASSO 1 DE 3: Vamos criar seu evento (criar evento - 1.png) -->
            <div class="ce-step is-active" data-ce-step="1">
                <h1 class="ce-step-title">Vamos criar seu evento</h1>

                <div class="ce-progress-wrap">
                    <span class="ce-progress-label">Passo 1 de 3</span>
                    <div class="ce-progress-bar"><span style="width: 35%;"></span></div>
                </div>

                <div class="ce-grid-2">
                    <div class="ce-field">
                        <label for="ceCidade">Cidade</label>
                        <input type="text" id="ceCidade" name="cidade" required placeholder="Ex.: São José dos Campos" value="<?= e($_POST['cidade'] ?? 'São José dos Campos') ?>">
                    </div>
                    <div class="ce-field">
                        <label for="ceEstado">Estado</label>
                        <input type="text" id="ceEstado" name="estado" maxlength="2" required placeholder="SP" value="<?= e($_POST['estado'] ?? 'SP') ?>">
                    </div>
                </div>

                <div class="ce-field">
                    <label for="ceNomeEvento">Nome do Evento</label>
                    <input type="text" id="ceNomeEvento" name="nome_evento" required placeholder="Ex.: Simpósio de Inovação Corporativa 2026" value="<?= e($_POST['nome_evento'] ?? '') ?>">
                </div>

                <div class="ce-field">
                    <label for="ceDescricao">Descrição do evento</label>
                    <textarea id="ceDescricao" name="descricao" rows="3" required placeholder="Descreva os objetivos, público-alvo e destaques do seu evento..."><?= e($_POST['descricao'] ?? '') ?></textarea>
                </div>

                <div class="ce-field">
                    <label for="ceExpectativa">Expectativa de participantes</label>
                    <select id="ceExpectativa" name="expectativa" required>
                        <option value="" disabled>Selecione uma opção</option>
                        <option value="Até 50 participantes">Até 50 participantes</option>
                        <option value="50 a 150 participantes" selected>50 a 150 participantes</option>
                        <option value="150 a 400 participantes">150 a 400 participantes</option>
                        <option value="Mais de 400 participantes">Mais de 400 participantes</option>
                    </select>
                </div>

                <div class="ce-grid-2">
                    <div class="ce-field">
                        <label for="ceTipo">Tipo</label>
                        <select id="ceTipo" name="tipo" required>
                            <option value="" disabled>Selecione uma opção</option>
                            <option value="publico" selected>Evento Público</option>
                            <option value="corporativo">Evento Corporativo</option>
                            <option value="privado">Evento para Convidados</option>
                        </select>
                    </div>
                    <div class="ce-field">
                        <label for="ceCategoria">Categoria</label>
                        <select id="ceCategoria" name="categoria" required>
                            <option value="" disabled>Selecione uma opção</option>
                            <?php foreach ($categorias as $slug => $rotulo): ?>
                                <option value="<?= e($slug) ?>"<?= $slug === 'tecnologia' ? ' selected' : '' ?>><?= e($rotulo) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="ce-field">
                    <span class="ce-radio-group-label">Seu evento é:</span>
                    <div class="ce-radios">
                        <label class="ce-radio-option">
                            <input type="radio" name="formato" value="presencial" checked>
                            <span class="ce-radio-dot"></span>
                            <span>Presencial</span>
                        </label>
                        <label class="ce-radio-option">
                            <input type="radio" name="formato" value="online">
                            <span class="ce-radio-dot"></span>
                            <span>Online</span>
                        </label>
                        <label class="ce-radio-option">
                            <input type="radio" name="formato" value="hibrido">
                            <span class="ce-radio-dot"></span>
                            <span>Híbrido</span>
                        </label>
                    </div>
                </div>

                <div class="ce-actions">
                    <button type="button" class="ce-btn-submit" data-ce-next>Continuar</button>
                </div>
            </div>

            <!-- PASSO 2 DE 3: Perfeito, conte-nos sobre você (criar evento - 2.png) -->
            <div class="ce-step" data-ce-step="2" hidden>
                <h1 class="ce-step-title">Perfeito, conte-nos sobre você</h1>

                <div class="ce-progress-wrap">
                    <span class="ce-progress-label">Passo 2 de 3</span>
                    <div class="ce-progress-bar"><span style="width: 68%;"></span></div>
                </div>

                <div class="ce-field">
                    <label for="ceNomeOrga">Seu nome</label>
                    <input type="text" id="ceNomeOrga" name="nome_organizador" required placeholder="Marina Oliveira" value="<?= e($usuario['nome'] ?? 'Marina Oliveira') ?>">
                </div>

                <div class="ce-field">
                    <label for="ceEmailOrga">Seu e-mail</label>
                    <input type="email" id="ceEmailOrga" name="email_organizador" required placeholder="marina@eventcop.com.br" value="<?= e($usuario['email'] ?? 'marina@eventcop.com.br') ?>">
                </div>

                <div class="ce-field">
                    <label for="ceTelefoneOrga">Telefone</label>
                    <div class="ce-phone-box">
                        <span class="ce-phone-prefix" aria-hidden="true">
                            <span class="ce-flag-br"></span>
                            +55
                        </span>
                        <input type="tel" id="ceTelefoneOrga" name="telefone_organizador" placeholder="(12) 99123-4567" value="(12) 99123-4567">
                    </div>
                </div>

                <div class="ce-field">
                    <label for="ceSenhaOrga">Crie uma senha de acesso</label>
                    <input type="password" id="ceSenhaOrga" name="senha_organizador" placeholder="••••••••" value="eventcop2026">
                </div>

                <label class="ce-terms-check">
                    <input type="checkbox" id="ceTermos" name="aceite_termos" checked required>
                    <span class="ce-terms-box"></span>
                    <span>
                        Estou ciente dos <a href="<?= route('termos') ?>" target="_blank" rel="noopener">Termos de uso</a>
                        e <a href="<?= route('politicas') ?>" target="_blank" rel="noopener">Políticas</a> da EventCop
                    </span>
                </label>

                <div class="ce-actions">
                    <button type="button" class="ce-btn-back" data-ce-prev>Voltar</button>
                    <button type="button" class="ce-btn-submit" data-ce-next>Continuar</button>
                </div>
            </div>

            <!-- PASSO 3 DE 3: Do que seu evento precisa? (criar evento - 3.png) -->
            <div class="ce-step" data-ce-step="3" hidden>
                <h1 class="ce-step-title">Do que seu evento precisa?</h1>

                <div class="ce-progress-wrap">
                    <span class="ce-progress-label">Passo 3 de 3</span>
                    <div class="ce-progress-bar"><span style="width: 100%;"></span></div>
                    <small class="ce-progress-hint">Você poderá alterar posteriormente!</small>
                </div>

                <div class="ce-needs-list">
                    <label class="ce-need-card">
                        <input type="checkbox" name="recursos[]" value="inscricoes" checked>
                        <div class="ce-need-icon" aria-hidden="true">
                            <svg viewBox="0 0 64 64">
                                <rect x="8" y="20" width="40" height="26" rx="4" transform="rotate(-12 28 33)" fill="#ee8f66"/>
                                <rect x="12" y="22" width="40" height="26" rx="4" transform="rotate(-5 32 35)" fill="#fff8f2" stroke="#5a0505" stroke-width="2"/>
                                <circle cx="30" cy="35" r="7" fill="#7d1a1a"/>
                                <text x="30" y="39" text-anchor="middle" fill="#fff8f2" font-size="11" font-weight="800">e</text>
                            </svg>
                        </div>
                        <div class="ce-need-body">
                            <strong>Inscrições</strong>
                            <p>Crie formulários de inscrição personalizados e permita que participantes se inscrevam de forma rápida e segura.</p>
                        </div>
                        <span class="ce-need-check" aria-hidden="true">✓</span>
                    </label>

                    <label class="ce-need-card">
                        <input type="checkbox" name="recursos[]" value="programacao" checked>
                        <div class="ce-need-icon" aria-hidden="true">
                            <svg viewBox="0 0 64 64">
                                <rect x="10" y="12" width="36" height="38" rx="5" fill="#fff8f2" stroke="#5a0505" stroke-width="2"/>
                                <rect x="10" y="12" width="36" height="10" rx="4" fill="#7d1a1a"/>
                                <line x1="16" y1="30" x2="36" y2="30" stroke="#7d1a1a" stroke-width="2.5" stroke-linecap="round"/>
                                <line x1="16" y1="37" x2="32" y2="37" stroke="#7d1a1a" stroke-width="2.5" stroke-linecap="round"/>
                                <circle cx="44" cy="42" r="11" fill="#ee8f66" stroke="#5a0505" stroke-width="2"/>
                                <path d="M44 36v6l4 3" fill="none" stroke="#fff8f2" stroke-width="2.2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="ce-need-body">
                            <strong>Programação</strong>
                            <p>Organize horários, palestras, workshops e atividades do seu evento em um só lugar.</p>
                        </div>
                        <span class="ce-need-check" aria-hidden="true">✓</span>
                    </label>
                </div>

                <div class="ce-actions">
                    <button type="button" class="ce-btn-back" data-ce-prev>Voltar</button>
                    <button type="button" class="ce-btn-submit" data-ce-next>Continuar</button>
                </div>
            </div>

            <!-- PASSO 4: Bem vindo a EventCop (criar evento - 4.png) -->
            <div class="ce-step ce-step-welcome" data-ce-step="4" hidden>
                <div class="ce-welcome-box">
                    <div class="ce-welcome-art">
                        <img src="<?= asset('img/imagem conectando pessoas e conhecimento.png') ?>" alt="Equipe de organizadores EventCop">
                    </div>
                    <h2 class="ce-welcome-title">Bem vindo a EventCop</h2>
                    <p class="ce-welcome-text">
                        O seu próximo passo é explorar os eventos disponíveis na nossa plataforma e gerenciar seu evento recém-criado no painel do organizador.
                    </p>
                    <div class="ce-welcome-actions">
                        <button type="submit" class="ce-btn-welcome">Acessar agenda</button>
                        <button type="button" class="ce-btn-welcome-back" data-ce-prev>← Revisar dados do evento</button>
                    </div>
                </div>
            </div>

        </form>
    </section>
</main>

<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
