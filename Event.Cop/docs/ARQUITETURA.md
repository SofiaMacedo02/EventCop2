# EventCop — Guia de arquitetura do frontend (Sprint 2)

Frontend em **PHP + HTML + CSS + JS**, **sem banco**. A Sprint 3 liga o banco trocando só `includes/mock_auth.php` e `data/*.php`.

## Estrutura

```
index.php                     → redireciona para a home
includes/
  bootstrap.php               → sessão, BASE_URL, helpers, auth fake (require em TODA página)
  helpers.php                 → e(), url(), asset(), route(), flash(), moeda(), data_extenso()
  mock_auth.php               → login_mock(), cadastrar_mock(), exigir_login(), exigir_organizador()
  layout/                     → head, header, footer (+scripts), panel_open, panel_close
data/                         → "banco" fake (arrays PHP); mesmas assinaturas que o banco terá
database/                     → config.php (PDO) e event_cop.sql — NÃO usados na Sprint 2
pages/{public,auth,events,organizer}/*.php
assets/css/{base,components,pages}  assets/js/{core,pages}  assets/img
```

## Como montar uma página

```php
<?php
require_once __DIR__ . '/../../includes/bootstrap.php';
require_once ROOT_PATH . '/data/eventos.php';          // se precisar de dados

$pageTitle = 'Galeria de eventos | EventCop';
$pageCss   = ['pages/galeria.css'];                    // relativo a assets/css
$pageJs    = ['pages/galeria.js'];                     // relativo a assets/js
$menuAtivo = 'home';
require ROOT_PATH . '/includes/layout/head.php';
require ROOT_PATH . '/includes/layout/header.php';
?>
<main> ... </main>
<?php require ROOT_PATH . '/includes/layout/footer.php'; ?>
```

**Painel do organizador** (dashboard/relatórios/pagamentos): `exigir_organizador();`, `$painelAtivo = 'inicio'|'relatorios'|'pagamentos'`, `pageCss` com `pages/panel.css` + `pages/organizer.css`, depois `head.php` → `panel_open.php` → conteúdo → `panel_close.php` (que já inclui o footer).

**Tela cheia** (sem header/footer): `head.php`, conteúdo, e `$semFooter = true;` antes de `footer.php`.

## Regras

1. **Nunca** use `../` em href/src. Use `route('nome')`, `asset('img/x.png')`.
2. Todo texto dinâmico passa por `e()`.
3. Sem `$pdo`, sem `require config.php`. Dados vêm de `data/*.php`; login/cadastro são fake (qualquer e-mail + senha preenchidos entram).
4. **Não mude o visual existente.** Cores, raios, sombras e tipografia vêm de `assets/css/base/tokens.css`. Componentes prontos em `components/components.css` (`.btn`, `.card`, `.badge`, `.chip`, `.tabs`, `.accordion-item`, `.pagination`, `.alert`, `.toast`).
5. Animações por atributo: `data-reveal` (`left|right|zoom`, `data-delay="120"`), `data-count="320"` (contador), `.bar-grow-x/.bar-grow-y`, `.draw-line`, `[data-accordion]`, `[data-tabs]`, `data-toast="msg"`. Veja `assets/js/core/ui.js` e `components/animations.css`.
6. Um CSS por página/área em `assets/css/pages/`. Não edite `layout.css`, `components.css`, `tokens.css`, `ui.js` sem necessidade; se precisar de algo novo reutilizável, **acrescente** ao final do arquivo.
7. `php -l arquivo.php` em todo PHP criado/alterado.

## Rotas lógicas (`includes/helpers.php` → `ROTAS`)

home, empresas, recursos, agenda, termos, politicas, galeria, evento, inscricao, confirmacao, login, login_admin, cadastro, cadastro_admin, logout, dashboard, relatorios, pagamentos, criar_evento, certificados.

## Rodar localmente

```
C:\xampp\php\php.exe -S localhost:8000 -t .      (na pasta Event.Cop)
http://localhost:8000/pages/public/home.php
```
Login organizador: qualquer e-mail/senha em `pages/auth/login-organizador.php` → dashboard.
