-- ============================================================
-- EstruturaNET — Banco de Dados MySQL
-- Arquivo: estruturas_dados.sql
-- Versão: 1.0
-- ============================================================
-- Como usar:
--   1. Abra o phpMyAdmin (ou terminal MySQL)
--   2. Crie o banco: CREATE DATABASE estruturas_dados CHARACTER SET utf8mb4;
--   3. Importe este arquivo
-- OU execute no terminal:
--   mysql -u root -p < estruturas_dados.sql
-- ============================================================

-- Cria o banco se não existir
CREATE DATABASE IF NOT EXISTS `estruturas_dados`
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE `estruturas_dados`;

-- ============================================================
-- Tabela: conteudos
-- Guarda os conteúdos adicionais cadastrados pelo admin
-- Os conteúdos principais estão nas páginas PHP (tad.php, etc.)
-- Esta tabela permite ADICIONAR conteúdo extra via painel
-- ============================================================
DROP TABLE IF EXISTS `conteudos`;

CREATE TABLE `conteudos` (
    `id`        INT AUTO_INCREMENT PRIMARY KEY,
    `estrutura` ENUM('tad', 'lista_simples', 'lista_dupla') NOT NULL COMMENT 'Qual estrutura esse conteúdo pertence',
    `tipo`      ENUM('teoria', 'exemplo', 'codigo', 'dica', 'exercicio') NOT NULL DEFAULT 'teoria',
    `titulo`    VARCHAR(255) NOT NULL COMMENT 'Título do bloco de conteúdo',
    `conteudo`  TEXT NOT NULL COMMENT 'Corpo do conteúdo (HTML básico permitido)',
    `ordem`     INT NOT NULL DEFAULT 10 COMMENT 'Ordem de exibição (menor = primeiro)',
    `ativo`     TINYINT(1) NOT NULL DEFAULT 1 COMMENT '1=ativo, 0=inativo',
    `criado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `editado_em` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_estrutura` (`estrutura`),
    INDEX `idx_ordem`     (`estrutura`, `ordem`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
  COMMENT='Conteúdos extras cadastrados pelo administrador';

-- ============================================================
-- Dados de exemplo
-- ============================================================
INSERT INTO `conteudos` (`estrutura`, `tipo`, `titulo`, `conteudo`, `ordem`) VALUES

-- TAD
('tad', 'dica', 'Dica: TAD não é sobre linguagem de programação',
'<p>Uma coisa que confunde muito quem tá começando: o TAD não depende de nenhuma linguagem específica.</p>
<p>Você pode ter um TAD Pilha implementado em C, Java, Python, C# ou qualquer outra linguagem. O que muda é a implementação, não o conceito.</p>
<p><strong>O TAD é um conceito matemático/lógico, não de programação.</strong></p>', 50),

('tad', 'exemplo', 'Exemplo real: TAD no dia a dia',
'<p>Pensa no controle remoto da TV:</p>
<ul>
    <li>Você aperta o botão "Volume +" e o volume sobe — essa é a <strong>interface</strong></li>
    <li>Por dentro, o controle envia um sinal infravermelho, a TV interpreta e manda pro chip de áudio ajustar o volume — essa é a <strong>implementação</strong></li>
</ul>
<p>Você como usuário não precisa saber nada disso. Você só precisa saber apertar o botão. Isso é abstração!</p>', 55),

-- Lista Simples
('lista_simples', 'dica', 'Por que não usar array sempre?',
'<p>Você pode estar pensando: "se o array é mais rápido pra acessar por índice, por que eu usaria lista?"</p>
<p>A resposta: depende do que você vai fazer com os dados.</p>
<ul>
    <li>Se você vai <strong>acessar elementos por posição frequentemente</strong> → array é melhor</li>
    <li>Se você vai <strong>inserir e remover no início frequentemente</strong> → lista encadeada é melhor</li>
    <li>Se você <strong>não sabe o tamanho dos dados de antemão</strong> → lista é melhor (crescimento dinâmico)</li>
</ul>
<p>Na prática, em linguagens modernas como C# e Java, as listas genéricas (<code>List&lt;T&gt;</code>) já combinam o melhor dos dois mundos usando arrays internamente com redimensionamento automático.</p>', 50),

('lista_simples', 'exercicio', 'Exercício: implemente você mesmo',
'<p>Tente implementar as seguintes operações por conta própria, sem olhar o código de exemplo:</p>
<ol>
    <li>Crie uma lista encadeada de strings</li>
    <li>Implemente a inserção no início</li>
    <li>Implemente a impressão de todos os elementos</li>
    <li>Implemente a busca por um valor</li>
    <li><strong>Desafio:</strong> implemente a inversão da lista (inverta a ordem dos nós)</li>
</ol>
<p>A inversão da lista é um exercício clássico de entrevista de emprego em empresas de tecnologia. Vale treinar!</p>', 90),

-- Lista Dupla
('lista_dupla', 'exemplo', 'Exemplo real: playlist de músicas',
'<p>Uma playlist de músicas é um exemplo perfeito de lista duplamente encadeada:</p>
<ul>
    <li>Cada música é um nó</li>
    <li>O botão "Próxima" segue o ponteiro <code>proximo</code></li>
    <li>O botão "Anterior" segue o ponteiro <code>anterior</code></li>
    <li>Adicionar músicas no começo ou fim é O(1)</li>
    <li>Remover a música que tá tocando (você já tem a referência) é O(1)</li>
</ul>
<p>Serviços como Spotify provavelmente usam estruturas mais sofisticadas, mas o conceito base é exatamente esse.</p>', 50),

('lista_dupla', 'dica', 'LRU Cache — a aplicação mais famosa de lista dupla',
'<p>Uma das aplicações mais conhecidas da lista duplamente encadeada é o <strong>LRU Cache</strong> (Least Recently Used).</p>
<p>Ele é usado em bancos de dados, sistemas operacionais e até em perguntas de entrevistas de emprego.</p>
<p>A ideia: o cache tem tamanho limitado. Quando enche, remove o item usado há mais tempo. A lista dupla (combinada com um HashMap) permite fazer isso em O(1) tanto pra acessar quanto pra remover.</p>
<p>Se você entender lista duplamente encadeada bem, o LRU Cache vai fazer total sentido!</p>', 55);

-- ============================================================
-- Verificação final
-- ============================================================
SELECT
    estrutura,
    COUNT(*) AS total_conteudos
FROM conteudos
GROUP BY estrutura
ORDER BY estrutura;
