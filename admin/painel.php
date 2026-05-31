<?php
require_once '../includes/config.php';
verificarAdmin();

$conexao = conectar();

// busca todos os conteúdos
$resultado = $conexao->query("SELECT * FROM conteudos ORDER BY estrutura, ordem ASC");
$conteudos = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];

$conexao->close();

$titulo   = 'Painel Admin';
$basePath = '../';
require_once '../includes/header.php';
?>

<div class="admin-layout">

    <!-- Sidebar Admin -->
    <aside class="admin-sidebar">
        <h4>Menu</h4>
        <a href="painel.php" class="ativo">📋 Conteúdos</a>
        <a href="novo.php">➕ Novo Conteúdo</a>
        <a href="logout.php">🚪 Sair</a>
        <hr style="border-color:var(--cor-borda);margin:16px 0;">
        <h4>Ver Site</h4>
        <a href="../index.php" target="_blank">🏠 Início</a>
        <a href="../pages/tad.php" target="_blank">🧩 TAD</a>
        <a href="../pages/lista-simples.php" target="_blank">🔗 Lista Simples</a>
        <a href="../pages/lista-dupla.php" target="_blank">⛓️ Lista Dupla</a>
    </aside>

    <!-- Conteúdo Admin -->
    <div class="admin-conteudo">
        <div class="admin-titulo">
            <span>📋 Gerenciar Conteúdos</span>
            <a href="novo.php" class="btn-primario" style="font-size:0.85rem;padding:8px 16px;">+ Novo</a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alerta alerta-sucesso">
                ✅ <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['erro'])): ?>
            <div class="alerta alerta-erro">
                ❌ <?= htmlspecialchars($_GET['erro']) ?>
            </div>
        <?php endif; ?>

        <?php if (empty($conteudos)): ?>
            <div class="alerta alerta-info">
                📭 Nenhum conteúdo cadastrado ainda. <a href="novo.php">Criar o primeiro!</a>
            </div>
        <?php else: ?>

        <table class="tabela-admin">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estrutura</th>
                    <th>Tipo</th>
                    <th>Título</th>
                    <th>Ordem</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($conteudos as $item): ?>
                <tr>
                    <td style="color:var(--cor-texto-suave)">#<?= $item['id'] ?></td>
                    <td>
                        <?php
                        $badge = ['tad' => 'badge-verde', 'lista_simples' => 'badge-azul', 'lista_dupla' => 'badge-roxo'];
                        $label = ['tad' => 'TAD', 'lista_simples' => 'Lista Simples', 'lista_dupla' => 'Lista Dupla'];
                        $cls   = $badge[$item['estrutura']] ?? 'badge-azul';
                        $lbl   = $label[$item['estrutura']] ?? $item['estrutura'];
                        ?>
                        <span class="pagina-badge <?= $cls ?>" style="font-size:0.75rem;">
                            <?= $lbl ?>
                        </span>
                    </td>
                    <td style="font-family:var(--fonte-codigo);font-size:0.8rem;color:var(--cor-texto-suave)">
                        <?= htmlspecialchars($item['tipo']) ?>
                    </td>
                    <td><?= htmlspecialchars($item['titulo']) ?></td>
                    <td style="text-align:center"><?= $item['ordem'] ?></td>
                    <td>
                        <div class="acoes">
                            <a href="editar.php?id=<?= $item['id'] ?>" class="btn-editar">Editar</a>
                            <a href="excluir.php?id=<?= $item['id'] ?>"
                               class="btn-excluir btn-confirmar-excluir">Excluir</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="margin-top:12px;font-size:0.85rem;color:var(--cor-texto-suave)">
            Total: <?= count($conteudos) ?> conteúdo(s)
        </p>
        <?php endif; ?>
    </div>

</div>

<?php require_once '../includes/footer.php'; ?>
