<?php
/**
 * Bootstrap do EventCop (Sprint 2 - frontend).
 *
 * Todas as páginas em /pages/* devem começar com:
 *   require_once __DIR__ . '/../../includes/bootstrap.php';
 *
 * Aqui só existe o necessário para o frontend: sessão, caminhos, helpers,
 * autenticação SIMULADA e a camada de dados fake. Não há acesso a banco.
 */
declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('ROOT_PATH', dirname(__DIR__));

// BASE_URL = caminho do projeto relativo ao document root (ex.: "/EventCop2/Event.Cop" ou "").
$__docRoot = rtrim(str_replace('\\', '/', (string) realpath($_SERVER['DOCUMENT_ROOT'] ?? '')), '/');
$__root    = str_replace('\\', '/', ROOT_PATH);
define('BASE_URL', ($__docRoot !== '' && stripos($__root, $__docRoot) === 0)
    ? rtrim(substr($__root, strlen($__docRoot)), '/')
    : '');
unset($__docRoot, $__root);

require_once __DIR__ . '/helpers.php';
require_once __DIR__ . '/mock_auth.php';
