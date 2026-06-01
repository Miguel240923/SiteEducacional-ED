<?php
require_once 'includes/config.php';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true) {
    header('Location: area-usuario.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = limpar($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $erro = 'Preencha e-mail e senha.';
    } else {
        $conexao = conectar();
        $stmt = $conexao->prepare('SELECT id, nome, email, senha FROM usuarios WHERE email = ? AND ativo = 1 LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        $usuario = $resultado->fetch_assoc();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            header('Location: area-usuario.php');
            exit;
        }

        $erro = 'E-mail ou senha incorretos.';
        $stmt->close();
        $conexao->close();
    }
}

$titulo = 'Login do Usuário';
$basePath = './';
require_once 'includes/header.php';
?>

<div class="container">
    <div class="login-box">
        <h2>👤 Login do Usuário</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Entre para acessar sua área de estudos.
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-grupo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" placeholder="seuemail@exemplo.com" required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-primario" style="width:100%;justify-content:center;">Entrar →</button>
        </form>

        <p style="text-align:center;margin-top:20px;">
            <a href="cadastro-usuario.php" style="font-size:0.85rem;">Criar uma conta</a>
        </p>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
