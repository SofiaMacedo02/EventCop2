<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';

$categorias      = eventos_categorias();
$todosEventos    = eventos_todos();
$eventosDestaque = array_values(array_filter($todosEventos, fn(array $ev): bool => !empty($ev['destaque'])));
$catSelecionada  = isset($_GET['categoria']) && array_key_exists((string) $_GET['categoria'], $categorias)
    ? (string) $_GET['categoria']
    : 'todos';

// Lista única de cidades para o filtro de localização
$cidadesDisponiveis = [];
foreach ($todosEventos as $ev) {
    $cidadesDisponiveis[$ev['cidade']] = evento_local($ev);
}

/** Retorna classe e rótulo do badge de status do card. */
function badge_status_galeria(string $status): array
{
    return match ($status) {
        'em-andamento'    => ['classe' => 'badge-ok badge-dot', 'rotulo' => 'Em andamento'],
        'em-breve'        => ['classe' => 'badge-warn',         'rotulo' => 'Em breve'],
        'vagas-limitadas' => ['classe' => 'badge-bad',          'rotulo' => 'Vagas limitadas'],
        'finalizado'      => ['classe' => 'badge-info',         'rotulo' => 'Finalizado'],
        default           => ['classe' => 'badge-cream',        'rotulo' => ucfirst($status)],
    };
}

/** Rótulo de formato do evento. */
function rotulo_formato(string $formato): string
{
    return match ($formato) {
        'online'  => 'Online',
        'hibrido' => 'Híbrido',
        default   => 'Presencial',
    };
}

$pageTitle = 'Galeria de Eventos | EventCop';
$pageCss   = ['pages/galeria.css'];
$pageJs    = ['pages/galeria.js'];
$menuAtivo = 'home';

