<?php
class Conteudo {
    public static function listar($estrutura=null) {
        $db=conectar();
        if($estrutura===null)$r=$db->query('SELECT * FROM conteudos ORDER BY estrutura,ordem,id');
        else{$st=$db->prepare('SELECT * FROM conteudos WHERE estrutura=? AND ativo=1 ORDER BY ordem,id');$st->bind_param('s',$estrutura);$st->execute();$r=$st->get_result();}
        $items=$r->fetch_all(MYSQLI_ASSOC);$db->close();return $items;
    }
    public static function buscar($id) {
        $db=conectar();$st=$db->prepare('SELECT * FROM conteudos WHERE id=?');$st->bind_param('i',$id);$st->execute();$item=$st->get_result()->fetch_assoc();$db->close();return $item;
    }
    public static function salvar($data,$id=null) {
        $db=conectar();$estrutura=$data['estrutura'];$tipo=$data['tipo'];$titulo=trim($data['titulo']);$conteudo=$data['conteudo'];$ordem=(int)$data['ordem'];
        if($id===null){$st=$db->prepare('INSERT INTO conteudos(estrutura,tipo,titulo,conteudo,ordem) VALUES(?,?,?,?,?)');$st->bind_param('ssssi',$estrutura,$tipo,$titulo,$conteudo,$ordem);}
        else{$st=$db->prepare('UPDATE conteudos SET estrutura=?,tipo=?,titulo=?,conteudo=?,ordem=? WHERE id=?');$st->bind_param('ssssii',$estrutura,$tipo,$titulo,$conteudo,$ordem,$id);}
        $ok=$st->execute();$db->close();return $ok;
    }
    public static function excluir($id) {
        $db=conectar();$st=$db->prepare('DELETE FROM conteudos WHERE id=?');$st->bind_param('i',$id);$st->execute();$ok=$st->affected_rows===1;$db->close();return $ok;
    }
}
