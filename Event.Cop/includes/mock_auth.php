<?php
/**
 * Autenticação SIMULADA (Sprint 2). Nenhuma senha é verificada.
 *
 * Na Sprint 3 estas funções passam a consultar o banco (password_verify etc.).
 * Mantenha as assinaturas para que as páginas não precisem mudar.
 *
 * Perfis: "participante" e "organizador".
 */

/** Usuário logado ou null. Chaves: id, nome, email, tipo, avatar. */
function usuario_logado(): ?array
{
    return $_SESSION['usuario'] ?? null;
}

function esta_logado(): bool
{
    return usuario_logado() !== null;
}

function eh_organizador(): bool
{
    return (usuario_logado()['tipo'] ?? '') === 'organizador';
}

function eh_participante(): bool
{
    return (usuario_logado()['tipo'] ?? '') === 'participante';
}

/**
 * Efetua login "de mentira". Retorna true sempre que e-mail e senha não estiverem vazios.
 * O organizador demo é a "Marina Oliveira" dos wireframes.
 */
function login_mock(string $tipo, string $email, string $senha): bool
{
    $email = trim($email);
    if ($email === '' || $senha === '') {
        return false;
    }
    $nomeBase = ucwords(str_replace(['.', '_', '-'], ' ', explode('@', $email)[0]));
    session_regenerate_id(true);
    $_SESSION['usuario'] = [
        'id'     => $tipo === 'organizador' ? 1 : 100,
        'nome'   => $tipo === 'organizador' ? 'Marina Oliveira' : ($nomeBase ?: 'Participante'),
        'email'  => $email,
        'tipo'   => $tipo,
        'avatar' => 'img/imagem marina.png',
    ];
    return true;
}

/** Cadastro "de mentira": já deixa o usuário logado. */
function cadastrar_mock(string $tipo, array $dados): bool
{
    $nome  = trim((string) ($dados['nome'] ?? ''));
    $email = trim((string) ($dados['email'] ?? ''));
    if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return false;
    }
    session_regenerate_id(true);
    $_SESSION['usuario'] = [
        'id'     => $tipo === 'organizador' ? 1 : 100,
        'nome'   => $tipo === 'organizador' ? 'Marina Oliveira' : $nome,
        'email'  => $email,
        'tipo'   => $tipo,
        'avatar' => 'img/imagem marina.png',
    ];
    return true;
}

function logout_mock(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $p = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
    }
    session_destroy();
}

/** Bloqueia a página para quem não está logado (como participante OU organizador). */
function exigir_login(): void
{
    if (!esta_logado()) {
        flash('info', 'Faça login para continuar.');
        redirect_to('login');
    }
}

/** Bloqueia a página para quem não é organizador. */
function exigir_organizador(): void
{
    if (!eh_organizador()) {
        flash('info', 'Acesse com sua conta de organizador.');
        redirect_to('login_admin');
    }
}
