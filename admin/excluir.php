<?php
// excluir.php
require_once '../includes/config.php';
verificarAdmin();

$id      = (int)($_GET['id'] ?? 0);
$conexao = conectar();

if ($id > 0) {
    $stmt = $conexao->prepare("DELETE FROM conteudos WHERE id = ?");
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $conexao->close();
        header('Location: painel.php?msg=Conteúdo excluído com sucesso!');
        exit;
    }
}

$conexao->close();
header('Location: painel.php?erro=Erro ao excluir ou ID inválido.');
exit;
