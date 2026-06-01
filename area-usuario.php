<?php
require_once 'includes/config.php';
verificarUsuario();

$titulo = 'Área do Usuário';
$basePath = './';
require_once 'includes/header.php';
?>

<div class="container" style="padding:48px 20px;">
    <div class="admin-titulo">
        <span>👋 Olá, <?= htmlspecialchars($_SESSION['usuario_nome']) ?></span>
        <a href="logout-usuario.php" class="btn-secundario" style="font-size:0.85rem;padding:8px 16px;">Sair</a>
    </div>

    <div class="cards-grid">
        <div class="card card-verde">
            <span class="card-icone">🧩</span>
            <h3>TAD</h3>
            <p>Comece pelos conceitos de abstração, interface e implementação.</p>
            <a href="pages/tad.php" class="card-link">Estudar TAD →</a>
        </div>
        <div class="card card-azul">
            <span class="card-icone">🔗</span>
            <h3>Lista Simples</h3>
            <p>Aprenda nós, ponteiros e operações básicas.</p>
            <a href="pages/lista-simples.php" class="card-link">Estudar Lista Simples →</a>
        </div>
        <div class="card card-roxo">
            <span class="card-icone">⛓️</span>
            <h3>Lista Dupla</h3>
            <p>Veja como navegar para frente e para trás com nós duplos.</p>
            <a href="pages/lista-dupla.php" class="card-link">Estudar Lista Dupla →</a>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
