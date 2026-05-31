<?php
require_once '../includes/config.php';

// se já tiver logado, vai pro painel
if (isset($_SESSION['admin_logado']) && $_SESSION['admin_logado'] === true) {
    header('Location: painel.php');
    exit;
}

$erro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = limpar($_POST['usuario'] ?? '');
    $senha   = $_POST['senha'] ?? '';

    // usuário e senha padrão — mude isso em produção!
    // em um sistema real, você buscaria do banco e compararia o hash
    if ($usuario === 'admin' && $senha === 'admin123') {
        $_SESSION['admin_logado'] = true;
        $_SESSION['admin_usuario'] = $usuario;
        header('Location: painel.php');
        exit;
    } else {
        $erro = 'Usuário ou senha incorretos.';
    }
}

$titulo   = 'Login Admin';
$basePath = '../';
require_once '../includes/header.php';
?>

<div class="container">
    <div class="login-box">
        <h2>⚙ Área Administrativa</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Faça login pra gerenciar os conteúdos
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <div class="alerta alerta-info">
            🔑 Credenciais padrão: <strong>admin</strong> / <strong>admin123</strong>
        </div>

        <form method="POST" action="">
            <div class="form-grupo">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="admin" required>
            </div>
            <div class="form-grupo">
                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn-primario" style="width:100%;justify-content:center;">
                Entrar →
            </button>
        </form>

        <p style="text-align:center;margin-top:20px;">
            <a href="../index.php" style="font-size:0.85rem;color:var(--cor-texto-suave);">← Voltar ao site</a>
        </p>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>
