<?php
class Shop {
    public static function unequip($uid,$category) {
        $field=['chapeu'=>'avatar_chapeu','rosto'=>'avatar_face','roupa'=>'avatar_roupa'][$category]??null;
        if(!$field)return [false,'Categoria inválida.'];
        $db=conectar();$st=$db->prepare("UPDATE usuarios SET $field=NULL WHERE id=?");$st->bind_param('i',$uid);$st->execute();$db->close();
        return [true,'Item removido. O visual básico está ativo.'];
    }
    public static function equippedAbilities($uid) {
        $db=conectar();
        $st=$db->prepare('SELECT i.habilidade FROM loja_itens i JOIN usuarios u ON i.id IN (u.avatar_chapeu,u.avatar_face,u.avatar_roupa) JOIN inventario v ON v.item_id=i.id AND v.usuario_id=u.id WHERE u.id=? AND i.ativo=1');
        $st->bind_param('i',$uid);$st->execute();
        $habilidades=array_column($st->get_result()->fetch_all(MYSQLI_ASSOC),'habilidade');
        $db->close();
        return $habilidades;
    }
    public static function items() {
        $db=conectar(); $r=$db->query("SELECT * FROM loja_itens WHERE ativo=1 ORDER BY categoria, preco, id"); $a=$r->fetch_all(MYSQLI_ASSOC); $db->close(); return $a;
    }
    public static function owned($uid) {
        $db=conectar(); $st=$db->prepare("SELECT item_id FROM inventario WHERE usuario_id=?"); $st->bind_param('i',$uid); $st->execute(); $r=$st->get_result(); $a=[]; while($x=$r->fetch_assoc()) $a[]=(int)$x['item_id']; $st->close(); $db->close(); return $a;
    }
    public static function buy($uid,$itemId) {
        $db=conectar(); $db->begin_transaction();
        try {
            $st=$db->prepare("SELECT preco FROM loja_itens WHERE id=? AND ativo=1 FOR UPDATE"); $st->bind_param('i',$itemId); $st->execute(); $item=$st->get_result()->fetch_assoc();
            $st2=$db->prepare("SELECT moedas FROM usuarios WHERE id=? FOR UPDATE"); $st2->bind_param('i',$uid); $st2->execute(); $u=$st2->get_result()->fetch_assoc();
            if (!$item || !$u) throw new Exception('Item ou usuário inválido.');
            $ck=$db->prepare("SELECT id FROM inventario WHERE usuario_id=? AND item_id=?"); $ck->bind_param('ii',$uid,$itemId); $ck->execute();
            if ($ck->get_result()->fetch_assoc()) throw new Exception('Você já possui este item.');
            if ((int)$u['moedas'] < (int)$item['preco']) throw new Exception('Moedas insuficientes.');
            $ins=$db->prepare("INSERT INTO inventario(usuario_id,item_id) VALUES(?,?)"); $ins->bind_param('ii',$uid,$itemId); $ins->execute();
            $up=$db->prepare("UPDATE usuarios SET moedas=moedas-? WHERE id=?"); $up->bind_param('ii',$item['preco'],$uid); $up->execute();
            $db->commit(); $db->close(); return [true,'Item comprado!'];
        } catch(Exception $e) { $db->rollback(); $db->close(); return [false,$e->getMessage()]; }
    }
    public static function equip($uid,$itemId) {
        $db=conectar(); $st=$db->prepare("SELECT categoria FROM loja_itens i JOIN inventario v ON v.item_id=i.id WHERE i.id=? AND v.usuario_id=? AND i.ativo=1");
        $st->bind_param('ii',$itemId,$uid); $st->execute(); $item=$st->get_result()->fetch_assoc();
        if (!$item) { $db->close(); return [false,'Item não encontrado no inventário.']; }
        $campo=['chapeu'=>'avatar_chapeu','rosto'=>'avatar_face','roupa'=>'avatar_roupa'][$item['categoria']] ?? null;
        if (!$campo) { $db->close(); return [false,'Este item não é equipável.']; }
        $sql="UPDATE usuarios SET $campo=? WHERE id=?"; $st2=$db->prepare($sql); $st2->bind_param('ii',$itemId,$uid); $st2->execute(); $db->close(); return [true,'Item equipado!'];
    }
}
?>
