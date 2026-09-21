

<div class="container">
    <div class="login-box">
        <h2>✨ Criar Conta</h2>
        <p style="text-align:center;color:var(--cor-texto-suave);font-size:0.9rem;margin-bottom:24px;">
            Cadastre-se para acessar sua área de estudos.
        </p>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action=""><?=campoCsrf()?>
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


