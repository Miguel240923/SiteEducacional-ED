from pathlib import Path
import tempfile,subprocess,os,re,html
root=Path(__file__).resolve().parents[1]
checks={
 'fila_fifo':('Fila<int>','s.Enqueue(10); s.Enqueue(20); s.Enqueue(30); Check(s.Peek()==10); Check(s.Dequeue()==10); Check(s.Dequeue()==20); Check(s.Dequeue()==30); s.Enqueue(40); Check(s.Dequeue()==40);'),
 'fila_prioridade':('FilaPrioridade<string>','s.Enqueue("A",2); s.Enqueue("B",5); s.Enqueue("C",5); Check(s.Peek()=="B"); Check(s.Dequeue()=="B"); Check(s.Dequeue()=="C"); Check(s.Dequeue()=="A"); s.Enqueue("D",-1); Check(s.Dequeue()=="D");'),
 'pilha':('Pilha<int>','s.Push(10); s.Push(20); s.Push(30); Check(s.Peek()==30); Check(s.Pop()==30); Check(s.Pop()==20); Check(s.Pop()==10); s.Push(40); Check(s.Pop()==40);')}
for slug,(klass,body) in checks.items():
 with tempfile.TemporaryDirectory(prefix='estrutura-csharp-') as d:
  p=Path(d);(p/'Test.csproj').write_text('<Project Sdk="Microsoft.NET.Sdk"><PropertyGroup><OutputType>Exe</OutputType><TargetFramework>net8.0</TargetFramework><Nullable>enable</Nullable></PropertyGroup></Project>')
  code=(root/'assets/examples'/f'{slug}.cs').read_text(encoding='utf-8-sig').split('public class Program')[0]
  removal='Pop' if slug=='pilha' else 'Dequeue'
  code+='public class Program { static void Check(bool condition) { if(!condition) throw new Exception("Assertion failed"); } public static void Main() { var s = new '+klass+'(); Check(s.Count==0); '+body+' Check(s.Count==0); bool failed=false; try{s.'+removal+'();}catch(InvalidOperationException){failed=true;} Check(failed); Console.WriteLine("PASS '+slug+'"); }}'
  (p/'Program.cs').write_text(code,encoding='utf-8')
  dotnet=os.environ.get('ESTRUTURA_DOTNET','dotnet')
  r=subprocess.run([dotnet,'run','--project',str(p/'Test.csproj')],capture_output=True,text=True,encoding='utf-8',errors='replace')
  print(r.stdout);assert r.returncode==0,r.stderr
for slug in ['tad','lista_simples','lista_dupla']:
 with tempfile.TemporaryDirectory(prefix='estrutura-csharp-') as d:
  p=Path(d);(p/'Test.csproj').write_text('<Project Sdk="Microsoft.NET.Sdk"><PropertyGroup><OutputType>Exe</OutputType><TargetFramework>net8.0</TargetFramework><ImplicitUsings>enable</ImplicitUsings></PropertyGroup></Project>')
  page=(root/'app/Views'/f'pages_{slug}.php').read_text(encoding='utf-8')
  blocks=re.findall(r'<code[^>]*>(.*?)</code>',page,re.S)
  code=html.unescape(max(blocks,key=len));(p/'Program.cs').write_text(code,encoding='utf-8')
  r=subprocess.run([os.environ.get('ESTRUTURA_DOTNET','dotnet'),'run','--project',str(p/'Test.csproj')],capture_output=True,text=True,encoding='utf-8',errors='replace')
  assert r.returncode==0,r.stdout+r.stderr
  print('PASS original example:',slug)
