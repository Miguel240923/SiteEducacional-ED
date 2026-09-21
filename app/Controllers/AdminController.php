<?php
require_once __DIR__.'/../Models/Conteudo.php';
class AdminController {
    private static function render($view,$data=[]) {
        extract($data);$basePath='../';$titulo=$titulo??'Administração';
        require __DIR__.'/../../includes/header.php';require __DIR__.'/../Views/'.$view.'.php';require __DIR__.'/../../includes/footer.php';
    }
    public static function admin_login() {
        if(!empty($_SESSION['admin_logado'])){header('Location: painel.php');exit;}
        $erro='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$usuario=trim($_POST['usuario']??'');$senha=$_POST['senha']??'';
            if($usuario==='admin'&&$senha===(getenv('ED_ADMIN_PASSWORD')?:'admin123')){
                session_regenerate_id(true);$_SESSION['admin_logado']=true;$_SESSION['admin_usuario']=$usuario;header('Location: painel.php');exit;
            }
            $erro='Usuário ou senha incorretos.';
        }
        self::render('admin_login',compact('erro')+['titulo'=>'Administração']);
    }
    public static function admin_painel() {
        verificarAdmin();$conteudos=Conteudo::listar();self::render('admin_painel',compact('conteudos')+['titulo'=>'Painel administrativo']);
    }
    private static function erroFormulario() {
        if(!in_array($_POST['estrutura']??'',['tad','lista_simples','lista_dupla','fila_fifo','fila_prioridade','pilha'],true) || !in_array($_POST['tipo']??'',['teoria','exemplo','codigo','dica','exercicio'],true))return 'Selecione uma estrutura e um tipo válidos.';
        if(!trim($_POST['titulo']??'')||mb_strlen($_POST['titulo'])>255||!trim($_POST['conteudo']??''))return 'Preencha título (até 255 caracteres) e conteúdo.';
        if(filter_var($_POST['ordem']??null,FILTER_VALIDATE_INT,['options'=>['min_range'=>1,'max_range'=>999]])===false)return 'A ordem deve estar entre 1 e 999.';
        return '';
    }
    public static function admin_novo() {
        verificarAdmin();$erro='';$mensagem='';$titulo_form=$_POST['titulo']??'';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$erro=self::erroFormulario();
            if(!$erro){Conteudo::salvar($_POST);header('Location: painel.php?msg='.urlencode('Conteúdo cadastrado com sucesso!'));exit;}
        }
        self::render('admin_novo',compact('erro','mensagem','titulo_form')+['titulo'=>'Novo conteúdo']);
    }
    public static function admin_editar() {
        verificarAdmin();$id=(int)($_GET['id']??0);$item=Conteudo::buscar($id);$erro='';
        if(!$item){header('Location: painel.php?erro='.urlencode('Conteúdo não encontrado.'));exit;}
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$erro=self::erroFormulario();
            if(!$erro){Conteudo::salvar($_POST,$id);header('Location: painel.php?msg='.urlencode('Conteúdo atualizado!'));exit;}
        }
        $dados=$_SERVER['REQUEST_METHOD']==='POST'?$_POST:$item;
        self::render('admin_editar',compact('id','item','dados','erro')+['titulo'=>'Editar conteúdo']);
    }
    public static function admin_excluir() {
        verificarAdmin();if($_SERVER['REQUEST_METHOD']!=='POST'){http_response_code(405);exit('Use o formulário de exclusão.');}validarCsrf();
        $ok=Conteudo::excluir((int)($_POST['id']??0));header('Location: painel.php?'.($ok?'msg=':'erro=').urlencode($ok?'Conteúdo excluído com sucesso!':'Conteúdo não encontrado.'));exit;
    }
}
