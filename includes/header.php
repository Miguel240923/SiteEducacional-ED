<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($titulo) ? $titulo . ' | ' : '' ?><?= SITE_NOME ?></title>
    <link rel="stylesheet" href="<?= $basePath ?? '../' ?>assets/css/estilo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-dark.min.css">
</head>
<body>

<header class="cabecalho">
    <div class="container">
        <a href="<?= $basePath ?? '../' ?>index.php" class="logo">
            <span class="logo-icone">{ }</span>
            <span class="logo-texto"><?= SITE_NOME ?></span>
            <span class="logo-tag">Aprenda Estruturas de Dados</span>
        </a>
        <button class="menu-toggle" id="menuToggle" aria-label="Menu">☰</button>
        <nav class="navegacao" id="navMenu">
            <a href="<?= $basePath ?? '../' ?>index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'ativo' : '' ?>">Início</a>
            <a href="<?= $basePath ?? '../' ?>pages/tad.php" class="<?= basename($_SERVER['PHP_SELF']) === 'tad.php' ? 'ativo' : '' ?>">TAD</a>
            <a href="<?= $basePath ?? '../' ?>pages/lista-simples.php" class="<?= basename($_SERVER['PHP_SELF']) === 'lista-simples.php' ? 'ativo' : '' ?>">Lista Simples</a>
            <a href="<?= $basePath ?? '../' ?>pages/lista-dupla.php" class="<?= basename($_SERVER['PHP_SELF']) === 'lista-dupla.php' ? 'ativo' : '' ?>">Lista Dupla</a>
            <a href="<?= $basePath ?? '../' ?>admin/login.php" class="btn-admin">⚙ Admin</a>
        </nav>
    </div>
</header>

<main class="conteudo-principal">
