<?php
require_once '../includes/config.php';
$titulo   = 'TAD — Tipo Abstrato de Dados';
$basePath = '../';
require_once '../includes/header.php';
?>

<!-- CABEÇALHO DA PÁGINA -->
<div class="pagina-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="../index.php">Início</a> /
            <span>TAD — Tipo Abstrato de Dados</span>
        </div>
        <span class="pagina-badge badge-verde">Nível: Fundamental</span>
        <h1>TAD — Tipo Abstrato de Dados</h1>
        <p>Entenda o conceito que é a base de todas as estruturas de dados.</p>
    </div>
</div>

<div class="container">
<div class="pagina-layout">

<!-- SIDEBAR -->
<aside class="sidebar">
    <h4>Nesta página</h4>
    <ul>
        <li><a href="#o-que-e">O que é TAD?</a></li>
        <li><a href="#abstracao">Abstração na prática</a></li>
        <li><a href="#interface-impl">Interface vs Implementação</a></li>
        <li><a href="#exemplo-pilha">Exemplo: TAD Pilha</a></li>
        <li><a href="#exemplo-fila">Exemplo: TAD Fila</a></li>
        <li><a href="#codigo-csharp">Código em C#</a></li>
        <li><a href="#video">Vídeo explicativo</a></li>
        <li><a href="#resumo">Resumo</a></li>
    </ul>
</aside>

<!-- CONTEÚDO -->
<div class="conteudo">

<section class="secao" id="o-que-e">
    <h2><span class="num">1</span> O que é TAD?</h2>

    <p>
        TAD significa <strong>Tipo Abstrato de Dados</strong>. Para entender o que é um TAD,
        primeiro é preciso entender o que é <em>abstração</em>.
    </p>
    <p>
        Abstração é a ideia de que você pode usar algo sem precisar saber como ele funciona por dentro.
        Você usa o controle remoto da TV sem precisar saber como ele transmite o sinal infravermelho.
        Você usa o Google Maps sem precisar entender o algoritmo que calcula a rota.
    </p>

    <div class="destaque">
        <strong>Definição:</strong>
        Um TAD é a especificação de um conjunto de dados e das operações que podem ser feitas sobre esses dados,
        <em>sem se preocupar com como isso vai ser implementado</em>. Você define o "quê", não o "como".
    </div>

    <p>
        Um TAD funciona como um <strong>contrato</strong>: ele diz quais operações aquele tipo de dado
        vai oferecer, mas quem implementa esse contrato pode fazer do jeito que quiser.
    </p>
</section>

<section class="secao" id="abstracao">
    <h2><span class="num">2</span> Abstração na prática</h2>

    <p>
        Um exemplo concreto: pensa numa <strong>conta bancária</strong>.
    </p>

    <table class="tabela">
        <thead>
            <tr>
                <th>O que o usuário vê (abstração)</th>
                <th>O que acontece por dentro (implementação)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Depositar dinheiro</td>
                <td>Atualiza registro no banco de dados, calcula juros, registra histórico...</td>
            </tr>
            <tr>
                <td>Sacar dinheiro</td>
                <td>Verifica saldo, checa limite, gera comprovante, debita da conta...</td>
            </tr>
            <tr>
                <td>Ver saldo</td>
                <td>Faz query no banco, soma transações, aplica regras de bloqueio...</td>
            </tr>
        </tbody>
    </table>

    <p>
        O cliente do banco não precisa saber de nada disso. Ele só precisa saber que pode
        <code>depositar()</code>, <code>sacar()</code> e <code>verSaldo()</code>.
        Isso é abstração. Isso é TAD.
    </p>

    <div class="destaque-amarelo destaque">
        <strong>Ponto importante:</strong>
        A abstração não é sobre esconder por preguiça. É sobre <em>separar responsabilidades</em>.
        Quem usa não precisa se preocupar com detalhes de implementação. Quem implementa não precisa
        expor cada detalhe pra quem usa.
    </div>
</section>

