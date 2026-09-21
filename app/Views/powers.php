<div class="powers-list">
<?php if($bonuses['coins']):?><div><span>◈</span><p><strong>+<?=$bonuses['coins']?>% de moedas</strong><small>Sobre a recompensa da partida</small></p></div><?php endif;?>
<?php if($bonuses['fixed']):?><div><span>+</span><p><strong>+<?=$bonuses['fixed']?> moeda extra</strong><small>Por desafio concluído</small></p></div><?php endif;?>
<?php if($bonuses['xp']):?><div><span>✧</span><p><strong>+<?=$bonuses['xp']?> XP extra</strong><small>Para avançar de nível</small></p></div><?php endif;?>
<?php if($bonuses['hint']):?><div><span>✦</span><p><strong>Uma ajuda na hora certa</strong><small>Elimine uma alternativa incorreta uma vez por quiz</small></p></div><?php endif;?>
<?php if(!array_filter($bonuses)):?><p class="dica">Nenhuma habilidade equipada. Acessórios da loja podem ajudar no desafio.</p><?php endif;?></div>
