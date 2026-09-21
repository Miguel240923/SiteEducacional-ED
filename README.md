# EstruturaNET — Ambiente de Ensino de Estruturas de Dados

Aplicação educacional em PHP 8.1+ e MySQL/MariaDB, organizada em MVC. Inclui TAD, listas simples e duplas, fila FIFO, fila de prioridades com desempate FIFO e pilha encadeada.

## Instalação no XAMPP

1. Inicie **Apache** e **MySQL** no painel do XAMPP.
2. Copie o projeto para `C:\xampp\htdocs\SiteEducacional-ED-main`.
3. No phpMyAdmin, crie o banco `estruturas_dados` com codificação `utf8mb4`.
4. Em um **banco vazio**, importe `sql/estruturas_dados.sql`. O arquivo cria as tabelas e inclui 20 perguntas e 9 itens de loja. Não reimporte esse arquivo sobre um banco com dados.
5. Confira `DB_HOST`, `DB_USER`, `DB_PASS` e `DB_NAME` em `includes/config.php`. O padrão local é `localhost`, `root`, senha vazia.
6. Abra `http://localhost/SiteEducacional-ED-main/`.
7. Escolha **Entrar → Criar uma conta**. Não há necessidade de usuário de demonstração.

Para uma instalação anterior, mantenha as tabelas e usuários e importe somente `sql/atualizacao_quiz.sql`. A atualização adiciona quatro perguntas sem duplicá-las. Essa atualização já foi aplicada ao banco local durante a revisão.

Extensões PHP necessárias: `mysqli` e `mbstring` (incluídas no XAMPP utilizado nos testes). Não é necessário Composer nem Node para executar o site.

## Fluxo de uso

- Leia a teoria e estude os exemplos C# nas seis aulas.
- Use os simuladores de FIFO, prioridades e pilha; cada um oferece inserir, remover e limpar.
- As três novas aulas possuem GIFs, vídeos MP4 locais com legendas, exercícios e exemplos C# para download. Os vídeos das aulas originais dependem do YouTube.
- Entre na conta e inicie um quiz de 10 questões. Havendo perguntas ativas para todos os temas, a seleção inclui ao menos uma de cada um dos seis temas.
- Revise o resultado, visite a loja e equipe os itens no inventário do avatar.
- Em **Minha área → Meu perfil**, altere nome e e-mail. Use **Personalizar avatar** para trocar os itens.

## Regras de gamificação

- Cada quiz concluído concede **20 moedas + 10 por acerto**, e **10 XP por acerto**.
- O nível é `floor(XP / 100) + 1`: 0–99 XP = nível 1; 100–199 = nível 2.
- Abandonar/reiniciar um quiz não concede prêmio. Atualizar o resultado ou reenviar uma resposta não paga novamente.
- Os bônus percentuais de moedas são somados e aplicados à recompensa base; o resultado é arredondado para cima. Moedas fixas são acrescentadas depois.
- Os bônus de XP são somados. Exemplo: 10 acertos, +15% e +5% de moedas, +1 moeda e +15 XP resultam em 145 moedas e 115 XP.
- O **Boné do Código** elimina uma alternativa incorreta em uma questão, uma vez por quiz.
- As habilidades dos itens equipados são registradas no início do quiz; trocar de roupa durante a partida não altera seus bônus.
- Uma peça por categoria: chapéu/cabelo, rosto e roupa. Itens comprados não podem ser comprados novamente; saldo insuficiente é validado no servidor.
- O Rosto Curioso é um item gratuito e estético. Os demais itens têm bônus de recompensa ou a habilidade de dica.

## Recuperação de senha

A recuperação está configurada para **demonstração local**: o usuário informa o e-mail e recebe na tela o link de redefinição. O token expira em uma hora e só pode ser usado uma vez. As senhas são armazenadas com `password_hash`.

O projeto ainda não envia e-mails. Antes de uma publicação pública, implemente envio por SMTP e remova a exibição do link de recuperação na tela.

## Administração

Abra `admin/login.php`. No ambiente de demonstração, usuário `admin` e senha `admin123`.

A variável de ambiente `ED_ADMIN_PASSWORD` permite definir outra senha para o administrador. Defina-a no ambiente do Apache e reinicie o serviço. Quando ela está configurada, a tela não mostra as credenciais padrão.

O painel permite criar, editar e excluir conteúdo complementar de todas as seis estruturas. Os conteúdos aparecem nas respectivas aulas; nas aulas originais, ficam na seção expansível **Material complementar**. As ações de gravação usam POST e token CSRF.

## Organização MVC

- Rotas públicas: arquivos `.php` na raiz, em `pages/` e em `admin/`.
- `app/Controllers/`: fluxo das requisições, autenticação, validação e escolha das telas.
- `app/Models/`: usuários, quiz, loja, conteúdo e dados das aulas; consultas e alterações no MySQL.
- `app/Views/`: páginas e componentes de apresentação.
- `includes/`: configuração, sessão, cabeçalho e rodapé.
- `assets/css/`: estilos de base e refinamento visual responsivo.
- `assets/js/`: interações de navegação e simuladores.
- `assets/examples/`: exemplos independentes de filas e pilha em C#.
- `assets/media/`: GIFs, vídeos e legendas locais.
- `sql/`: instalação e atualização incremental.
- `tools/`: testes de integração, testes C# e gerador das mídias didáticas.

## Verificação

Consulte `VALIDACAO.md` para os testes executados e os limites da verificação.

Com Python e os serviços do XAMPP em execução:

```powershell
python tools/check_integration.py
```

O teste usa as configurações locais padrão e cria contas/conteúdos temporários identificados por UUID, removendo somente esses registros ao terminar. Para outro ambiente, ajuste o endereço e o comando MySQL no script. A verificação administrativa pressupõe a senha local de demonstração.

Com o SDK .NET 8 instalado:

```powershell
python tools/check_csharp.py
```

Se o SDK estiver em uma pasta específica, defina `ESTRUTURA_DOTNET` com o caminho do executável. O site PHP funciona sem instalar .NET; ele só é necessário para compilar os exemplos.

## Entrega acadêmica

O projeto e este manual estão disponíveis localmente. Ainda é necessário que o grupo forneça o **link do seu repositório GitHub**, identifique os integrantes e realize a entrega/apresentação solicitada pelo professor. A revisão não publicou nem enviou arquivos em nome do grupo.
