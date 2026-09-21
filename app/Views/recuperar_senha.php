
<div class="container"><div class="login-box"><h2>🔑 Recuperar senha</h2><?php if($erro):?><div class="alerta alerta-erro"><?=htmlspecialchars($erro)?></div><?php endif;?><?php if($mensagem):?><div class="alerta alerta-sucesso"><?=$mensagem?></div><?php endif;?>
<form method="post"><?=campoCsrf()?><div class="form-grupo"><label for="email">E-mail</label><input type="email" id="email" name="email" required></div><button class="btn-primario">Gerar recuperação</button></form><p><a href="login-usuario.php">Voltar ao login</a></p></div></div>
