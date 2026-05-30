<?php
require_once '../includes/config.php';
$titulo   = 'Lista Simplesmente Encadeada';
$basePath = '../';
require_once '../includes/header.php';
?>

<div class="pagina-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="../index.php">Início</a> /
            <span>Lista Simplesmente Encadeada</span>
        </div>
        <span class="pagina-badge badge-azul">Nível: Intermediário</span>
        <h1>Lista Simplesmente Encadeada</h1>
        <p>Entenda como funciona essa estrutura clássica, o que é um nó, como a lista se encadeia e como fazer todas as operações.</p>
    </div>
</div>

<div class="container">
<div class="pagina-layout">

<aside class="sidebar">
    <h4>Nesta página</h4>
    <ul>
        <li><a href="#o-que-e">O que é?</a></li>
        <li><a href="#no">O que é um Nó?</a></li>
        <li><a href="#como-funciona">Como se encadeia</a></li>
        <li><a href="#operacoes">Operações</a></li>
        <li><a href="#insercao">Inserção</a></li>
        <li><a href="#remocao">Remoção</a></li>
        <li><a href="#busca">Busca</a></li>
        <li><a href="#codigo">Código completo C#</a></li>
        <li><a href="#video">Vídeo</a></li>
        <li><a href="#resumo">Resumo</a></li>
    </ul>
</aside>

<div class="conteudo">

<section class="secao" id="o-que-e">
    <h2><span class="num">1</span> O que é uma Lista Simplesmente Encadeada?</h2>

    <p>
        Antes de falar de lista encadeada, pensa no que você já conhece: o <strong>array</strong>.
        Um array é uma sequência de elementos guardados em posições de memória <em>contíguas</em>,
        ou seja, um do lado do outro na memória.
    </p>
    <p>
        O problema do array é que ele tem tamanho fixo, e inserir ou remover elementos no meio é
        custoso porque você precisa deslocar todos os outros elementos.
    </p>

    <div class="destaque-amarelo destaque">
        <strong>Problema do array:</strong>
        Em um array de 1000 elementos, inserir na posição 1 exige mover os outros 999 elementos.
        Isso é O(n) — o custo cresce com o tamanho da lista.
    </div>

    <p>
        A <strong>Lista Encadeada</strong> resolve isso. Em vez de guardar os elementos todos juntos
        na memória, cada elemento fica em qualquer lugar da memória e carrega uma <em>referência</em>
        que aponta pro próximo elemento.
    </p>

    <div class="destaque">
        <strong>Definição:</strong>
        Uma Lista Simplesmente Encadeada é uma coleção de elementos chamados de <strong>nós</strong>,
        onde cada nó guarda um valor e uma <em>referência</em> para o próximo nó da lista.
        O último nó aponta para <code>null</code>, indicando o fim da lista.
    </div>
</section>

<section class="secao" id="no">
    <h2><span class="num">2</span> O que é um Nó?</h2>

    <p>
        O <strong>nó</strong> (em inglês: <em>node</em>) é a unidade básica da lista encadeada.
        Cada nó tem exatamente duas coisas:
    </p>

    <table class="tabela">
        <thead>
            <tr><th>Parte do Nó</th><th>O que é</th><th>Analogia</th></tr>
        </thead>
        <tbody>
            <tr>
                <td><code>dado</code> / <code>valor</code></td>
                <td>O valor que o nó guarda (int, string, objeto...)</td>
                <td>O conteúdo de uma caixa</td>
            </tr>
            <tr>
                <td><code>proximo</code> / <code>next</code></td>
                <td>Referência para o próximo nó da lista</td>
                <td>Uma seta apontando para a próxima caixa</td>
            </tr>
        </tbody>
    </table>

    <div class="diagrama">
        <p style="color:var(--cor-texto-suave);font-size:0.85rem;margin-bottom:16px;">Estrutura de um Nó:</p>
        <div style="display:inline-flex;border:2px solid var(--cor-primaria);border-radius:var(--raio);overflow:hidden;font-family:var(--fonte-codigo);font-size:0.9rem;">
            <div style="padding:16px 20px;background:rgba(79,142,247,0.15);text-align:center;">
                <div style="color:var(--cor-texto-suave);font-size:0.75rem;margin-bottom:4px;">DADO</div>
                <div style="color:var(--cor-primaria);font-weight:700;font-size:1.2rem;">42</div>
            </div>
            <div style="width:1px;background:var(--cor-borda);"></div>
            <div style="padding:16px 20px;background:rgba(62,207,142,0.08);text-align:center;">
                <div style="color:var(--cor-texto-suave);font-size:0.75rem;margin-bottom:4px;">PRÓXIMO</div>
                <div style="color:var(--cor-verde);font-weight:700;">→ 0x1A4F</div>
            </div>
        </div>
        <p style="color:var(--cor-texto-suave);font-size:0.8rem;margin-top:12px;">O nó guarda o valor 42 e o endereço de memória (0x1A4F) onde fica o próximo nó</p>
    </div>
