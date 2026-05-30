<?php
require_once '../includes/config.php';
$titulo   = 'Lista Duplamente Encadeada';
$basePath = '../';
require_once '../includes/header.php';
?>

<div class="pagina-header">
    <div class="container">
        <div class="breadcrumb">
            <a href="../index.php">Início</a> /
            <span>Lista Duplamente Encadeada</span>
        </div>
        <span class="pagina-badge badge-roxo">Nível: Intermediário+</span>
        <h1>Lista Duplamente Encadeada</h1>
        <p>A evolução da lista simples. Cada nó agora aponta pra frente e pra trás, tornando certas operações muito mais eficientes.</p>
    </div>
</div>

<div class="container">
<div class="pagina-layout">

<aside class="sidebar">
    <h4>Nesta página</h4>
    <ul>
        <li><a href="#diferenca">Diferença da simples</a></li>
        <li><a href="#estrutura-no">Estrutura do nó</a></li>
        <li><a href="#operacoes">Operações</a></li>
        <li><a href="#insercao">Inserção explicada</a></li>
        <li><a href="#remocao">Remoção explicada</a></li>
        <li><a href="#comparativo">Comparativo</a></li>
        <li><a href="#codigo">Código completo C#</a></li>
        <li><a href="#video">Vídeo</a></li>
        <li><a href="#resumo">Resumo</a></li>
    </ul>
</aside>

<div class="conteudo">

<section class="secao" id="diferenca">
    <h2><span class="num">1</span> A diferença da lista simples</h2>

    <p>
        Na lista simplesmente encadeada, cada nó aponta <strong>apenas para o próximo</strong>.
        É como uma rua de mão única: você só pode seguir em frente.
    </p>
    <p>
        A <strong>Lista Duplamente Encadeada</strong> resolve isso: cada nó tem dois ponteiros,
        um pro próximo e um pro anterior. A navegação passa a ser nos dois sentidos.
    </p>

    <div class="diagrama">
        <p style="font-size:0.85rem;color:var(--cor-texto-suave);margin-bottom:16px;">Lista <strong>Simples</strong> — só vai pra frente:</p>
        <div class="nos-lista" style="justify-content:center;">
            <div class="no-box"><span class="no-valor">A</span></div>
            <span class="no-seta">→</span>
            <div class="no-box"><span class="no-valor">B</span></div>
            <span class="no-seta">→</span>
            <div class="no-box"><span class="no-valor">C</span></div>
            <span class="no-seta">→</span>
            <div class="no-nulo">null</div>
        </div>

        <div style="margin:20px 0;font-size:1.2rem;">↓</div>

        <p style="font-size:0.85rem;color:var(--cor-texto-suave);margin-bottom:16px;">Lista <strong>Dupla</strong> — vai e volta:</p>
        <div class="nos-lista" style="justify-content:center;">
            <div class="no-nulo">null</div>
            <span class="no-seta" style="color:var(--cor-secundaria)">⇄</span>
            <div class="no-box" style="border-color:var(--cor-secundaria)">
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">ant←</span>
                <span class="no-valor" style="color:var(--cor-secundaria)">A</span>
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">→próx</span>
            </div>
            <span class="no-seta" style="color:var(--cor-secundaria)">⇄</span>
            <div class="no-box" style="border-color:var(--cor-secundaria)">
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">ant←</span>
                <span class="no-valor" style="color:var(--cor-secundaria)">B</span>
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">→próx</span>
            </div>
            <span class="no-seta" style="color:var(--cor-secundaria)">⇄</span>
            <div class="no-box" style="border-color:var(--cor-secundaria)">
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">ant←</span>
                <span class="no-valor" style="color:var(--cor-secundaria)">C</span>
                <span style="font-size:0.7rem;color:var(--cor-texto-suave)">→próx</span>
            </div>
            <span class="no-seta" style="color:var(--cor-secundaria)">⇄</span>
            <div class="no-nulo">null</div>
        </div>
    </div>

    <div class="destaque">
        <strong>Diferença chave:</strong>
        Na lista dupla, a lista guarda tanto o ponteiro <code>head</code> (início) quanto o
        <code>tail</code> (fim). Isso torna a inserção e remoção no fim tão rápida
        quanto no início — <strong>O(1)</strong>.
    </div>
