<?php
require_once '../includes/config.php';
verificarAdmin();

$id       = (int)($_GET['id'] ?? 0);
$conexao  = conectar();
$erro     = '';

if ($id <= 0) {
    header('Location: painel.php?erro=ID inválido');
    exit;
}

// busca o conteúdo
$stmt = $conexao->prepare("SELECT * FROM conteudos WHERE id = ?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res  = $stmt->get_result();
$item = $res->fetch_assoc();

if (!$item) {
    header('Location: painel.php?erro=Conteúdo não encontrado');
    exit;
}

// salva as edições
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $estrutura = limpar($_POST['estrutura'] ?? '');
    $tipo      = limpar($_POST['tipo']      ?? '');
    $titulo    = limpar($_POST['titulo']    ?? '');
    $conteudo  = $_POST['conteudo'] ?? '';
    $ordem     = (int)($_POST['ordem']      ?? 0);

    if (empty($estrutura) || empty($titulo) || empty($conteudo)) {
        $erro = 'Preenche todos os campos obrigatórios.';
    } else {
        $stmt2 = $conexao->prepare(
            "UPDATE conteudos SET estrutura=?, tipo=?, titulo=?, conteudo=?, ordem=? WHERE id=?"
        );
        $stmt2->bind_param('ssssii', $estrutura, $tipo, $titulo, $conteudo, $ordem, $id);

        if ($stmt2->execute()) {
            $conexao->close();
            header('Location: painel.php?msg=Conteúdo atualizado!');
            exit;
        } else {
            $erro = 'Erro ao atualizar: ' . $conexao->error;
        }
    }
}

$conexao->close();

$titulo_pag = 'Editar Conteúdo';
$basePath   = '../';
require_once '../includes/header.php';

// usa os dados do POST se houve erro, senão usa os do banco
$dados = $_SERVER['REQUEST_METHOD'] === 'POST' ? $_POST : $item;
?>

<div class="admin-layout">
    <aside class="admin-sidebar">
        <h4>Menu</h4>
        <a href="painel.php">📋 Conteúdos</a>
        <a href="novo.php">➕ Novo Conteúdo</a>
        <a href="logout.php">🚪 Sair</a>
    </aside>

    <div class="admin-conteudo">
        <div class="admin-titulo">
            <span>✏️ Editando: <?= htmlspecialchars($item['titulo']) ?></span>
            <a href="painel.php" class="btn-secundario" style="font-size:0.85rem;padding:8px 16px;">← Voltar</a>
        </div>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-linha">
                <div class="form-grupo">
                    <label>Estrutura *</label>
                    <select name="estrutura" required>
                        <option value="tad"          <?= $dados['estrutura'] === 'tad'          ? 'selected' : '' ?>>TAD</option>
                        <option value="lista_simples" <?= $dados['estrutura'] === 'lista_simples' ? 'selected' : '' ?>>Lista Simples</option>
                        <option value="lista_dupla"  <?= $dados['estrutura'] === 'lista_dupla'  ? 'selected' : '' ?>>Lista Dupla</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <label>Tipo de conteúdo</label>
                    <select name="tipo">
                        <?php foreach (['teoria','exemplo','codigo','dica','exercicio'] as $t): ?>
                        <option value="<?= $t ?>" <?= $dados['tipo'] === $t ? 'selected' : '' ?>>
                            <?= ucfirst($t) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-linha">
                <div class="form-grupo">
                    <label>Título *</label>
                    <input type="text" name="titulo" value="<?= htmlspecialchars($dados['titulo']) ?>" required>
                </div>
                <div class="form-grupo">
                    <label>Ordem</label>
                    <input type="number" name="ordem" value="<?= $dados['ordem'] ?>" min="1" max="999">
                </div>
            </div>

            <div class="form-grupo">
                <label>Conteúdo *</label>
                <textarea name="conteudo" rows="18"><?= htmlspecialchars($dados['conteudo']) ?></textarea>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn-primario">Salvar Alterações</button>
                <a href="painel.php" class="btn-secundario">Cancelar</a>
                <a href="excluir.php?id=<?= $id ?>" class="btn-excluir btn-confirmar-excluir"
                   style="padding:8px 16px;border-radius:var(--raio);font-size:0.9rem;">
                    Excluir
                </a>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
