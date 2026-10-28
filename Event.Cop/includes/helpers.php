<?php
/**
 * Helpers de view. Use SEMPRE route()/asset() em vez de caminhos relativos ("../").
 */

/** Mapa de rotas lógicas => arquivo. Se um arquivo mudar de lugar, só este mapa muda. */
const ROTAS = [
    // público
    'home'                => 'pages/public/home.php',
    'empresas'            => 'pages/public/empresas.php',
    'recursos'            => 'pages/public/recursos.php',
    'agenda'              => 'pages/public/agenda-consultores.php',
    'termos'              => 'pages/public/termos.php',
    'politicas'           => 'pages/public/politicas.php',
    // eventos
    'galeria'             => 'pages/events/galeria.php',
    'evento'              => 'pages/events/evento.php',
    'inscricao'           => 'pages/events/inscricao.php',
    'confirmacao'         => 'pages/events/confirmacao.php',
    // autenticação
    'login'               => 'pages/auth/login-participante.php',
    'login_admin'         => 'pages/auth/login-organizador.php',
    'cadastro'            => 'pages/auth/cadastro-participante.php',
    'cadastro_admin'      => 'pages/auth/cadastro-organizador.php',
    'logout'              => 'pages/auth/logout.php',
    // painel do organizador
    'dashboard'           => 'pages/organizer/dashboard.php',
    'relatorios'          => 'pages/organizer/relatorios.php',
    'pagamentos'          => 'pages/organizer/pagamentos.php',
    'criar_evento'        => 'pages/organizer/criar-evento.php',
    'certificados'        => 'pages/organizer/certificados.php',
];

/** Escapa texto para HTML. */
function e(mixed $valor): string
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

/** URL absoluta (a partir do host) para um caminho do projeto. */
function url(string $caminho = ''): string
{
    $partes = explode('/', ltrim($caminho, '/'));
    return BASE_URL . '/' . implode('/', array_map('rawurlencode', $partes));
}

/** URL de um arquivo em /assets (ex.: asset('img/logonv.jpeg')). */
function asset(string $caminho): string
{
    return url('assets/' . ltrim($caminho, '/'));
}

/** URL de uma rota lógica (ver ROTAS). Aceita query string: route('evento', ['id' => 3]). */
function route(string $nome, array $query = [], string $ancora = ''): string
{
    $arquivo = ROTAS[$nome] ?? null;
    if ($arquivo === null) {
        trigger_error("Rota desconhecida: {$nome}", E_USER_WARNING);
        return '#';
    }
    $href = url($arquivo);
    if ($query) {
        $href .= '?' . http_build_query($query);
    }
    return $ancora !== '' ? $href . '#' . ltrim($ancora, '#') : $href;
}

/** Redireciona para uma rota lógica e encerra. */
function redirect_to(string $nome, array $query = []): never
{
    header('Location: ' . route($nome, $query));
    exit;
}

/** Mensagem "flash" (vale para a próxima requisição). */
function flash(string $tipo, string $mensagem): void
{
    $_SESSION['__flash'][] = ['tipo' => $tipo, 'msg' => $mensagem];
}

/** Lê e limpa as mensagens flash. */
function flash_consumir(): array
{
    $itens = $_SESSION['__flash'] ?? [];
    unset($_SESSION['__flash']);
    return $itens;
}

/** Formata número como moeda brasileira. */
function moeda(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

/** Data "2026-09-15" => "15 de setembro de 2026". */
function data_extenso(string $iso): string
{
    static $meses = ['janeiro', 'fevereiro', 'março', 'abril', 'maio', 'junho',
                     'julho', 'agosto', 'setembro', 'outubro', 'novembro', 'dezembro'];
    $t = strtotime($iso);
    return (int) date('j', $t) . ' de ' . $meses[(int) date('n', $t) - 1] . ' de ' . date('Y', $t);
}

/** Classe "active" para itens de menu. */
function ativo(string $atual, string $item): string
{
    return $atual === $item ? ' is-active' : '';
}
