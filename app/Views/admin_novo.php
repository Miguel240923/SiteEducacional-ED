

<div class="admin-layout">
    <aside class="admin-sidebar">
        <h4>Menu</h4>
        <a href="painel.php">📋 Conteúdos</a>
        <a href="novo.php" class="ativo">➕ Novo Conteúdo</a>
        <a href="logout.php">🚪 Sair</a>
    </aside>

    <div class="admin-conteudo">
        <div class="admin-titulo">
            <span>➕ Novo Conteúdo</span>
            <a href="painel.php" class="btn-secundario" style="font-size:0.85rem;padding:8px 16px;">← Voltar</a>
        </div>

        <?php if ($erro): ?>
            <div class="alerta alerta-erro">❌ <?= $erro ?></div>
        <?php endif; ?>

        <form method="POST" action=""><?=campoCsrf()?>
            <div class="form-linha">
                <div class="form-grupo">
                    <label>Estrutura *</label>
                    <select name="estrutura" required>
                        <option value="">Selecione...</option>
                        <option value="tad"          <?= ($_POST['estrutura'] ?? '') === 'tad'          ? 'selected' : '' ?>>TAD</option>
                        <option value="lista_simples" <?= ($_POST['estrutura'] ?? '') === 'lista_simples' ? 'selected' : '' ?>>Lista Simples</option>
                        <option value="lista_dupla"  <?= ($_POST['estrutura'] ?? '') === 'lista_dupla'  ? 'selected' : '' ?>>Lista Dupla</option>
                        <option value="fila_fifo">Fila Encadeada FIFO</option><option value="fila_prioridade">Fila de Prioridades</option><option value="pilha">Pilha Encadeada</option>
                    </select>
                </div>
                <div class="form-grupo">
                    <label>Tipo de conteúdo</label>
                    <select name="tipo">
                        <option value="teoria">Teoria</option>
                        <option value="exemplo">Exemplo prático</option>
                        <option value="codigo">Código</option>
                        <option value="dica">Dica/Destaque</option>
                        <option value="exercicio">Exercício</option>
                    </select>
                </div>
            </div>

            <div class="form-linha">
                <div class="form-grupo">
                    <label>Título *</label>
                    <input type="text" name="titulo" value="<?= htmlspecialchars($titulo_form) ?>"
                           placeholder="Ex: O que é um nó?" required>
                </div>
                <div class="form-grupo">
                    <label>Ordem de exibição</label>
                    <input type="number" name="ordem" value="<?= $_POST['ordem'] ?? 1 ?>" min="1" max="999">
                    <div class="dica">Menor número aparece primeiro</div>
                </div>
            </div>

            <div class="form-grupo">
                <label>Conteúdo * <span style="font-weight:400;color:var(--cor-texto-suave)">(HTML básico permitido)</span></label>
                <textarea name="conteudo" rows="15" placeholder="Escreva o conteúdo aqui. Você pode usar HTML básico como &lt;p&gt;, &lt;strong&gt;, &lt;ul&gt;, &lt;code&gt;, etc."><?= htmlspecialchars($_POST['conteudo'] ?? '') ?></textarea>
                <div class="dica">
                    Dicas: &lt;p&gt; parágrafo | &lt;strong&gt; negrito | &lt;code&gt; código inline |
                    &lt;ul&gt;&lt;li&gt; lista | &lt;pre&gt;&lt;code&gt; bloco de código
                </div>
            </div>

            <div style="display:flex;gap:12px;">
                <button type="submit" class="btn-primario">Salvar Conteúdo</button>
                <a href="painel.php" class="btn-secundario">Cancelar</a>
            </div>
        </form>
    </div>
</div>


