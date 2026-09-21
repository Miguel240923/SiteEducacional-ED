<?php
require_once __DIR__.'/Game.php';

class Quiz {
    public static function historico($uid) {
        $db=conectar();$st=$db->prepare('SELECT total,acertos,moedas_ganhas,xp_ganho,realizado_em FROM quiz_resultados WHERE usuario_id=? ORDER BY id DESC LIMIT 5');
        $st->bind_param('i',$uid);$st->execute();$rows=$st->get_result()->fetch_all(MYSQLI_ASSOC);$db->close();return $rows;
    }
    public static function finalizar($uid,$total,$acertos,$habilidades) {
        if($total<1 || $acertos<0 || $acertos>$total) throw new InvalidArgumentException('Resultado inválido.');
        $bonus=Game::bonuses($habilidades);
        $xp=$acertos*10+$bonus['xp'];
        $coins=(int)ceil((20+$acertos*10)*(1+$bonus['coins']/100))+$bonus['fixed'];
        $db=conectar();$db->begin_transaction();
        try {
            $st=$db->prepare('INSERT INTO quiz_resultados(usuario_id,total,acertos,moedas_ganhas,xp_ganho) VALUES(?,?,?,?,?)');
            $st->bind_param('iiiii',$uid,$total,$acertos,$coins,$xp);$st->execute();
            $st=$db->prepare('UPDATE usuarios SET moedas=moedas+?, nivel=FLOOR((xp+?)/100)+1, xp=xp+? WHERE id=?');
            $st->bind_param('iiii',$coins,$xp,$xp,$uid);$st->execute();
            $db->commit();
        } catch(Throwable $e){$db->rollback();throw $e;} finally{$db->close();}
        return [$coins,$xp];
    }

    public static function perguntas($limite=10) {
        $db=conectar(); $limite=max(1,(int)$limite);
        $r=$db->query("SELECT * FROM quiz_perguntas WHERE ativo=1 ORDER BY RAND()");$todas=$r->fetch_all(MYSQLI_ASSOC);$db->close();
        $escolhidas=[];
        foreach(Game::estruturas() as $tema){
            foreach($todas as $p)if($p['estrutura']===$tema){$escolhidas[$p['id']]=$p;break;}
            if(count($escolhidas)>=$limite)break;
        }
        foreach($todas as $p){if(count($escolhidas)>=$limite)break;$escolhidas[$p['id']]=$p;}
        $a=array_values($escolhidas);shuffle($a);return $a;
    }
}
?>
