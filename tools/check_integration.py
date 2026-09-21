"""Integration checks against local XAMPP; only creates/removes its own test users."""
import urllib.request, urllib.parse, http.cookiejar, re, subprocess, uuid, json
from pathlib import Path
BASE='http://localhost/SiteEducacional-ED-main/'
MYSQL='C:/xampp/mysql/bin/mysql.exe'
def sql(q):
 return subprocess.check_output([MYSQL,'-u','root','--default-character-set=utf8mb4','-N','-B','estruturas_dados','-e',q]).decode('utf-8')
jar=http.cookiejar.CookieJar(); client=urllib.request.build_opener(urllib.request.HTTPCookieProcessor(jar))
def req(path,data=None,csrf=True):
 if data is not None and csrf and 'csrf' not in data and not path.startswith('quiz.php'):
  form=req(path);match=re.search(r'name="csrf" value="([^"]+)"',form)
  if match:data=dict(data,csrf=match.group(1))
 response=client.open(BASE+path,urllib.parse.urlencode(data).encode() if data is not None else None)
 body=response.read().decode('utf-8-sig')
 assert not re.search(r'(Fatal error|Warning:|Parse error|Uncaught)',body),path
 return body
def hidden(body,name):return re.search(r'name="'+name+r'" value="([^"]+)"',body).group(1)
email='qa_'+uuid.uuid4().hex+'@example.test';uid=None
try:
 for page in ['index.php','pages/tad.php','pages/lista-simples.php','pages/lista-dupla.php','pages/fila-fifo.php','pages/fila-prioridade.php','pages/pilha.php','login-usuario.php','cadastro-usuario.php','recuperar-senha.php']:
  req(page)
 print('PASS public routes')
 body=req('cadastro-usuario.php',dict(nome='QA Estrutura',email=email,senha='Teste123!',confirmar='Teste123!'))
 assert 'Olá, QA Estrutura' in body
 uid=int(sql("SELECT id FROM usuarios WHERE email='"+email+"'"))
 req('logout-usuario.php')
 body=req('cadastro-usuario.php',dict(nome='QA Estrutura',email=email,senha='Teste123!',confirmar='Teste123!'))
 assert 'já está cadastrado' in body
 body=req('login-usuario.php',dict(email=email,senha='Teste123!'));assert 'Olá, QA Estrutura' in body
 body=req('perfil.php',dict(nome='QA Atualizado',email=email));assert 'Perfil atualizado!' in body
 print('PASS registration, duplicate email, login, profile')
 body=req('loja.php');csrf=hidden(body,'csrf')
 body=req('loja.php',dict(csrf=csrf,comprar=3));assert 'Moedas insuficientes' in body
 sql(f'UPDATE usuarios SET moedas=300 WHERE id={uid}')
 body=req('loja.php',dict(csrf=csrf,comprar=3));assert 'Item comprado!' in body
 balance=sql(f'SELECT moedas FROM usuarios WHERE id={uid}').strip();assert balance=='220'
 body=req('loja.php',dict(csrf=csrf,comprar=3));assert 'já possui' in body
 assert sql(f'SELECT moedas FROM usuarios WHERE id={uid}').strip()==balance
 body=req('avatar.php',dict(csrf=csrf,equip=3));assert 'Item equipado!' in body and '🧢' in body
 assert 'data-chapeu="cap"' in body
 body=req('avatar.php',dict(csrf=csrf,desequipar='chapeu'));assert 'Item removido' in body
 assert sql(f'SELECT avatar_chapeu IS NULL FROM usuarios WHERE id={uid}').strip()=='1'
 body=req('loja.php',dict(csrf=csrf,equip=3));assert 'Item equipado!' in body
 body=req('avatar.php',dict(csrf=csrf,desequipar='invalida'));assert 'Categoria inválida' in body
 body=req('avatar.php',dict(csrf=csrf,equip=2));assert 'não encontrado' in body
 try:req('loja.php',dict(comprar=1),csrf=False);raise AssertionError('CSRF accepted')
 except urllib.error.HTTPError as e:assert e.code==403
 print('PASS purchase, insufficient balance, duplicate purchase, equipment ownership, CSRF')
 body=req('quiz.php');assert 'Começar desafio' in body
 body=req('quiz.php?novo=1');nonce=hidden(body,'nonce')
 body=req('quiz.php',dict(nonce=nonce,pos=0,acao='dica'));assert 'Alternativa eliminada' in body
 body=req('quiz.php',dict(nonce=nonce,pos=0,resposta='Z'));assert 'alternativa válida' in body and 'Questão 1 de' in body
 for n in range(10):
  # The hint removes one incorrect answer; choose an enabled answer.
  choices=re.findall(r'name="resposta" value="([ABCD])" required',body)
  answer=choices[0];body=req('quiz.php',dict(nonce=nonce,pos=n,resposta=answer))
  if n==0:
   body=req('quiz.php',dict(nonce=nonce,pos=0,resposta=answer));assert 'Questão 1 de' in body and 'Próxima questão' in body
   body=req('quiz.php',dict(nonce=nonce,pos=1,resposta='A'));assert 'Leia a explicação' in body
  if n<9:
   assert 'Entenda o raciocínio' in body
   body=req('quiz.php',dict(nonce=nonce,pos=n+1,acao='continuar'))
 assert 'Desafio concluído' in body
 assert 'Aprenda com cada resposta' in body
 lobby=req('quiz.php?preparar=1');assert 'Suas últimas partidas' in lobby and 'history-row' in lobby
 count=sql(f'SELECT COUNT(*) FROM quiz_resultados WHERE usuario_id={uid}').strip();assert count=='1'
 req('quiz.php');req('quiz.php',dict(nonce=nonce,pos=9,resposta='A'))
 assert sql(f'SELECT COUNT(*) FROM quiz_resultados WHERE usuario_id={uid}').strip()=='1'
 values=sql(f'SELECT moedas,xp,nivel FROM usuarios WHERE id={uid}').strip().split('\t')
 result=sql(f'SELECT acertos,moedas_ganhas,xp_ganho FROM quiz_resultados WHERE usuario_id={uid}').strip().split('\t')
 hits,coins,xp=map(int,result);assert coins==20+hits*10 and xp==hits*10
 assert list(map(int,values))==[220+coins,xp,xp//100+1]
 print('PASS hint, invalid/stale answers, ten questions, single reward, XP/level')
 sql(f'UPDATE usuarios SET xp=95,nivel=1 WHERE id={uid}')
 php="require 'includes/config.php';require 'app/Models/Quiz.php';echo json_encode(Quiz::finalizar("+str(uid)+",10,10,['+15% de moedas nas recompensas','+5% de moedas nas recompensas','+10 XP por quiz','+5 XP por quiz','+1 moeda por quiz']));"
 rewards=json.loads(subprocess.check_output(['C:/xampp/php/php.exe','-r',php],cwd=Path(__file__).resolve().parents[1]))
 assert rewards==[145,115],rewards
 assert sql(f'SELECT xp,nivel FROM usuarios WHERE id={uid}').strip()=='210\t3'
 print('PASS combined percentage rewards, XP bonuses and level boundary')
 req('logout-usuario.php');body=req('recuperar-senha.php',dict(email=email))
 token=re.search(r'redefinir-senha.php\?token=([a-f0-9]+)',body).group(1)
 body=req('redefinir-senha.php',dict(token=token,senha='Nova123!',confirmar='Nova123!'));assert 'Senha alterada!' in body
 body=req('redefinir-senha.php',dict(token=token,senha='Nova123!',confirmar='Nova123!'));assert 'Token inválido ou expirado' in body
 body=req('login-usuario.php',dict(email=email,senha='Nova123!'));assert 'Olá, QA Atualizado' in body
 print('PASS local password recovery, token reuse rejection, new password login')
 body=req('admin/login.php',dict(usuario='admin',senha='admin123'));assert 'Gerenciar Conteúdos' in body
 title='QA '+uuid.uuid4().hex
 try:
  body=req('admin/novo.php',dict(estrutura='fila_prioridade',tipo='teoria',titulo=title,conteudo='Conteúdo temporário QA',ordem=99))
  cid=int(sql("SELECT id FROM conteudos WHERE titulo='"+title+"'"))
  body=req('admin/editar.php?id='+str(cid));assert 'value="fila_prioridade" selected' in body
  body=req('admin/editar.php?id='+str(cid),dict(estrutura='pilha',tipo='codigo',titulo=title,conteudo='var valor = 10;',ordem=99))
  assert sql(f'SELECT estrutura FROM conteudos WHERE id={cid}').strip()=='pilha'
  body=req('admin/painel.php');token=hidden(body,'csrf')
  body=req('admin/excluir.php',dict(csrf=token,id=cid));assert 'excluído com sucesso' in body
  assert sql(f'SELECT COUNT(*) FROM conteudos WHERE id={cid}').strip()=='0'
  print('PASS administration: create, preserve selected structure, edit, delete')
 finally:sql("DELETE FROM conteudos WHERE titulo='"+title+"'")
finally:
 if uid is not None:sql(f'DELETE FROM usuarios WHERE id={uid} AND email=\'{email}\'')
print('Integration checks passed; synthetic user removed.')
