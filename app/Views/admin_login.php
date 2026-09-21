

<div class="container">
    <div class="login-box">
        <h2>⚙ Área Administrativa</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Faça login pra gerenciar os conteúdos
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <?php if(!getenv('ED_ADMIN_PASSWORD')):?><div class="alerta alerta-info">
            🔑 Credenciais padrão: <strong>admin</strong> / <strong>admin123</strong>
        </div><?php endif;?>

        <form method="POST" action=""><?=campoCsrf()?>
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


