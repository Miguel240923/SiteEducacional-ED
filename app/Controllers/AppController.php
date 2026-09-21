<?php
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Quiz.php';
require_once __DIR__.'/../Models/Shop.php';
class AppController {
    public static function iniciarSessaoQuiz() {
        $_SESSION['quiz_perguntas']=Quiz::perguntas(10);
        $_SESSION['quiz_pos']=0;
        $_SESSION['quiz_acertos']=0;
        $_SESSION['quiz_respostas']=[];
        $_SESSION['quiz_nonce']=bin2hex(random_bytes(20));
        $_SESSION['quiz_dica_usada']=false;
        $_SESSION['quiz_eliminada']=[];
        unset($_SESSION['quiz_resultado'],$_SESSION['quiz_feedback']);
        $uid=(int)$_SESSION['usuario_id'];
        $_SESSION['quiz_habilidades']=Shop::equippedAbilities($uid);
    }
    public static function quiz() {
        if(isset($_GET['novo'])) {self::iniciarSessaoQuiz();header('Location: quiz.php');exit;}
        if($_SERVER['REQUEST_METHOD']!=='POST')return;
        $pos=$_SESSION['quiz_pos']??0;
        $p=$_SESSION['quiz_perguntas'][$pos]??null;
        if(!$p || !hash_equals($_SESSION['quiz_nonce']??'',(string)($_POST['nonce']??'')) || (string)$pos!==($_POST['pos']??'')) {
            flash('erro','Esta questão já foi respondida ou expirou.');header('Location: quiz.php');exit;
        }
        if(($_POST['acao']??'')==='continuar') {
            unset($_SESSION['quiz_feedback']);header('Location: quiz.php');exit;
        }
        if(isset($_SESSION['quiz_feedback'])) {
            flash('erro','Leia a explicação e continue para a próxima questão.');header('Location: quiz.php');exit;
        }
        $temDica=count(array_filter($_SESSION['quiz_habilidades']??[],fn($h)=>str_contains($h,'Dica extra')))>0;
        if(($_POST['acao']??'')==='dica'){
            if($temDica && !$_SESSION['quiz_dica_usada']){
                foreach(['A','B','C','D'] as $letra)if($letra!==$p['correta']){$_SESSION['quiz_eliminada'][$pos]=$letra;break;}
                $_SESSION['quiz_dica_usada']=true;
            }
        }else{
            $resp=$_POST['resposta']??'';
            if(!in_array($resp,['A','B','C','D'],true) || $resp===($_SESSION['quiz_eliminada'][$pos]??null)){
                flash('erro','Selecione uma alternativa válida.');header('Location: quiz.php');exit;
            }
            $certa=$resp===$p['correta'];
            if($certa)$_SESSION['quiz_acertos']++;
            $alternativas=['A'=>$p['alternativa_a'],'B'=>$p['alternativa_b'],'C'=>$p['alternativa_c'],'D'=>$p['alternativa_d']];
            $_SESSION['quiz_feedback']=['certa'=>$certa,'texto'=>$p['explicacao'],'correta'=>$p['correta'],'pergunta'=>$p['pergunta'],'resposta'=>$resp,'alternativas'=>$alternativas,'estrutura'=>$p['estrutura']];
            $_SESSION['quiz_respostas'][]=['pergunta'=>$p['pergunta'],'resposta'=>$resp,'correta'=>$p['correta'],'explicacao'=>$p['explicacao'],'alternativas'=>$alternativas,'estrutura'=>$p['estrutura']];
            $_SESSION['quiz_pos']++;
            if($_SESSION['quiz_pos']>=count($_SESSION['quiz_perguntas'])){
                $total=count($_SESSION['quiz_perguntas']);$acertos=$_SESSION['quiz_acertos'];
                [$coins,$xp]=Quiz::finalizar((int)$_SESSION['usuario_id'],$total,$acertos,$_SESSION['quiz_habilidades']??[]);
                $_SESSION['quiz_resultado']=compact('coins','xp','total','acertos')+['respostas'=>$_SESSION['quiz_respostas']];
                unset($_SESSION['quiz_perguntas'],$_SESSION['quiz_nonce']);
            }
        }
        header('Location: quiz.php');exit;
    }
}