<section class="secao" id="interface-impl">
    <h2><span class="num">3</span> Interface vs Implementação</h2>

    <p>
        Esse é um dos conceitos mais importantes da programação. Vamos ver a diferença:
    </p>

    <div class="tabs-container">
        <div class="tabs">
            <button class="tab-btn ativo" data-tab="interface">Interface (TAD)</button>
            <button class="tab-btn" data-tab="impl1">Implementação A</button>
            <button class="tab-btn" data-tab="impl2">Implementação B</button>
        </div>

        <div class="tab-painel ativo" data-painel="interface">
            <div class="destaque">
                <strong>A interface define o "quê":</strong>
                <ul style="margin-top:8px;padding-left:16px;">
                    <li>Quais dados o tipo guarda</li>
                    <li>Quais operações existem</li>
                    <li>O que cada operação recebe e retorna</li>
                </ul>
                <p style="margin-top:8px;">Exemplo — TAD Lista:</p>
                <ul style="margin-top:4px;padding-left:16px;">
                    <li><code>inserir(valor)</code> — adiciona um elemento</li>
                    <li><code>remover(valor)</code> — remove um elemento</li>
                    <li><code>buscar(valor)</code> — retorna true/false</li>
                    <li><code>estaVazia()</code> — retorna true/false</li>
                    <li><code>tamanho()</code> — retorna o número de elementos</li>
                </ul>
            </div>
        </div>

        <div class="tab-painel" data-painel="impl1">
            <div class="destaque-verde destaque">
                <strong>Implementação A — usando Array:</strong>
                <p style="margin-top:8px;">
                    Guarda os elementos num array de tamanho fixo. Rápido para acessar por índice,
                    mas tem tamanho limitado e inserção no meio é lenta.
                </p>
                <p style="margin-top:8px;">A interface continua sendo a mesma. Quem usa não sabe que é um array por dentro.</p>
            </div>
        </div>

        <div class="tab-painel" data-painel="impl2">
            <div class="destaque" style="border-left-color:var(--cor-secundaria);background:rgba(124,92,191,0.08);">
                <strong style="color:#a07de8;">Implementação B — usando Lista Encadeada:</strong>
                <p style="margin-top:8px;">
                    Guarda os elementos em nós conectados por ponteiros. Tamanho dinâmico,
                    inserção eficiente em qualquer posição, mas acesso por índice é mais lento.
                </p>
                <p style="margin-top:8px;">A interface continua sendo a mesma. Quem usa não sabe que é lista encadeada por dentro.</p>
            </div>
        </div>
    </div>

    <p style="margin-top:16px;">
        A ideia principal é essa: você pode trocar a implementação inteira sem precisar mudar
        o código que usa a estrutura. Isso é <strong>desacoplamento</strong>.
    </p>
</section>

<section class="secao" id="exemplo-pilha">
    <h2><span class="num">4</span> Exemplo: TAD Pilha</h2>

    <p>
        A <strong>Pilha</strong> (Stack) é um dos TADs mais conhecidos. A regra é simples:
        o último elemento que entrou é o primeiro que sai. Chamamos isso de <strong>LIFO</strong>
        (Last In, First Out — último a entrar, primeiro a sair).
    </p>

    <div class="destaque">
        <strong>Analogia do mundo real:</strong>
        Uma pilha de pratos na cozinha. Você coloca um prato em cima. Quando vai pegar um,
        você pega o de cima — o último que foi colocado. Não faz sentido puxar um do fundo.
    </div>

    <h3>Operações do TAD Pilha:</h3>
    <table class="tabela">
        <thead>
            <tr><th>Operação</th><th>O que faz</th><th>Exemplo</th></tr>
        </thead>
        <tbody>
            <tr><td><code>push(x)</code></td><td>Coloca x no topo</td><td>Empilha um prato</td></tr>
            <tr><td><code>pop()</code></td><td>Remove e retorna o topo</td><td>Tira o prato de cima</td></tr>
            <tr><td><code>peek()</code></td><td>Vê o topo sem remover</td><td>Olha qual prato está em cima</td></tr>
            <tr><td><code>isEmpty()</code></td><td>Verifica se está vazia</td><td>A pilha de pratos acabou?</td></tr>
            <tr><td><code>size()</code></td><td>Quantidade de elementos</td><td>Quantos pratos tem?</td></tr>
        </tbody>
    </table>

    <h3>Onde a pilha aparece na prática:</h3>
    <ul>
        <li><strong>Ctrl+Z</strong> (desfazer) — cada ação vai pra pilha, desfazer remove do topo</li>
        <li><strong>Histórico do browser</strong> — voltar página vai ao topo da pilha</li>
        <li><strong>Chamadas de função</strong> — o processador usa pilha pra controlar o fluxo do programa</li>
        <li><strong>Verificação de parênteses</strong> — compiladores usam pilha pra verificar se <code>([])</code> está correto</li>
    </ul>
