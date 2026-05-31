</main>

<footer class="rodape">
    <div class="container">
        <div class="rodape-grid">
            <div>
                <h4><span class="logo-icone">{ }</span> <?= SITE_NOME ?></h4>
                <p>Um ambiente de ensino simples e direto para aprender Estruturas de Dados do zero.</p>
            </div>
            <div>
                <h4>Conteúdos</h4>
                <ul>
                    <li><a href="<?= $basePath ?? '../' ?>pages/tad.php">TAD — Tipo Abstrato de Dados</a></li>
                    <li><a href="<?= $basePath ?? '../' ?>pages/lista-simples.php">Lista Simplesmente Encadeada</a></li>
                    <li><a href="<?= $basePath ?? '../' ?>pages/lista-dupla.php">Lista Duplamente Encadeada</a></li>
                </ul>
            </div>
            <div>
                <h4>Sobre o Projeto</h4>
                <p>Desenvolvido com PHP + MySQL + HTML/CSS puro. Sem frameworks pesados, só o essencial pra funcionar bem.</p>
                <p style="margin-top:8px;font-size:0.8rem;color:#aaa;">v<?= SITE_VERSAO ?></p>
            </div>
        </div>
        <div class="rodape-base">
            <p>&copy; <?= date('Y') ?> <?= SITE_NOME ?> — Projeto educacional de código aberto</p>
        </div>
    </div>
</footer>

<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
<script src="<?= $basePath ?? '../' ?>assets/js/app.js"></script>
</body>
</html>
