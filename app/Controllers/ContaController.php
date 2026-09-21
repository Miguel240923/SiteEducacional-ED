<?php
require_once __DIR__.'/../Models/User.php';
class ContaController {
    private static function render($view,$data=[]) {
        extract($data);$basePath='./';$titulo=$titulo??'Minha conta';
        require __DIR__.'/../../includes/header.php';require __DIR__.'/../Views/'.$view.'.php';require __DIR__.'/../../includes/footer.php';
    }
    private static function autenticar($u) {
        session_regenerate_id(true);
        foreach(array_keys($_SESSION) as $key)if(str_starts_with($key,'quiz_'))unset($_SESSION[$key]);
        $_SESSION['usuario_logado']=true;$_SESSION['usuario_id']=$u['id'];$_SESSION['usuario_nome']=$u['nome'];$_SESSION['usuario_email']=$u['email'];
        header('Location: area-usuario.php');exit;
    }
    public static function login_usuario() {
        if(!empty($_SESSION['usuario_id'])){header('Location: area-usuario.php');exit;}
        $erro='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$email=trim($_POST['email']??'');$senha=$_POST['senha']??'';
            $u=User::findByEmail($email);
            if($u && password_verify($senha,$u['senha']))self::autenticar($u);
            $erro='E-mail ou senha incorretos.';
        }
        self::render('login_usuario',compact('erro')+['titulo'=>'Entre na sua conta']);
    }
    public static function cadastro_usuario() {
        $erro='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$nome=trim($_POST['nome']??'');$email=trim($_POST['email']??'');$senha=$_POST['senha']??'';$confirmar=$_POST['confirmar']??'';
            if(!$nome || mb_strlen($nome)>120 || strlen($email)>180 || !filter_var($email,FILTER_VALIDATE_EMAIL))$erro='Informe nome (até 120 caracteres) e e-mail válidos.';
            elseif(strlen($senha)<6)$erro='A senha precisa ter pelo menos 6 caracteres.';
            elseif($senha!==$confirmar)$erro='As senhas não conferem.';
            else{[$ok,$id,$err]=User::create($nome,$email,$senha);if($ok)self::autenticar(['id'=>$id,'nome'=>$nome,'email'=>$email]);$erro='Esse e-mail já está cadastrado.';}
        }
        self::render('cadastro_usuario',compact('erro')+['titulo'=>'Crie sua conta']);
    }
    public static function perfil() {
        verificarUsuario();$u=usuarioAtual();$erro='';$ok='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$nome=trim($_POST['nome']??'');$email=trim($_POST['email']??'');
            if(!$nome||mb_strlen($nome)>120||strlen($email)>180||!filter_var($email,FILTER_VALIDATE_EMAIL))$erro='Informe nome e e-mail válidos.';
            elseif(User::updateProfile($u['id'],$nome,$email)){$ok='Perfil atualizado!';$_SESSION['usuario_nome']=$nome;$_SESSION['usuario_email']=$email;$u=usuarioAtual();}
            else $erro='Não foi possível atualizar. Verifique se o e-mail já está em uso.';
        }
        self::render('perfil',compact('u','erro','ok')+['titulo'=>'Meu perfil']);
    }
    public static function recuperar_senha() {
        $mensagem='';$erro='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$email=trim($_POST['email']??'');
            if(!filter_var($email,FILTER_VALIDATE_EMAIL))$erro='Informe um e-mail válido.';
            else{
                $token=User::recoveryToken($email);
                $mensagem='Se o e-mail estiver cadastrado, um link de recuperação será disponibilizado.';
                if($token)$mensagem='Link de recuperação gerado para o ambiente local: <a href="redefinir-senha.php?token='.urlencode($token).'">redefinir senha</a>.';
            }
        }
        self::render('recuperar_senha',compact('mensagem','erro')+['titulo'=>'Recuperar senha']);
    }
    public static function redefinir_senha() {
        $token=$_GET['token']??$_POST['token']??'';$erro='';$ok='';
        if($_SERVER['REQUEST_METHOD']==='POST'){
            validarCsrf();$senha=$_POST['senha']??'';$conf=$_POST['confirmar']??'';
            if(strlen($senha)<6||$senha!==$conf)$erro='Use pelo menos 6 caracteres e confirme a senha.';
            elseif(User::resetPassword($token,$senha))$ok='Senha alterada!';
            else $erro='Token inválido ou expirado.';
        }
        self::render('redefinir_senha',compact('token','erro','ok')+['titulo'=>'Redefinir senha']);
    }
    public static function area_usuario() {
        verificarUsuario();$u=usuarioAtual();self::render('area_usuario',compact('u')+['titulo'=>'Minha área']);
    }
}
