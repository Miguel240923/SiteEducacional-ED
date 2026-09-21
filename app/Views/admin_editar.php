

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

        <form method="POST" action=""><?=campoCsrf()?>
            <div class="form-linha">
                <div class="form-grupo">
                    <label>Estrutura *</label>
                    <select name="estrutura" required>
                        <option value="tad"          <?= $dados['estrutura'] === 'tad'          ? 'selected' : '' ?>>TAD</option>
                        <option value="lista_simples" <?= $dados['estrutura'] === 'lista_simples' ? 'selected' : '' ?>>Lista Simples</option>
                        <option value="lista_dupla"  <?= $dados['estrutura'] === 'lista_dupla'  ? 'selected' : '' ?>>Lista Dupla</option>
                    <?php foreach(['fila_fifo'=>'Fila FIFO','fila_prioridade'=>'Fila de prioridades','pilha'=>'Pilha'] as $slug=>$nome):?><option value="<?=$slug?>" <?=$dados['estrutura']===$slug?'selected':''?>><?=$nome?></option><?php endforeach;?></select>
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
                <button type="submit" formaction="excluir.php" name="id" value="<?=$id?>" class="btn-excluir btn-confirmar-excluir" formnovalidate>Excluir</button>
            </div>
        </form>
    </div>
</div>