</section>

<section class="secao" id="estrutura-no">
    <h2><span class="num">2</span> Estrutura do Nó Duplo</h2>

    <table class="tabela">
        <thead>
            <tr><th>Parte do Nó</th><th>O que é</th><th>Lista Simples tinha?</th></tr>
        </thead>
        <tbody>
            <tr>
                <td><code>dado</code></td>
                <td>O valor armazenado</td>
                <td>Sim</td>
            </tr>
            <tr>
                <td><code>proximo</code></td>
                <td>Aponta pro nó que vem depois</td>
                <td>Sim</td>
            </tr>
            <tr>
                <td><code>anterior</code></td>
                <td>Aponta pro nó que veio antes</td>
                <td>Não — novidade da lista dupla</td>
            </tr>
        </tbody>
    </table>

    <div class="diagrama">
        <p style="color:var(--cor-texto-suave);font-size:0.85rem;margin-bottom:16px;">Estrutura de um Nó Duplo:</p>
        <div style="display:inline-flex;border:2px solid var(--cor-secundaria);border-radius:var(--raio);overflow:hidden;font-family:var(--fonte-codigo);font-size:0.85rem;">
            <div style="padding:14px 16px;background:rgba(124,92,191,0.15);text-align:center;">
                <div style="color:var(--cor-texto-suave);font-size:0.7rem;margin-bottom:4px;">ANTERIOR</div>
                <div style="color:#a07de8;font-weight:700;">← 0x8C2A</div>
            </div>
            <div style="width:1px;background:var(--cor-borda);"></div>
            <div style="padding:14px 16px;background:rgba(124,92,191,0.2);text-align:center;">
                <div style="color:var(--cor-texto-suave);font-size:0.7rem;margin-bottom:4px;">DADO</div>
                <div style="color:var(--cor-secundaria);font-weight:700;font-size:1.1rem;">42</div>
            </div>
            <div style="width:1px;background:var(--cor-borda);"></div>
            <div style="padding:14px 16px;background:rgba(124,92,191,0.15);text-align:center;">
                <div style="color:var(--cor-texto-suave);font-size:0.7rem;margin-bottom:4px;">PRÓXIMO</div>
                <div style="color:#a07de8;font-weight:700;">0x1A4F →</div>
            </div>
        </div>
        <p style="color:var(--cor-texto-suave);font-size:0.8rem;margin-top:12px;">
            Três campos: anterior (quem veio antes), dado (o valor) e próximo (quem vem depois)
        </p>
    </div>
</section>

<section class="secao" id="operacoes">
    <h2><span class="num">3</span> Operações</h2>

    <table class="tabela">
        <thead>
            <tr><th>Operação</th><th>Lista Simples</th><th>Lista Dupla</th><th>Por quê?</th></tr>
        </thead>
        <tbody>
            <tr>
                <td>Inserir no início</td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td>Ambas têm HEAD</td>
            </tr>
            <tr>
                <td>Inserir no fim</td>
                <td><strong style="color:var(--cor-amarelo)">O(n)</strong></td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td>Lista dupla tem TAIL</td>
            </tr>
            <tr>
                <td>Remover do início</td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td>Ambas têm HEAD</td>
            </tr>
            <tr>
                <td>Remover do fim</td>
                <td><strong style="color:var(--cor-amarelo)">O(n)</strong></td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td>Lista dupla tem TAIL + ponteiro anterior</td>
            </tr>
            <tr>
                <td>Remover do meio (dado o nó)</td>
                <td><strong style="color:var(--cor-amarelo)">O(n)</strong></td>
                <td><strong style="color:var(--cor-verde)">O(1)</strong></td>
                <td>O nó já conhece o anterior</td>
            </tr>
            <tr>
                <td>Busca</td>
                <td><strong style="color:var(--cor-amarelo)">O(n)</strong></td>
                <td><strong style="color:var(--cor-amarelo)">O(n)</strong></td>
                <td>Ainda precisa percorrer</td>
            </tr>
            <tr>
                <td>Percorrer ao contrário</td>
                <td><strong style="color:var(--cor-vermelho)">Impossível</strong></td>
                <td><strong style="color:var(--cor-verde)">O(n)</strong></td>
                <td>Lista dupla tem ponteiro anterior</td>
            </tr>
        </tbody>
    </table>

    <div class="destaque-verde destaque">
        <strong>O principal ganho da lista dupla:</strong>
        As operações no fim da lista viram O(1) por causa do ponteiro <code>tail</code>.
        Remover um nó específico (quando você já tem a referência dele) também vira O(1)
        porque o próprio nó sabe quem é o anterior.
    </div>