</section>

<section class="secao" id="como-funciona">
    <h2><span class="num">3</span> Como a lista se encadeia</h2>

    <p>
        Pensa numa corrente. Cada elo está ligado ao próximo. Para chegar no quinto elo,
        você passa pelo primeiro, segundo, terceiro, quarto. Não tem atalho.
        Essa é a lógica da lista encadeada.
    </p>

    <div class="diagrama">
        <p style="color:var(--cor-texto-suave);font-size:0.85rem;margin-bottom:20px;">Lista com 4 nós:</p>
        <div class="nos-lista">
            <div style="text-align:center">
                <div style="font-size:0.7rem;color:var(--cor-amarelo);margin-bottom:4px;">HEAD (cabeça)</div>
                <div class="no-box">
                    <span class="no-valor">10</span>
                    <span class="no-prox">próx ↓</span>
                </div>
            </div>
            <span class="no-seta">→</span>
            <div class="no-box">
                <span class="no-valor">20</span>
                <span class="no-prox">próx ↓</span>
            </div>
            <span class="no-seta">→</span>
            <div class="no-box">
                <span class="no-valor">30</span>
                <span class="no-prox">próx ↓</span>
            </div>
            <span class="no-seta">→</span>
            <div class="no-box">
                <span class="no-valor">40</span>
                <span class="no-prox">próx ↓</span>
            </div>
            <span class="no-seta">→</span>
            <div class="no-nulo">null</div>
        </div>
        <p style="color:var(--cor-texto-suave);font-size:0.8rem;margin-top:16px;">
            HEAD aponta pro primeiro nó. Cada nó aponta pro próximo. O último aponta pra <strong style="color:var(--cor-vermelho)">null</strong>.
        </p>
    </div>

    <div class="destaque">
        <strong>O ponteiro HEAD:</strong>
        A lista guarda apenas o ponteiro <code>head</code> (cabeça), que aponta pro primeiro nó.
        A partir daí, você percorre a lista seguindo as referências "próximo" de cada nó.
        Se <code>head == null</code>, a lista está vazia.
    </div>
</section>

<section class="secao" id="operacoes">
    <h2><span class="num">4</span> Operações da Lista</h2>

    <table class="tabela">
        <thead>
            <tr>
                <th>Operação</th>
                <th>Complexidade</th>
                <th>O que faz</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Inserir no início</td><td><strong style="color:var(--cor-verde)">O(1)</strong></td><td>Cria nó, aponta pra HEAD, HEAD passa a ser o novo nó.</td></tr>
            <tr><td>Inserir no fim</td><td><strong style="color:var(--cor-amarelo)">O(n)</strong></td><td>Precisa percorrer a lista inteira pra achar o último nó.</td></tr>
            <tr><td>Inserir no meio</td><td><strong style="color:var(--cor-amarelo)">O(n)</strong></td><td>Percorre até a posição e ajusta os ponteiros.</td></tr>
            <tr><td>Remover do início</td><td><strong style="color:var(--cor-verde)">O(1)</strong></td><td>HEAD passa a apontar pro segundo nó.</td></tr>
            <tr><td>Remover do fim/meio</td><td><strong style="color:var(--cor-amarelo)">O(n)</strong></td><td>Percorre até o nó anterior ao que vai ser removido.</td></tr>
            <tr><td>Busca</td><td><strong style="color:var(--cor-amarelo)">O(n)</strong></td><td>No pior caso, percorre a lista inteira.</td></tr>
            <tr><td>Acesso por índice</td><td><strong style="color:var(--cor-amarelo)">O(n)</strong></td><td>Não há índice direto, é necessário percorrer.</td></tr>
        </tbody>
    </table>

    <div class="destaque-amarelo destaque">
        <strong>Comparando com array:</strong>
        O array acessa qualquer elemento em O(1) pelo índice. A lista encadeada não tem essa vantagem.
        Mas a lista é muito melhor para inserir e remover no início — O(1) contra O(n) do array.
        Cada estrutura tem seu caso de uso.
    </div>
</section>