</section>

<section class="secao" id="exemplo-fila">
    <h2><span class="num">5</span> Exemplo: TAD Fila</h2>

    <p>
        A <strong>Fila</strong> (Queue) tem a regra oposta: o primeiro que entrou
        é o primeiro que sai. Chamamos de <strong>FIFO</strong> (First In, First Out).
    </p>

    <div class="destaque-verde destaque">
        <strong>Analogia do mundo real:</strong>
        Uma fila de banco. Quem chegou primeiro é atendido primeiro.
        Quem entra fica no fim da fila, quem é atendido sai do início.
    </div>

    <h3>Operações do TAD Fila:</h3>
    <table class="tabela">
        <thead>
            <tr><th>Operação</th><th>O que faz</th><th>Exemplo</th></tr>
        </thead>
        <tbody>
            <tr><td><code>enqueue(x)</code></td><td>Adiciona x no final</td><td>Entrar no final da fila</td></tr>
            <tr><td><code>dequeue()</code></td><td>Remove e retorna o início</td><td>Ser atendido e sair da fila</td></tr>
            <tr><td><code>peek()</code></td><td>Vê o primeiro sem remover</td><td>Quem é o próximo a ser atendido?</td></tr>
            <tr><td><code>isEmpty()</code></td><td>Verifica se está vazia</td><td>Tem alguém na fila?</td></tr>
        </tbody>
    </table>

    <p style="margin-top:12px;">
        Assim como a Pilha, a Fila é um TAD — define as operações, mas não diz como elas devem
        ser implementadas. Ela pode ser construída usando array ou lista encadeada, e quem a usa
        não precisa saber qual das duas está por baixo.
    </p>
</section>

<section class="secao" id="codigo-csharp">
    <h2><span class="num">6</span> Código em C#</h2>
    <p>Implementação de um TAD Pilha em C#, com comentários explicando cada parte:</p>

    <div class="bloco-codigo">
        <div class="bloco-codigo-header">
            <span>TAD Pilha — Implementação em C#</span>
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="lang-badge">C#</span>
                <button class="btn-copiar">Copiar</button>
            </div>
        </div>
        <pre><code class="language-csharp">// A INTERFACE define o contrato do TAD.
// Ela diz quais operações a pilha precisa ter,
// mas não diz nada sobre como elas vão funcionar.
public interface IPilha&lt;T&gt;
{
    void Push(T valor);   // empilha um elemento
    T Pop();              // remove e retorna o topo
    T Peek();             // consulta o topo sem remover
    bool EstaVazia();     // verifica se a pilha está vazia
    int Tamanho();        // retorna a quantidade de elementos
}

// A IMPLEMENTAÇÃO é onde a lógica de fato acontece.
// Aqui usamos um array interno para guardar os dados.
// Poderíamos ter outra implementação usando lista encadeada
// e a interface continuaria sendo exatamente a mesma.
public class PilhaArray&lt;T&gt; : IPilha&lt;T&gt;
{
    private T[] dados;
    private int topo;

    // capacidade define o tamanho máximo da pilha.
    // Para uma implementação sem limite fixo, seria necessário
    // redimensionar o array dinamicamente — mas para fins didáticos,
    // um tamanho fixo é suficiente.
    public PilhaArray(int capacidade = 100)
    {
        dados = new T[capacidade];
        topo  = -1; // -1 indica que a pilha está vazia
    }