</section>

<section class="secao" id="insercao">
    <h2><span class="num">4</span> Inserção explicada</h2>

    <h3>Inserir no início — O(1)</h3>
    <ol>
        <li>Cria novo nó</li>
        <li><code>novoNo.proximo = head</code></li>
        <li><code>novoNo.anterior = null</code> (ele passa a ser o primeiro)</li>
        <li>Se a lista não estava vazia: <code>head.anterior = novoNo</code></li>
        <li><code>head = novoNo</code></li>
        <li>Se a lista estava vazia: <code>tail = novoNo</code> também</li>
    </ol>

    <div class="destaque-amarelo destaque">
        <strong>Atenção à ordem de atribuição:</strong>
        Na lista dupla, a ordem em que os ponteiros são ajustados importa.
        Se você mover o <code>head</code> antes de ajustar o ponteiro do nó antigo,
        perde a referência para ele. Sempre ajuste os ponteiros do novo nó primeiro,
        depois mova o head.
    </div>

    <h3>Inserir no fim — O(1) com TAIL</h3>
    <ol>
        <li>Cria novo nó</li>
        <li><code>novoNo.anterior = tail</code></li>
        <li><code>novoNo.proximo = null</code> (ele passa a ser o último)</li>
        <li>Se a lista não estava vazia: <code>tail.proximo = novoNo</code></li>
        <li><code>tail = novoNo</code></li>
        <li>Se estava vazia: <code>head = novoNo</code> também</li>
    </ol>
</section>

<section class="secao" id="remocao">
    <h2><span class="num">5</span> Remoção explicada</h2>

    <p>
        Se você tem a referência de um nó e quer removê-lo, não é preciso percorrer
        a lista para achar o anterior — o próprio nó já guarda essa informação.
    </p>

    <h3>Removendo um nó qualquer (dado o nó) — O(1):</h3>
    <ol>
        <li>Se o nó tem um anterior: <code>no.anterior.proximo = no.proximo</code></li>
        <li>Se o nó tem um próximo: <code>no.proximo.anterior = no.anterior</code></li>
        <li>Se o nó era o HEAD: atualiza <code>head = no.proximo</code></li>
        <li>Se o nó era o TAIL: atualiza <code>tail = no.anterior</code></li>
    </ol>

    <div class="destaque">
        <strong>Por que isso é útil na prática?</strong>
        Pensa em uma playlist. Você está na música que toca agora — tem a referência dela.
        Para removê-la, na lista simples você teria que ir do início até encontrá-la.
        Na lista dupla, remove diretamente em O(1) porque ela sabe quem vem antes e depois.
    </div>
</section>

