<?php
class Quiz {
    public static function historico($uid) {
        $db=conectar();$st=$db->prepare('SELECT total,acertos,moedas_ganhas,xp_ganho,realizado_em FROM quiz_resultados WHERE usuario_id=? ORDER BY id DESC LIMIT 5');
        $st->bind_param('i',$uid);$st->execute();$rows=$st->get_result()->fetch_all(MYSQLI_ASSOC);$db->close();return $rows;
    }
    public static function finalizar($uid,$total,$acertos,$habilidades) {
        if($total<1 || $acertos<0 || $acertos>$total) throw new InvalidArgumentException('Resultado inválido.');
        $coins=20+$acertos*10; $xp=$acertos*10; $bonus=0; $extra=0;
        foreach($habilidades as $h){
            if(preg_match('/\+(\d+)% de moedas/u',$h,$m)) $bonus+=(int)$m[1];
            if(preg_match('/\+(\d+) XP/u',$h,$m)) $xp+=(int)$m[1];
            if(preg_match('/\+(\d+) moeda/u',$h,$m)) $extra+=(int)$m[1];
        }
        $coins=(int)ceil($coins*(1+$bonus/100))+$extra;
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
        foreach(['tad','lista_simples','lista_dupla','fila_fifo','fila_prioridade','pilha'] as $tema){
            foreach($todas as $p)if($p['estrutura']===$tema){$escolhidas[$p['id']]=$p;break;}
            if(count($escolhidas)>=$limite)break;
        }
        foreach($todas as $p){if(count($escolhidas)>=$limite)break;$escolhidas[$p['id']]=$p;}
        $a=array_values($escolhidas);shuffle($a);return $a;
    }
}
?>
