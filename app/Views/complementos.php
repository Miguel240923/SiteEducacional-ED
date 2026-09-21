<?php if($extras):?>
<section class="container conteudos-extras"><h2>Material complementar</h2><p class="dica">Conteúdos organizados pelo administrador. Abra um tópico para consultar.</p>
<?php foreach($extras as $extra):?><details class="bloco-conteudo"><summary><?=htmlspecialchars($extra['titulo'])?></summary><?php if($extra['tipo']==='codigo'):?><pre style="overflow:auto"><code><?=htmlspecialchars($extra['conteudo'])?></code></pre><?php else:?><p><?=nl2br(htmlspecialchars(strip_tags($extra['conteudo'])))?></p><?php endif;?></details><?php endforeach;?></section>
<?php endif;?>