<section class="secao" id="comparativo">
    <h2><span class="num">6</span> Quando usar qual?</h2>

    <div class="tabs-container">
        <div class="tabs">
            <button class="tab-btn ativo" data-tab="usa-simples">Use a Lista Simples quando...</button>
            <button class="tab-btn" data-tab="usa-dupla">Use a Lista Dupla quando...</button>
        </div>

        <div class="tab-painel ativo" data-painel="usa-simples">
            <div class="destaque-verde destaque">
                <strong>Prefira a Lista Simples quando:</strong>
                <ul style="margin-top:8px;padding-left:16px;">
                    <li>Você só precisa percorrer a lista em uma direção</li>
                    <li>Inserções e remoções são majoritariamente no início</li>
                    <li>Memória é um fator crítico (a lista dupla usa um ponteiro a mais por nó)</li>
                    <li>Você quer uma implementação mais simples de manter</li>
                    <li>Exemplos: histórico de undo simples, pilha usando lista</li>
                </ul>
            </div>
        </div>

        <div class="tab-painel" data-painel="usa-dupla">
            <div class="destaque" style="border-left-color:var(--cor-secundaria);background:rgba(124,92,191,0.08);">
                <strong style="color:#a07de8;">Prefira a Lista Dupla quando:</strong>
                <ul style="margin-top:8px;padding-left:16px;">
                    <li>Você precisa percorrer nos dois sentidos (ex: player de música — anterior/próxima)</li>
                    <li>Remoções acontecem em posições variadas e você já tem o nó em mão</li>
                    <li>Inserções e remoções frequentes no fim da lista</li>
                    <li>Você precisa implementar um Deque (fila dupla)</li>
                    <li>Exemplos: histórico do browser (voltar e avançar), LRU Cache, editor de texto</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<section class="secao" id="codigo">
    <h2><span class="num">7</span> Código completo em C#</h2>

    <div class="bloco-codigo">
        <div class="bloco-codigo-header">
            <span>Lista Duplamente Encadeada — C# completo</span>
            <div style="display:flex;align-items:center;gap:8px;">
                <span class="lang-badge">C#</span>
                <button class="btn-copiar">Copiar</button>
            </div>
        </div>
        <pre><code class="language-csharp">// ==========================================
// Classe do Nó Duplo
// ==========================================

public class NoDuplo
{
    public int Dado;
    public NoDuplo Anterior;
    public NoDuplo Proximo;

    public NoDuplo(int valor)
    {
        Dado     = valor;
        Anterior = null;
        Proximo  = null;
    }
}

// ==========================================
// Classe da Lista Dupla
// ==========================================

public class ListaDupla
{
    private NoDuplo cabeca;
    private NoDuplo cauda;
    private int tamanho;

    public ListaDupla()
    {
        cabeca  = null;
        cauda   = null;
        tamanho = 0;
    }

    public bool EstaVazia()
    {
        return cabeca == null;
    }

    public int Tamanho()
    {
        // tamanho é mantido atualizado a cada inserção/remoção, então é O(1)
        return tamanho;
    }

    // Inserir no início — O(1)
    public void InserirInicio(int valor)
    {
        NoDuplo novoNo = new NoDuplo(valor);

        if (EstaVazia())
        {
            cabeca = novoNo;
            cauda  = novoNo;
        }
        else
        {
            // ajusta os ponteiros antes de mover a cabeça
            novoNo.Proximo  = cabeca;
            cabeca.Anterior = novoNo;
            cabeca          = novoNo;
        }

        tamanho++;
    }

    // Inserir no fim — O(1) graças ao ponteiro cauda
    public void InserirFim(int valor)
    {
        NoDuplo novoNo = new NoDuplo(valor);

        if (EstaVazia())
        {
            cabeca = novoNo;
            cauda  = novoNo;
        }
        else
        {
            novoNo.Anterior = cauda;
            cauda.Proximo   = novoNo;
            cauda           = novoNo;
        }

        tamanho++;
    }

    // Remover do início — O(1)
    public bool RemoverInicio()
    {
        if (EstaVazia()) return false;

        if (cabeca == cauda)
        {
            // único elemento na lista
            cabeca = null;
            cauda  = null;
        }
        else
        {
            cabeca          = cabeca.Proximo;
            cabeca.Anterior = null;
        }

        tamanho--;
        return true;
    }

    // Remover do fim — O(1) graças ao ponteiro anterior da cauda
    public bool RemoverFim()
    {
        if (EstaVazia()) return false;

        if (cabeca == cauda)
        {
            cabeca = null;
            cauda  = null;
        }
        else
        {
            cauda         = cauda.Anterior;
            cauda.Proximo = null;
        }

        tamanho--;
        return true;
    }

