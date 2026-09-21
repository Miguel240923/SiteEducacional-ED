<?php
class User {
    public static function findById($id) {
        $db=conectar(); $st=$db->prepare("SELECT * FROM usuarios WHERE id=?"); $st->bind_param('i',$id); $st->execute();
        $u=$st->get_result()->fetch_assoc(); $st->close(); $db->close(); return $u;
    }
    public static function findByEmail($email) {
        $db=conectar(); $st=$db->prepare("SELECT * FROM usuarios WHERE email=? AND ativo=1"); $st->bind_param('s',$email); $st->execute();
        $u=$st->get_result()->fetch_assoc(); $st->close(); $db->close(); return $u;
    }
    public static function create($nome,$email,$senha) {
        $db=conectar(); $hash=password_hash($senha,PASSWORD_DEFAULT);
        $st=$db->prepare("INSERT INTO usuarios(nome,email,senha) VALUES(?,?,?)"); $st->bind_param('sss',$nome,$email,$hash);
        try {$ok=$st->execute();} catch(mysqli_sql_exception $e) {if($e->getCode()!==1062)throw $e;$ok=false;}
        $id=$st->insert_id; $err=$db->errno; $st->close(); $db->close();
        return [$ok,$id,$err];
    }
    public static function addXP($id,$xp) {
        $db=conectar(); $st=$db->prepare("UPDATE usuarios SET nivel=FLOOR((xp+?)/100)+1, xp=xp+? WHERE id=?"); $st->bind_param('iii',$xp,$xp,$id); $st->execute(); $st->close(); $db->close();
    }
    public static function addCoins($id,$coins) {
        $db=conectar(); $st=$db->prepare("UPDATE usuarios SET moedas=moedas+? WHERE id=?"); $st->bind_param('ii',$coins,$id); $st->execute(); $st->close(); $db->close();
    }
    public static function updateProfile($id,$nome,$email) {
        $db=conectar();$st=$db->prepare('UPDATE usuarios SET nome=?,email=? WHERE id=?');$st->bind_param('ssi',$nome,$email,$id);
        try{return $st->execute();}catch(mysqli_sql_exception $e){if($e->getCode()!==1062)throw $e;return false;}finally{$db->close();}
    }
    public static function recoveryToken($email) {
        $u=self::findByEmail($email);if(!$u)return null;
        $token=bin2hex(random_bytes(24));$exp=date('Y-m-d H:i:s',time()+3600);
        $db=conectar();$st=$db->prepare('UPDATE usuarios SET recuperacao_token=?,recuperacao_expira=? WHERE id=?');$st->bind_param('ssi',$token,$exp,$u['id']);$st->execute();$db->close();return $token;
    }
    public static function resetPassword($token,$senha) {
        $db=conectar();$hash=password_hash($senha,PASSWORD_DEFAULT);
        $st=$db->prepare('UPDATE usuarios SET senha=?,recuperacao_token=NULL,recuperacao_expira=NULL WHERE recuperacao_token=? AND recuperacao_expira>NOW() AND ativo=1');$st->bind_param('ss',$hash,$token);$st->execute();$ok=$st->affected_rows===1;$db->close();return $ok;
    }
}
?>
