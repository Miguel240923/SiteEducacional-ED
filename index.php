<?php
require_once 'includes/config.php';
$titulo   = 'Início';
$basePath = './';
require_once 'includes/header.php';
?>

<section class="hero">
    <div class="container">
        <h1>Aprenda <span>Estruturas de Dados</span><br>do jeito certo</h1>
        <p>Explicações simples, exemplos reais e código comentado linha por linha. Sem enrolação, sem papo chato de livro.</p>
        <div class="hero-tags">
            <span class="tag">// TAD</span>
            <span class="tag">// Lista Simples</span>
            <span class="tag">// Lista Dupla</span>
            <span class="tag">// C#</span>
        </div>
        <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;">
            <a href="pages/tad.php" class="btn-primario">Começar agora →</a>
            <a href="#o-que-e" class="btn-secundario">O que você vai aprender</a>
        </div>
    </div>
</section>

<div class="container">


<section id="o-que-e" class="secao" style="padding-top:48px;">
    <h2><span class="num">1</span> O que são Estruturas de Dados?</h2>

    <p>
        Imagina que você tem 500 contatos no celular. Se eles tivessem todos jogados numa bagunça sem ordem nenhuma,
        cada vez que você fosse ligar pra alguém, teria que olhar um por um até achar. Ia demorar uma eternidade, né?
    </p>
    <p>
        É exatamente aí que entram as <strong>Estruturas de Dados</strong>: são formas organizadas de guardar e
        manipular informações na memória do computador, de modo que seja rápido e eficiente encontrar, inserir
        ou remover dados.
    </p>

    <div class="destaque">
        <strong>📌 Definição direta:</strong>
        Uma estrutura de dados é uma maneira de organizar dados na memória do computador de forma que eles
        possam ser acessados e modificados de forma eficiente. Cada estrutura tem suas vantagens e desvantagens
        — não existe a "melhor de todas", existe a <em>mais adequada pra cada situação</em>.
    </div>

    <h3>Por que isso importa na prática?</h3>
    <p>Veja exemplos do dia a dia que usam estruturas de dados:</p>

    <table class="tabela">
        <thead>
            <tr>
                <th>Situação Real</th>
                <th>Estrutura Usada</th>
                <th>Por quê?</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Histórico de navegação do browser</td>
                <td>Pilha (Stack)</td>
                <td>O último site que você visitou é o primeiro que aparece no "voltar"</td>
            </tr>
            <tr>
                <td>Fila do banco / call center</td>
                <td>Fila (Queue)</td>
                <td>Quem chegou primeiro, é atendido primeiro</td>
            </tr>
            <tr>
                <td>Contatos do celular</td>
                <td>Lista / Árvore</td>
                <td>Permite busca rápida por nome</td>
            </tr>
            <tr>
                <td>Mapa do Google</td>
                <td>Grafo</td>
                <td>Cada rua é uma aresta, cada cruzamento é um nó</td>
            </tr>
            <tr>
                <td>Playlist de música</td>
                <td>Lista Encadeada</td>
                <td>Fácil de inserir e remover músicas em qualquer posição</td>
            </tr>
        </tbody>
    </table>
</section>