    // Remover por valor — O(n) para encontrar, O(1) para remover
    public bool Remover(int valor)
    {
        NoDuplo atual = cabeca;

        while (atual != null)
        {
            if (atual.Dado == valor)
            {
                if (atual == cabeca) return RemoverInicio();
                if (atual == cauda)  return RemoverFim();

                // caso geral: nó está no meio
                // o anterior pula o atual e aponta direto pro próximo
                atual.Anterior.Proximo = atual.Proximo;
                atual.Proximo.Anterior = atual.Anterior;

                tamanho--;
                return true;
            }

            atual = atual.Proximo;
        }

        return false; // valor não encontrado
    }

    // Percorre do início ao fim
    public void ImprimirDaFrente()
    {
        if (EstaVazia()) { Console.WriteLine("[lista vazia]"); return; }

        NoDuplo atual = cabeca;
        Console.Write("null ⇄ ");

        while (atual != null)
        {
            Console.Write(atual.Dado);
            if (atual.Proximo != null) Console.Write(" ⇄ ");
            atual = atual.Proximo;
        }

        Console.WriteLine(" ⇄ null");
    }

    // Percorre do fim ao início — só possível por causa do ponteiro anterior
    public void ImprimirDeTras()
    {
        if (EstaVazia()) { Console.WriteLine("[lista vazia]"); return; }

        NoDuplo atual = cauda;
        Console.Write("null ⇄ ");

        while (atual != null)
        {
            Console.Write(atual.Dado);
            if (atual.Anterior != null) Console.Write(" ⇄ ");
            atual = atual.Anterior;
        }

        Console.WriteLine(" ⇄ null");
    }
}

// ==========================================
// Exemplo de uso
// ==========================================

class Programa
{
    static void Main()
    {
        ListaDupla lista = new ListaDupla();

        lista.InserirFim(10);
        lista.InserirFim(20);
        lista.InserirFim(30);
        lista.InserirInicio(5);

        Console.Write("Da frente: ");
        lista.ImprimirDaFrente();
        // null ⇄ 5 ⇄ 10 ⇄ 20 ⇄ 30 ⇄ null

        Console.Write("De trás:   ");
        lista.ImprimirDeTras();
        // null ⇄ 30 ⇄ 20 ⇄ 10 ⇄ 5 ⇄ null

        lista.RemoverFim();    // remove 30
        lista.RemoverInicio(); // remove 5

        Console.Write("Após remover início e fim: ");
        lista.ImprimirDaFrente();
        // null ⇄ 10 ⇄ 20 ⇄ null

        lista.Remover(10);
        Console.Write("Após remover 10: ");
        lista.ImprimirDaFrente();
        // null ⇄ 20 ⇄ null

        Console.WriteLine("Tamanho: " + lista.Tamanho()); // 1
    }
}</code></pre>
    </div>
</section>

<section class="secao" id="video">
    <h2><span class="num">8</span> Vídeo explicativo</h2>

    <iframe
        width="100%"
        height="500"
        src="https://www.youtube.com/embed/LmHwMrYvhtI"
        title="Lista Duplamente Encadeada"
        frameborder="0"
        allowfullscreen>
    </iframe>
</section>

<section class="secao" id="resumo">
    <h2><span class="num">9</span> Resumo</h2>

    <div class="destaque-verde destaque">
        <strong>Pontos principais da Lista Dupla:</strong>
        <ul style="margin-top:8px;padding-left:16px;">
            <li>Cada nó tem <strong>três campos</strong>: anterior, dado, próximo</li>
            <li>A lista guarda <strong>HEAD e TAIL</strong> (início e fim)</li>
            <li>Inserção e remoção no fim são <strong>O(1)</strong></li>
            <li>Remoção de um nó (dada sua referência) é <strong>O(1)</strong></li>
            <li>É possível percorrer a lista nos <strong>dois sentidos</strong></li>
            <li>Usa mais memória que a lista simples — um ponteiro extra por nó</li>
        </ul>
    </div>

    <div style="display:flex;gap:12px;margin-top:24px;flex-wrap:wrap;">
        <a href="lista-simples.php" class="btn-secundario">← Lista Simples</a>
        <a href="../index.php" class="btn-primario">Voltar ao início</a>
    </div>
</section>

</div>
</div>
</div>

<?php require_once '../includes/footer.php'; ?>