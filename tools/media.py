from pathlib import Path
from PIL import Image, ImageDraw, ImageFont
import imageio_ffmpeg, subprocess
root=Path(__file__).resolve().parents[1]
font=ImageFont.truetype('C:/Windows/Fonts/arial.ttf',24)
small=ImageFont.truetype('C:/Windows/Fonts/arial.ttf',19)
big=ImageFont.truetype('C:/Windows/Fonts/arialbd.ttf',32)
data={
 'fila_fifo':('Fila FIFO', [('Enqueue(10): primeiro nó',[('10','início / fim')]),('Enqueue(20): entra no fim',[('10','início'),('20','fim')]),('Enqueue(30): segue a ordem de chegada',[('10','início'),('20',''),('30','fim')]),('Dequeue(): retorna 10',[('20','início'),('30','fim')])]),
 'fila_prioridade':('Fila de prioridades',[('Enqueue(A, 2)',[('A','prioridade 2')]),('Enqueue(B, 5): B passa à frente',[('B','prioridade 5'),('A','prioridade 2')]),('Enqueue(C, 5): empate preserva FIFO',[('B','prioridade 5'),('C','prioridade 5'),('A','prioridade 2')]),('Dequeue(): retorna B, que chegou antes de C',[('C','prioridade 5'),('A','prioridade 2')])]),
 'pilha':('Pilha LIFO',[('Push(10): primeiro nó',[('10','topo')]),('Push(20): novo topo',[('20','topo'),('10','')]),('Push(30): novo topo',[('30','topo'),('20',''),('10','')]),('Pop(): retorna 30',[('20','topo'),('10','')])])}
for slug,(title,steps) in data.items():
 frames=[]
 for n,(caption,nodes) in enumerate(steps):
  im=Image.new('RGB',(800,450),'#101b2c');d=ImageDraw.Draw(im)
  d.text((30,28),'ESTRUTURANET / LABORATÓRIO',font=small,fill='#8daaff')
  d.text((30,72),title,font=big,fill='#edf2fc')
  d.text((30,133),caption,font=font,fill='#c1d2ee')
  for i,(value,label) in enumerate(nodes):
   x=35+i*215;d.rounded_rectangle((x,205,x+145,290),radius=14,fill='#263f60',outline='#8daaff',width=2)
   d.text((x+50,226),value,font=big,fill='#eff5ff');d.text((x,304),label,font=small,fill='#a7bbd7')
   d.line((x+152,248,x+193,248),fill='#70dfaf',width=3);d.polygon([(x+193,248),(x+183,242),(x+183,254)],fill='#70dfaf')
  d.text((len(nodes)*215+5,235),'null',font=small,fill='#70dfaf')
  d.text((30,390),f'Passo {n+1} de 4  /  Cada seta representa a referência Proximo.',font=small,fill='#a7bbd7')
  frames.append(im)
 dest=root/'assets/media'/slug
 frames[0].save(str(dest)+'.gif',save_all=True,append_images=frames[1:],duration=2400,loop=1)
 proc=subprocess.Popen([imageio_ffmpeg.get_ffmpeg_exe(),'-y','-f','rawvideo','-vcodec','rawvideo','-pix_fmt','rgb24','-s','800x450','-r','10','-i','-','-an','-c:v','libx264','-pix_fmt','yuv420p','-movflags','+faststart',str(dest)+'.mp4'],stdin=subprocess.PIPE,stderr=subprocess.PIPE)
 for frame in frames:
  for _ in range(24):proc.stdin.write(frame.tobytes())
 proc.stdin.close();error=proc.stderr.read();assert proc.wait()==0,error
 captions='WEBVTT\n\n'
 for n,(caption,_) in enumerate(steps):
  start=n*2400;end=(n+1)*2400
  captions+=f'00:00:{start//1000:02d}.{start%1000:03d} --> 00:00:{end//1000:02d}.{end%1000:03d}\n{caption}\n\n'
 Path(str(dest)+'.vtt').write_text(captions,encoding='utf-8')
print('3 GIFs, 3 vídeos MP4 e 3 legendas gerados.')
