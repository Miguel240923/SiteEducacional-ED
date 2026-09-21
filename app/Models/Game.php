<?php
/** Presentation metadata shared by the shop, wardrobe and quiz. */
class Game {
    public const CATEGORIES = ['chapeu'=>'Chapéus','rosto'=>'Rostos','roupa'=>'Roupas'];
    public const FIELDS = ['chapeu'=>'avatar_chapeu','rosto'=>'avatar_face','roupa'=>'avatar_roupa'];
    public const THEMES = ['tad'=>'Tipo abstrato de dados','lista_simples'=>'Lista simplesmente encadeada','lista_dupla'=>'Lista duplamente encadeada','fila_fifo'=>'Fila FIFO','fila_prioridade'=>'Fila de prioridades','pilha'=>'Pilha encadeada','geral'=>'Fundamentos'];

    public static function variant($item) {
        return ['🎩'=>'classic','👑'=>'crown','🧢'=>'cap','😀'=>'happy','🤓'=>'nerd','🤖'=>'robot','👕'=>'shirt','🧥'=>'hoodie','🥼'=>'coat'][$item['icone']] ?? 'default';
    }
    public static function gear($user,$items) {
        $gear=['chapeu'=>null,'rosto'=>null,'roupa'=>null];
        foreach($items as $item){
            $field=self::FIELDS[$item['categoria']]??null;
            if($field && (int)$user[$field]===(int)$item['id'])$gear[$item['categoria']]=$item;
        }
        return $gear;
    }
    public static function bonuses($abilities) {
        $result=['coins'=>0,'xp'=>0,'fixed'=>0,'hint'=>false];
        foreach($abilities as $ability){
            if(preg_match('/\+(\d+)% de moedas/u',$ability,$m))$result['coins']+=(int)$m[1];
            if(preg_match('/\+(\d+) XP/u',$ability,$m))$result['xp']+=(int)$m[1];
            if(preg_match('/\+(\d+) moeda/u',$ability,$m))$result['fixed']+=(int)$m[1];
            if(str_contains($ability,'Dica extra'))$result['hint']=true;
        }
        return $result;
    }
    public static function question($text) {
        // Only server-generated code markup is allowed; question content stays escaped.
        return preg_replace('/`([^`]+)`/u','<code>$1</code>',htmlspecialchars($text,ENT_QUOTES,'UTF-8'));
    }
}