require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main class="galeria-main">

    <!-- HERO DA GALERIA -->
    <section class="galeria-hero" data-reveal>
        <div class="galeria-hero-inner">
            <div class="galeria-hero-texto">
                <h1>Encontre o próximo<br>evento para você</h1>
                <p>Explore Workshops, palestras e experiências<br>corporativos em diferentes áreas</p>

                <div class="galeria-search-box">
                    <svg class="galeria-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2">
                        <circle cx="11" cy="11" r="7"></circle>
                        <line x1="16.5" y1="16.5" x2="21" y2="21"></line>
                    </svg>
                    <input
                        type="search"
                        id="galeria-busca"
                        class="galeria-search-input"
                        placeholder="Buscar evento"
                        aria-label="Buscar evento">
                </div>
            </div>

            <div class="galeria-hero-arte" data-reveal="right" data-delay="100">
                <div class="galeria-kit-composicao">
                    <img
                        src="<?= asset('img/imagem notebook.png') ?>"
                        alt="Kit Corporativo EventCop"
                        class="galeria-kit-img">
                </div>
            </div>
        </div>
    </section>

    <!-- CONTEÚDO PRINCIPAL -->
    <div class="galeria-conteudo">

        <!-- BARRA DE FILTROS -->
        <section class="galeria-filtros-bar" aria-label="Filtros de eventos" data-reveal>
            <div class="galeria-chips">
                <a href="<?= route('galeria') ?>"
                   class="chip <?= $catSelecionada === 'todos' ? 'is-active' : '' ?>"
                   data-filtro-cat="todos">
                    <span>⊞</span> Todos
                </a>
                <?php foreach ($categorias as $slug => $rotulo): ?>
                    <a href="<?= route('galeria', ['categoria' => $slug]) ?>"
                       class="chip <?= $catSelecionada === $slug ? 'is-active' : '' ?>"
                       data-filtro-cat="<?= e($slug) ?>">
                        <?= e($rotulo) ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <div class="galeria-selects">
                <select id="filtro-data" class="galeria-filter-select" aria-label="Filtrar por mês">
                    <option value="">📅 Data</option>
                    <option value="2026-08">Agosto 2026</option>
                    <option value="2026-09">Setembro 2026</option>
                    <option value="2026-10">Outubro 2026</option>
                    <option value="2026-11">Novembro 2026</option>
                </select>

                <select id="filtro-local" class="galeria-filter-select" aria-label="Filtrar por localização">
                    <option value="">📍 Localização</option>
                    <?php foreach ($cidadesDisponiveis as $cidadeKey => $localLabel): ?>
                        <option value="<?= e($cidadeKey) ?>"><?= e($localLabel) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </section>

        <!-- SEÇÃO: EVENTOS EM DESTAQUE -->
        <section class="galeria-destaques-wrap" aria-labelledby="titulo-destaques" data-reveal>
            <div class="galeria-secao-header">
                <h2 id="titulo-destaques" class="galeria-secao-titulo">
                    <span class="galeria-icone-fogo">🔥</span> Eventos em destaque
                </h2>
                <button type="button" id="btn-ver-todos-destaque" class="galeria-ver-todos">
                    Ver todos <span>→</span>
                </button>
            </div>

            <button type="button" class="galeria-seta galeria-seta-prev" aria-label="Evento anterior" data-destaque-prev>‹</button>
            <button type="button" class="galeria-seta galeria-seta-next" aria-label="Próximo evento" data-destaque-next>›</button>

            <div class="galeria-grid" id="grid-destaques">
                <?php foreach ($eventosDestaque as $ev):
                    $st = badge_status_galeria($ev['status']);
                    $catRotulo = $categorias[$ev['categoria']] ?? ucfirst($ev['categoria']);
                ?>
                    <article class="evento-card">
                        <div class="evento-card-media">
                            <img src="<?= asset($ev['imagem']) ?>" alt="<?= e($ev['titulo']) ?>">
                            <span class="badge <?= e($st['classe']) ?> evento-status-badge"><?= e($st['rotulo']) ?></span>
                        </div>
                        <div class="evento-card-body">
                            <span class="evento-cat-pill cat-<?= e($ev['categoria']) ?>"><?= e($catRotulo) ?></span>
                            <h3 class="evento-card-titulo"><?= e($ev['titulo']) ?></h3>
                            <div class="evento-card-meta">
                                <div class="evento-meta-linha">
                                    <span class="evento-meta-icone">📅</span>
                                    <span><?= e(data_extenso($ev['data'])) ?></span>
                                </div>
                                <div class="evento-meta-linha">
                                    <span class="evento-meta-icone">📍</span>
                                    <span><?= e(evento_local($ev)) ?></span>
                                </div>
                            </div>
                            <div class="evento-card-footer">
                                <span class="evento-formato-pill formato-<?= e($ev['formato']) ?>">
                                    👤 <?= e(rotulo_formato($ev['formato'])) ?>
                                </span>
                                <a href="<?= route('evento', ['id' => $ev['id']]) ?>" class="btn-ver-evento">
                                    Ver evento <span>→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- SEÇÃO: TODOS OS EVENTOS -->
        <section id="secao-todos-eventos" aria-labelledby="titulo-todos-eventos" data-reveal>
            <div class="galeria-secao-header">
                <h2 id="titulo-todos-eventos" class="galeria-secao-titulo">Todos os eventos</h2>

                <div class="galeria-controles-direita">
                    <select id="filtro-ordem" class="galeria-filter-select" aria-label="Ordenar eventos">
                        <option value="recentes">Mais recentes</option>
                        <option value="preco-menor">Menor preço</option>
                        <option value="preco-maior">Maior preço</option>
                        <option value="titulo">Ordem A-Z</option>
                    </select>
                    <button type="button" class="galeria-view-btn is-active" data-view-mode="grid" aria-label="Visualização em grade">⊞</button>
                    <button type="button" class="galeria-view-btn" data-view-mode="list" aria-label="Visualização em lista">☰</button>
                </div>
            </div>

            <div class="galeria-grid" id="grid-todos-eventos">
                <?php foreach ($todosEventos as $ev):
                    $st = badge_status_galeria($ev['status']);
                    $catRotulo = $categorias[$ev['categoria']] ?? ucfirst($ev['categoria']);
                ?>
                    <article
                        class="evento-card"
                        data-categoria="<?= e($ev['categoria']) ?>"
                        data-cidade="<?= e($ev['cidade']) ?>"
                        data-formato="<?= e($ev['formato']) ?>"
                        data-data="<?= e($ev['data']) ?>"
                        data-preco="<?= e((string) $ev['preco']) ?>"
                        data-titulo="<?= e($ev['titulo']) ?>">
                        <div class="evento-card-media">
                            <img src="<?= asset($ev['imagem']) ?>" alt="<?= e($ev['titulo']) ?>">
                            <span class="badge <?= e($st['classe']) ?> evento-status-badge"><?= e($st['rotulo']) ?></span>
                        </div>
                        <div class="evento-card-body">
                            <span class="evento-cat-pill cat-<?= e($ev['categoria']) ?>"><?= e($catRotulo) ?></span>
                            <h3 class="evento-card-titulo"><?= e($ev['titulo']) ?></h3>
                            <div class="evento-card-meta">
                                <div class="evento-meta-linha">
                                    <span class="evento-meta-icone">📅</span>
                                    <span><?= e(data_extenso($ev['data'])) ?></span>
                                </div>
                                <div class="evento-meta-linha">
                                    <span class="evento-meta-icone">📍</span>
                                    <span><?= e(evento_local($ev)) ?></span>
                                </div>
                            </div>
                            <div class="evento-card-footer">
                                <span class="evento-formato-pill formato-<?= e($ev['formato']) ?>">
                                    👤 <?= e(rotulo_formato($ev['formato'])) ?>
                                </span>
                                <a href="<?= route('evento', ['id' => $ev['id']]) ?>" class="btn-ver-evento">
                                    Ver evento <span>→</span>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>

                <div id="galeria-vazio" class="galeria-vazio" hidden>
                    <h3>Nenhum evento encontrado</h3>
                    <p>Tente ajustar os filtros de categoria, data ou palavra-chave.</p>
                    <button type="button" id="btn-limpar-filtros" class="btn btn-solid">Limpar filtros</button>
                </div>
            </div>

            <!-- PAGINAÇÃO -->
            <nav class="pagination" aria-label="Paginação de eventos">
                <a href="<?= route('galeria') ?>" class="is-active" aria-current="page">1</a>
                <a href="<?= route('galeria') ?>" data-toast="Página 2 da galeria">2</a>
                <a href="<?= route('galeria') ?>" data-toast="Página 3 da galeria">3</a>
                <span>…</span>
                <a href="<?= route('galeria') ?>" data-toast="Página 8 da galeria">8</a>
                <a href="<?= route('galeria') ?>" aria-label="Próxima página" data-toast="Próxima página">›</a>
            </nav>
        </section>

        <!-- NEWSLETTER CTA -->
        <section class="galeria-newsletter" aria-label="Cadastro na newsletter" data-reveal>
            <div class="galeria-news-esq">
                <div class="galeria-news-icone">✉️</div>
                <div>
                    <h3>Receba novidades sobre eventos</h3>
                    <p>Cadastre-se e seja o primeiro a saber sobre lançamentos e oportunidades para impulsionar sua carreira e seu negócio.</p>
                </div>
            </div>

            <form id="form-newsletter" class="galeria-news-form">
                <input
                    type="email"
                    class="galeria-news-input"
                    placeholder="Seu melhor e-mail"
                    required
                    aria-label="Seu melhor e-mail">
                <button type="submit" class="galeria-news-btn">Cadastrar</button>
            </form>
        </section>

    </div>

</main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
