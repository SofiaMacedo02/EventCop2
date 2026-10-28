<?php
/**
 * Abre o documento HTML. Variáveis aceitas (todas opcionais):
 *   $pageTitle  string   título da aba
 *   $pageCss    string[] CSS extra relativo a /assets/css (ex.: ['pages/public.css'])
 *   $bodyClass  string   classe(s) no <body>
 */
$pageTitle = $pageTitle ?? 'EventCop';
$pageCss   = $pageCss ?? [];
$bodyClass = $bodyClass ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle) ?></title>
    <link rel="icon" href="<?= asset('img/logonv.jpeg') ?>">
    <link rel="stylesheet" href="<?= asset('css/base/tokens.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/components/layout.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/components/components.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/components/animations.css') ?>">
<?php foreach ($pageCss as $css): ?>
    <link rel="stylesheet" href="<?= asset('css/' . $css) ?>">
<?php endforeach; ?>
</head>

<body class="<?= e($bodyClass) ?>">
