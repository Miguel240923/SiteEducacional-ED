# EstruturaNET — Ambiente de Ensino de Estruturas de Dados

> Um sistema web educacional simples, limpo e funcional para aprender TAD, Lista Simples e Lista Dupla com PHP + MySQL.

---

## 📁 Estrutura do Projeto

```
estruturas-dados/
│
├── index.php                  ← Página inicial
│
├── includes/                  ← Arquivos compartilhados
│   ├── config.php             ← Configurações e conexão com banco
│   ├── header.php             ← Cabeçalho HTML reutilizável
│   └── footer.php             ← Rodapé HTML reutilizável
│
├── pages/                     ← Páginas de conteúdo
│   ├── tad.php                ← TAD — Tipo Abstrato de Dados
│   ├── lista-simples.php      ← Lista Simplesmente Encadeada
│   └── lista-dupla.php        ← Lista Duplamente Encadeada
│
├── admin/                     ← Área administrativa
│   ├── login.php              ← Tela de login
│   ├── painel.php             ← Listagem de conteúdos
│   ├── novo.php               ← Cadastrar conteúdo
│   ├── editar.php             ← Editar conteúdo
│   ├── excluir.php            ← Excluir conteúdo
│   └── logout.php             ← Encerrar sessão
│
├── assets/                    ← Arquivos estáticos
│   ├── css/
│   │   └── estilo.css         ← Estilos do sistema
│   └── js/
│       └── app.js             ← JavaScript (animações, tabs, etc.)
│
├── sql/
│   └── estruturas_dados.sql   ← Script do banco de dados
│
└── README.md                  ← Este arquivo
```

---

## 🚀 Como Instalar (XAMPP ou Laragon)

### Pré-requisitos
- XAMPP (https://www.apachefriends.org/) **ou** Laragon (https://laragon.org/)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior

---

### Passo 1 — Copiar os arquivos

**Se usar XAMPP:**
```
Copie a pasta `estruturas-dados` para:
C:\xampp\htdocs\
```

**Se usar Laragon:**
```
Copie a pasta `estruturas-dados` para:
C:\laragon\www\
```

---

### Passo 2 — Criar o banco de dados

**Opção A — via phpMyAdmin (mais fácil):**
1. Abra o phpMyAdmin: `http://localhost/phpmyadmin`
2. Clique em **"Novo"** no menu lateral
3. Nome do banco: `estruturas_dados` → charset: `utf8mb4` → clique em **Criar**
4. Com o banco selecionado, clique na aba **"Importar"**
5. Escolha o arquivo `sql/estruturas_dados.sql`
6. Clique em **Executar**

**Opção B — via terminal:**
```bash
mysql -u root -p < sql/estruturas_dados.sql
```

---

### Passo 3 — Configurar a conexão

Abra o arquivo `includes/config.php` e verifique:

```php
define('DB_HOST', 'localhost');   // geralmente fica assim
define('DB_USER', 'root');        // usuário padrão do XAMPP/Laragon
define('DB_PASS', '');            // XAMPP = vazio | Laragon = sem senha ou 'root'
define('DB_NAME', 'estruturas_dados');
```

> **Laragon:** Se não funcionar com senha vazia, tente `DB_PASS = 'root'`

---

### Passo 4 — Acessar o sistema

Inicie o Apache e MySQL no XAMPP/Laragon, depois acesse:

| Página | URL |
|--------|-----|
| Início | `http://localhost/estruturas-dados/` |
| TAD | `http://localhost/estruturas-dados/pages/tad.php` |
| Lista Simples | `http://localhost/estruturas-dados/pages/lista-simples.php` |
| Lista Dupla | `http://localhost/estruturas-dados/pages/lista-dupla.php` |
| Admin | `http://localhost/estruturas-dados/admin/login.php` |

---

## 🔑 Credenciais do Admin

| Campo | Valor |
|-------|-------|
| Usuário | `admin` |
| Senha | `admin123` |

> ⚠️ Mude essas credenciais antes de colocar em produção! Edite o arquivo `admin/login.php`.

---

## 🛠️ Tecnologias Usadas

| Tecnologia | Uso |
|-----------|-----|
| PHP 7.4+ | Back-end, lógica do servidor |
| MySQL 5.7+ | Banco de dados |
| HTML5 | Estrutura das páginas |
| CSS3 | Estilização (sem frameworks) |
| JavaScript | Animações e interatividade |
| Highlight.js | Colorização de código (CDN) |
| Google Fonts | Fontes (Inter + JetBrains Mono) |

---

## 📚 Conteúdo Ensinado

### 1. TAD — Tipo Abstrato de Dados
- O que é abstração
- Interface vs Implementação
- TAD Pilha (Stack) com analogia e código
- TAD Fila (Queue) com analogia
- Código completo em C# comentado

### 2. Lista Simplesmente Encadeada
- Problema do array e como a lista resolve
- O que é um nó (Node)
- Ponteiro HEAD e como a lista se encadeia
- Operações: inserção, remoção, busca
- Animação interativa (adicionar/remover nós)
- Código completo em C# comentado

### 3. Lista Duplamente Encadeada
- Diferença para a lista simples
- Estrutura do nó duplo (anterior + dado + próximo)
- Ponteiro HEAD e TAIL
- Comparativo de complexidade (O(1) vs O(n))
- Quando usar cada uma
- Código completo em C# comentado

---

## 🎛️ Área Administrativa

O painel permite:
- ✅ Listar todos os conteúdos cadastrados
- ✅ Cadastrar novos conteúdos (por estrutura e tipo)
- ✅ Editar conteúdos existentes
- ✅ Excluir conteúdos

> Os conteúdos principais das páginas são fixos no PHP.
> O painel é para adicionar blocos extras (dicas, exercícios, exemplos).

---

## 🐛 Problemas Comuns

**Erro de conexão com banco:**
- Certifique que MySQL está rodando
- Verifique as credenciais em `includes/config.php`
- Certifique que executou o arquivo SQL

**Página em branco:**
- Ative a exibição de erros do PHP no `php.ini`:
  `display_errors = On`
- Ou acesse diretamente `includes/config.php` pra ver o erro

**Fontes não carregam:**
- As fontes são carregadas via Google Fonts (requer internet)
- Sem internet, o navegador usa fallbacks (sans-serif e monospace)

---