    public void Push(T valor)
    {
        if (topo == dados.Length - 1)
            throw new InvalidOperationException("Pilha cheia.");

        topo++;
        dados[topo] = valor;
    }

    public T Pop()
    {
        if (EstaVazia())
            throw new InvalidOperationException("Pilha vazia.");

        T valorDoTopo = dados[topo];
        topo--;
        return valorDoTopo;
    }

    public T Peek()
    {
        if (EstaVazia())
            throw new InvalidOperationException("Pilha vazia.");

        // Diferente do Pop: apenas lê o topo, sem alterar o ponteiro.
        return dados[topo];
    }

    public bool EstaVazia()
    {
        return topo == -1;
    }

    public int Tamanho()
    {
        // topo + 1 porque o índice começa em zero.
        // Se topo for 0, há 1 elemento; se for 2, há 3.
        return topo + 1;
    }
}

// Exemplo de uso
class Programa
{
    static void Main()
    {
        // Note que declaramos a variável como IPilha, não PilhaArray.
        // Isso é a abstração funcionando: o código abaixo não sabe
        // (nem precisa saber) que existe um array por baixo.
        IPilha&lt;int&gt; pilha = new PilhaArray&lt;int&gt;();

        pilha.Push(10);
        pilha.Push(20);
        pilha.Push(30);

        Console.WriteLine("Tamanho: " + pilha.Tamanho()); // 3
        Console.WriteLine("Topo: "    + pilha.Peek());    // 30

        Console.WriteLine(pilha.Pop()); // 30
        Console.WriteLine(pilha.Pop()); // 20
        Console.WriteLine(pilha.Pop()); // 10

        Console.WriteLine("Vazia? " + pilha.EstaVazia()); // True
    }
}</code></pre>
    </div>

    <div class="destaque-verde destaque" style="margin-top:16px;">
        <strong>Separação de responsabilidades:</strong>
        A interface <code>IPilha</code> define o contrato sem saber nada sobre array.
        A classe <code>PilhaArray</code> implementa usando array. Poderíamos ter uma
        <code>PilhaListaEncadeada</code> com a mesma interface.
        Quem usa via <code>IPilha</code> não precisa saber qual das duas está em uso.
    </div>
</section>

<section class="secao" id="video">
    <h2><span class="num">7</span> Vídeo explicativo</h2>

    <iframe
        width="100%"
        height="500"
        src="https://www.youtube.com/embed/nX_3zUmNFFs"
        title="Vídeo explicativo"
        frameborder="0"
        allowfullscreen>
    </iframe>
</section>

<section class="secao" id="resumo">
    <h2><span class="num">8</span> Resumo</h2>

    <div class="destaque-verde destaque">
        <strong>Pontos principais do TAD:</strong>
        <ul style="margin-top:8px;padding-left:16px;">
            <li><strong>TAD = contrato</strong> — define o "quê" sem dizer o "como"</li>
            <li><strong>Abstração</strong> — usar sem precisar conhecer os detalhes internos</li>
            <li><strong>Interface</strong> — lista de operações disponíveis</li>
            <li><strong>Implementação</strong> — código real que faz funcionar</li>
            <li><strong>Pilha (LIFO)</strong> — último a entrar, primeiro a sair</li>
            <li><strong>Fila (FIFO)</strong> — primeiro a entrar, primeiro a sair</li>
            <li>Uma mesma interface pode ter <strong>várias implementações</strong> diferentes</li>
        </ul>
    </div>

    <div style="display:flex;gap:12px;margin-top:24px;flex-wrap:wrap;">
        <a href="../index.php" class="btn-secundario">← Início</a>
        <a href="lista-simples.php" class="btn-primario">Próximo: Lista Simples →</a>
    </div>
</section>

</div><!-- /conteudo -->
</div><!-- /pagina-layout -->
</div><!-- /container -->

<?php require_once '../includes/footer.php'; ?>