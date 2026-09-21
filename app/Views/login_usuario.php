

<div class="container">
    <div class="login-box">
        <h2>👤 Login do Usuário</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Entre para acessar sua área de estudos.
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action=""><?=campoCsrf()?>
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
            <a href="cadastro-usuario.php" style="font-size:0.85rem;">Criar uma conta</a> · <a href="recuperar-senha.php" style="font-size:0.85rem;">Esqueci minha senha</a>
        </p>
    </div>
</div>


