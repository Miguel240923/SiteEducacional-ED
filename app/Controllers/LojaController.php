<?php
require_once __DIR__.'/../Models/Shop.php';
require_once __DIR__.'/../Models/Game.php';
class LojaController {
    private static function show($inventory) {
        verificarUsuario(); $u=usuarioAtual();
        if($_SERVER['REQUEST_METHOD']==='POST') {
            validarCsrf();
            if(isset($_POST['desequipar']))[$ok,$msg]=Shop::unequip($u['id'],(string)$_POST['desequipar']);
            elseif(isset($_POST['equip']))[$ok,$msg]=Shop::equip($u['id'],(int)$_POST['equip']);
            else [$ok,$msg]=Shop::buy($u['id'],(int)($_POST['comprar']??0));
            flash($ok?'sucesso':'erro',$msg);header('Location: '.($inventory?'avatar.php':'loja.php'));exit;
        }
        $items=Shop::items();$owned=Shop::owned($u['id']);$gear=Game::gear($u,$items);
        $abilities=Shop::equippedAbilities($u['id']);$bonuses=Game::bonuses($abilities);
        $titulo=$inventory?'Meu personagem':'Loja de itens';$basePath='./';
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/wardrobe.php';
        require __DIR__.'/../../includes/footer.php';
    }
    public static function loja(){self::show(false);}
    public static function avatar(){self::show(true);}
}