<section class="secao" id="insercao">
    <h2><span class="num">5</span> Como funciona a Inserção</h2>

    <h3>Inserir no início — O(1)</h3>
    <div class="diagrama">
        <p style="font-size:0.85rem;color:var(--cor-texto-suave);margin-bottom:16px;">Antes da inserção do nó com valor 5:</p>
        <div class="nos-lista" style="justify-content:center;">
            <span style="font-size:0.7rem;color:var(--cor-amarelo);margin-right:4px;">HEAD→</span>
            <div class="no-box"><span class="no-valor">10</span><span class="no-prox">próx</span></div>
            <span class="no-seta">→</span>
            <div class="no-box"><span class="no-valor">20</span><span class="no-prox">próx</span></div>
            <span class="no-seta">→</span>
            <div class="no-nulo">null</div>
        </div>
        <div style="margin:12px 0;font-size:1.5rem;">↓</div>
        <p style="font-size:0.85rem;color:var(--cor-verde);margin-bottom:16px;">Depois da inserção (5 virou o novo HEAD):</p>
        <div class="nos-lista" style="justify-content:center;">
            <span style="font-size:0.7rem;color:var(--cor-amarelo);margin-right:4px;">HEAD→</span>
            <div class="no-box" style="border-color:var(--cor-verde)"><span class="no-valor" style="color:var(--cor-verde)">5</span><span class="no-prox">próx</span></div>
            <span class="no-seta">→</span>
            <div class="no-box"><span class="no-valor">10</span><span class="no-prox">próx</span></div>
            <span class="no-seta">→</span>
            <div class="no-box"><span class="no-valor">20</span><span class="no-prox">próx</span></div>
            <span class="no-seta">→</span>
            <div class="no-nulo">null</div>
        </div>
    </div>

    <h3>Passo a passo:</h3>
    <ol>
        <li>Cria um novo nó com o valor desejado</li>
        <li>O ponteiro <code>proximo</code> do novo nó aponta pra quem era o HEAD</li>
        <li>HEAD passa a apontar pro novo nó</li>
        <li>Pronto — 3 passos, independente do tamanho da lista</li>
    </ol>
</section>

<section class="secao" id="remocao">
    <h2><span class="num">6</span> Como funciona a Remoção</h2>

    <p>
        Para remover um nó, você precisa do <strong>nó anterior</strong> a ele.
        É o ponteiro desse nó anterior que precisa ser ajustado para "pular" o nó removido.
    </p>

    <h3>Remoção do início — O(1)</h3>
    <ol>
        <li>HEAD passa a apontar pro segundo nó (<code>head = head.proximo</code>)</li>
        <li>O nó removido fica sem referências e o garbage collector cuida do resto</li>
    </ol>

    <h3>Remoção do meio — O(n)</h3>
    <ol>
        <li>Percorre a lista até achar o nó <em>anterior</em> ao que vai ser removido</li>
        <li>O ponteiro do nó anterior passa a apontar pro nó <em>depois</em> do removido</li>
        <li>O nó removido fica sem referências</li>
    </ol>

    <div class="destaque-vermelho destaque">
        <strong>Erro comum:</strong>
        Avançar na lista com <code>atual = atual.proximo</code> sem guardar quem veio antes.
        Se você perde a referência do nó anterior, não consegue mais ajustar o ponteiro
        necessário para a remoção.
    </div>
</section>

<section class="secao" id="busca">
    <h2><span class="num">7</span> Como funciona a Busca</h2>

    <p>
        Para buscar um elemento, você começa do HEAD e avança nó a nó
        até encontrar o que procura ou chegar no <code>null</code>.
    </p>

    <div class="destaque">
        <strong>Busca linear — O(n):</strong>
        No pior caso (elemento não existe ou está no fim), você percorre a lista inteira.
        Diferente de um array ordenado com busca binária, aqui não há como pular elementos
        porque não existe índice direto.
    </div>
</section>

<section class="secao" id="codigo">
    <h2><span class="num">8</span> Código completo em C#</h2>

    <div class="bloco-codigo">
        <div class="bloco-codigo-header">
            <span>Lista Simplesmente Encadeada — C# completo</span>
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="lang-badge">C#</span>
                <button class="btn-copiar">Copiar</button>
            </div>
        </div>
        <pre><code class="language-csharp">// ==========================================
// Classe do Nó
// ==========================================

public class No
{
    public int Dado;
    public No Proximo;

    public No(int valor)
    {
        Dado     = valor;
        Proximo  = null; // em C#, campos de referência já são null por padrão,
                         // mas deixar explícito torna a intenção mais clara
    }
}

// ==========================================
// Classe da Lista
// ==========================================

public class ListaSimples
{
    private No cabeca;

    public ListaSimples()
    {
        cabeca = null;
    }

    public bool EstaVazia()
    {
        return cabeca == null;
    }

    // Inserir no início — O(1)
    public void InserirInicio(int valor)
    {
        No novoNo = new No(valor);
        novoNo.Proximo = cabeca; // novo nó aponta pra quem era o primeiro
        cabeca = novoNo;         // agora o novo nó é o primeiro
    }