<section class="secao">
    <h2><span class="num">2</span> O que você vai aprender aqui</h2>
    <p>Este ambiente cobre três conteúdos fundamentais de Estruturas de Dados:</p>

    <div class="cards-grid">
        <div class="card card-verde">
            <span class="card-icone">🧩</span>
            <h3>TAD — Tipo Abstrato de Dados</h3>
            <p>
                A base de tudo. Você vai entender o que é um TAD, qual a diferença entre interface e implementação,
                e por que isso é o pilar de qualquer estrutura de dados que você vai aprender.
            </p>
            <ul style="margin-top:12px;padding-left:16px;font-size:0.85rem;color:var(--cor-texto-suave)">
                <li>O que é abstração?</li>
                <li>Interface vs Implementação</li>
                <li>TAD Pilha e TAD Fila explicados</li>
                <li>Código em C# comentado</li>
            </ul>
            <a href="pages/tad.php" class="card-link">Ver conteúdo →</a>
        </div>

        <div class="card card-azul">
            <span class="card-icone">🔗</span>
            <h3>Lista Simplesmente Encadeada</h3>
            <p>
                A estrutura de dados mais clássica depois do array. Você vai entender como funciona um nó,
                como a lista se "encadeia" e como inserir, buscar e remover elementos.
            </p>
            <ul style="margin-top:12px;padding-left:16px;font-size:0.85rem;color:var(--cor-texto-suave)">
                <li>O que é um nó?</li>
                <li>Como a lista se liga</li>
                <li>Inserção no início, fim e meio</li>
                <li>Remoção e busca</li>
            </ul>
            <a href="pages/lista-simples.php" class="card-link">Ver conteúdo →</a>
        </div>

        <div class="card card-roxo">
            <span class="card-icone">⛓️</span>
            <h3>Lista Duplamente Encadeada</h3>
            <p>
                A evolução da lista simples. Cada nó agora aponta pra frente E pra trás, o que deixa certas
                operações muito mais eficientes. Veja quando usar cada uma.
            </p>
            <ul style="margin-top:12px;padding-left:16px;font-size:0.85rem;color:var(--cor-texto-suave)">
                <li>Diferença para a lista simples</li>
                <li>Ponteiro anterior e próximo</li>
                <li>Percorrimento bidirecional</li>
                <li>Comparativo prático</li>
            </ul>
            <a href="pages/lista-dupla.php" class="card-link">Ver conteúdo →</a>
        </div>
    </div>
</section>


<section class="secao">
    <h2><span class="num">3</span> Como usar este ambiente</h2>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px;">
        <div style="background:var(--cor-card);border:1px solid var(--cor-borda);border-radius:var(--raio);padding:20px;">
            <div style="font-size:1.5rem;margin-bottom:8px;">📖</div>
            <h4 style="margin-bottom:6px;">Leia a teoria</h4>
            <p style="font-size:0.85rem;color:var(--cor-texto-suave)">Cada página tem uma explicação completa escrita de forma simples, sem textão chato.</p>
        </div>
        <div style="background:var(--cor-card);border:1px solid var(--cor-borda);border-radius:var(--raio);padding:20px;">
            <div style="font-size:1.5rem;margin-bottom:8px;">🎮</div>
            <h4 style="margin-bottom:6px;">Brinque com a animação</h4>
            <p style="font-size:0.85rem;color:var(--cor-texto-suave)">Adicione e remova nós na lista interativa pra ver como ela funciona na prática.</p>
        </div>
        <div style="background:var(--cor-card);border:1px solid var(--cor-borda);border-radius:var(--raio);padding:20px;">
            <div style="font-size:1.5rem;margin-bottom:8px;">💻</div>
            <h4 style="margin-bottom:6px;">Estude o código</h4>
            <p style="font-size:0.85rem;color:var(--cor-texto-suave)">Todo código em C# é comentado linha a linha com linguagem informal pra facilitar o entendimento.</p>
        </div>
        <div style="background:var(--cor-card);border:1px solid var(--cor-borda);border-radius:var(--raio);padding:20px;">
            <div style="font-size:1.5rem;margin-bottom:8px;">🎬</div>
            <h4 style="margin-bottom:6px;">Assista os vídeos</h4>
            <p style="font-size:0.85rem;color:var(--cor-texto-suave)">Vídeos do YouTube selecionados pra complementar cada tema explicado aqui.</p>
        </div>
    </div>
</section>


<section class="secao">
    <div class="destaque-verde destaque">
        <strong>💡 Dica pra quem tá começando:</strong>
        Se você nunca viu nada de estruturas de dados, comece pelo <strong>TAD</strong>.
        Ele explica os conceitos fundamentais que você vai precisar pra entender as listas.
        Depois vá pra <strong>Lista Simples</strong> e só então pra <strong>Lista Dupla</strong>.
        Essa ordem faz muito mais sentido!
    </div>
</section>

</div>

<?php require_once 'includes/footer.php'; ?>
