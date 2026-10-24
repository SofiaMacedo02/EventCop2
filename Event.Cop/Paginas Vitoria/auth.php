<?php
// Middleware e Utilitários de Autenticação - EventCop

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function estaLogado(): bool {
    return isset($_SESSION["user_id"]);
}

function ehOrganizador(): bool {
    return isset($_SESSION["user_tipo"]) && $_SESSION["user_tipo"] === "organizador";
}

function ehUsuario(): bool {
    return isset($_SESSION["user_tipo"]) && $_SESSION["user_tipo"] === "usuario";
}

function obterUsuarioLogado(): ?array {
    if (!estaLogado()) {
        return null;
    }
    return [
        "id" => $_SESSION["user_id"],
        "nome" => $_SESSION["user_nome"] ?? "Usuário",
        "email" => $_SESSION["user_email"] ?? "",
        "tipo" => $_SESSION["user_tipo"] ?? "usuario"
    ];
}

function exigirLogin(string $redirecionarPara = "../Paginas Macedo/login_normal.php"): void {
    if (!estaLogado()) {
        header("Location: " . $redirecionarPara);
        exit;
    }
}

function exigirOrganizador(string $redirecionarPara = "../Paginas Macedo/login_organizadores.php"): void {
    if (!estaLogado() || !ehOrganizador()) {
        header("Location: " . $redirecionarPara);
        exit;
    }
}