    // Inserir no fim — O(n)
    public void InserirFim(int valor)
    {
        No novoNo = new No(valor);

        if (EstaVazia())
        {
            cabeca = novoNo;
            return;
        }

        // percorre até o último nó
        No atual = cabeca;
        while (atual.Proximo != null)
            atual = atual.Proximo;

        atual.Proximo = novoNo;
    }

    // Remover do início — O(1)
    public bool RemoverInicio()
    {
        if (EstaVazia())
        {
            Console.WriteLine("A lista está vazia.");
            return false;
        }

        cabeca = cabeca.Proximo;
        return true;
    }

    // Remover por valor — O(n)
    public bool Remover(int valor)
    {
        if (EstaVazia()) return false;

        // caso especial: o valor está na cabeça
        if (cabeca.Dado == valor)
        {
            cabeca = cabeca.Proximo;
            return true;
        }

        // percorre guardando o nó anterior para poder ajustar o ponteiro
        No anterior = cabeca;
        No atual    = cabeca.Proximo;

        while (atual != null)
        {
            if (atual.Dado == valor)
            {
                // o anterior "pula" o nó atual, ligando direto ao próximo
                anterior.Proximo = atual.Proximo;
                return true;
            }

            anterior = atual;
            atual    = atual.Proximo;
        }

        return false; // valor não encontrado
    }

    // Busca — O(n)
    public bool Buscar(int valor)
    {
        No atual = cabeca;

        while (atual != null)
        {
            if (atual.Dado == valor)
                return true;

            atual = atual.Proximo;
        }

        return false;
    }

    // Tamanho — O(n)
    public int Tamanho()
    {
        int contador = 0;
        No atual = cabeca;

        while (atual != null)
        {
            contador++;
            atual = atual.Proximo;
        }

        return contador;
    }

    // Imprime a lista no formato: 10 → 20 → 30 → null
    public void Imprimir()
    {
        if (EstaVazia())
        {
            Console.WriteLine("[lista vazia]");
            return;
        }

        No atual = cabeca;

        while (atual != null)
        {
            Console.Write(atual.Dado);
            if (atual.Proximo != null)
                Console.Write(" → ");
            atual = atual.Proximo;
        }

        Console.WriteLine(" → null");
    }
}

// ==========================================
// Exemplo de uso
// ==========================================

class Programa
{
    static void Main()
    {
        ListaSimples lista = new ListaSimples();

        lista.InserirFim(10);
        lista.InserirFim(20);
        lista.InserirFim(30);
        lista.InserirInicio(5);

        Console.Write("Lista: ");
        lista.Imprimir();
        // 5 → 10 → 20 → 30 → null

        Console.WriteLine("Tamanho: " + lista.Tamanho()); // 4

        Console.WriteLine("Tem o 20? " + lista.Buscar(20)); // True
        Console.WriteLine("Tem o 99? " + lista.Buscar(99)); // False

        lista.Remover(20);
        Console.Write("Após remover 20: ");
        lista.Imprimir();
        // 5 → 10 → 30 → null

        lista.RemoverInicio();
        Console.Write("Após remover do início: ");
        lista.Imprimir();
        // 10 → 30 → null
    }
}</code></pre>
    </div>
</section>

<iframe
    width="100%"
    height="500"
    src="https://www.youtube.com/embed/ZRJXgZsqnIs"
    title="Lista Simplesmente Encadeada"
    frameborder="0"
    allowfullscreen>
</iframe>

<section class="secao" id="resumo">
    <h2><span class="num">10</span> Resumo</h2>
    <div class="destaque-verde destaque">
        <strong>Pontos principais:</strong>
        <ul style="margin-top:8px;padding-left:16px;">
            <li>Lista encadeada resolve o problema de tamanho fixo do array</li>
            <li>Cada <strong>nó</strong> tem um valor e uma referência pro próximo</li>
            <li>A lista é acessada via ponteiro <strong>HEAD</strong></li>
            <li>Inserção no início é <strong>O(1)</strong></li>
            <li>Busca e acesso por posição são <strong>O(n)</strong></li>
            <li>Para remover do meio, é necessário guardar o nó <strong>anterior</strong></li>
            <li>O fim da lista é marcado pelo ponteiro <strong>null</strong></li>
        </ul>
    </div>

    <div style="display:flex;gap:12px;margin-top:24px;flex-wrap:wrap;">
        <a href="tad.php" class="btn-secundario">← TAD</a>
        <a href="lista-dupla.php" class="btn-primario">Próximo: Lista Dupla →</a>
    </div>
</section>

</div>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>