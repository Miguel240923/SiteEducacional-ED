<?php
require_once 'includes/config.php';

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = limpar($_POST['nome'] ?? '');
    $email = limpar($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar = $_POST['confirmar'] ?? '';

    if (empty($nome) || empty($email) || empty($senha)) {
        $erro = 'Preencha todos os campos.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erro = 'Digite um e-mail válido.';
    } elseif (strlen($senha) < 6) {
        $erro = 'A senha precisa ter pelo menos 6 caracteres.';
    } elseif ($senha !== $confirmar) {
        $erro = 'As senhas não conferem.';
    } else {
        $hash = password_hash($senha, PASSWORD_DEFAULT);
        $conexao = conectar();
        $stmt = $conexao->prepare('INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)');
        $stmt->bind_param('sss', $nome, $email, $hash);

        if ($stmt->execute()) {
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $stmt->insert_id;
            $_SESSION['usuario_nome'] = $nome;
            $_SESSION['usuario_email'] = $email;
            header('Location: area-usuario.php');
            exit;
        } else {
            $erro = $conexao->errno === 1062 ? 'Esse e-mail já está cadastrado.' : 'Erro ao cadastrar: ' . $conexao->error;
        }

        $stmt->close();
        $conexao->close();
    }
}

$titulo = 'Cadastro do Usuário';
$basePath = './';
require_once 'includes/header.php';
?>

<div class="container">
    <div class="login-box">
        <h2>✨ Criar Conta</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Cadastre-se para acessar sua área de estudos.
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-grupo">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" required>
            </div>
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" required>
            </div>
            <div class="form-grupo">
                <label for="confirmar">Confirmar senha</label>
                <input type="password" id="confirmar" name="confirmar" required>
            </div>
            <button type="submit" class="btn-primario" style="width:100%;justify-content:center;">Cadastrar →</button>
        </form>

        <p style="text-align:center;margin-top:20px;">
            <a href="login-usuario.php" style="font-size:0.85rem;">Já tenho conta</a>
        </p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
