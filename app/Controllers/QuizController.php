<?php
require_once __DIR__.'/../Models/User.php';
require_once __DIR__.'/../Models/Quiz.php';
require_once __DIR__.'/../Models/Shop.php';
require_once __DIR__.'/../Models/Game.php';

/**
 * Fluxo do quiz: recebe as ações (iniciar, responder, pedir dica, continuar),
 * guarda o andamento na sessão e escolhe a tela. Regras de pontuação e acesso
 * ao banco ficam em Quiz e Game.
 */
class QuizController {
    /** Ponto de entrada de quiz.php. */
    public static function quiz() {
        verificarUsuario();
        self::tratarRequisicao();
        self::mostrar();
    }

    /** Volta para o quiz (padrão Post/Redirect/Get), com mensagem opcional. */
    private static function voltar($tipo=null,$msg=null) {
        if($tipo!==null)flash($tipo,$msg);
        header('Location: quiz.php');exit;
    }

    private static function iniciarSessao() {
        $_SESSION['quiz_perguntas']=Quiz::perguntas(10);
        $_SESSION['quiz_pos']=0;
        $_SESSION['quiz_acertos']=0;
        $_SESSION['quiz_respostas']=[];
        $_SESSION['quiz_nonce']=bin2hex(random_bytes(20));
        $_SESSION['quiz_dica_usada']=false;
        $_SESSION['quiz_eliminada']=[];
        unset($_SESSION['quiz_resultado'],$_SESSION['quiz_feedback']);
        $_SESSION['quiz_habilidades']=Shop::equippedAbilities((int)$_SESSION['usuario_id']);
    }

    /** Trata ?novo=1 e os POSTs do formulário; sempre redireciona quando age. */
    private static function tratarRequisicao() {
        if(isset($_GET['novo'])) {self::iniciarSessao();self::voltar();}
        if($_SERVER['REQUEST_METHOD']!=='POST')return;
        $pos=$_SESSION['quiz_pos']??0;
        $p=$_SESSION['quiz_perguntas'][$pos]??null;
        if(!$p || !hash_equals($_SESSION['quiz_nonce']??'',(string)($_POST['nonce']??'')) || (string)$pos!==($_POST['pos']??'')) {
            self::voltar('erro','Esta questão já foi respondida ou expirou.');
        }
        $acao=$_POST['acao']??'';
        if($acao==='continuar') {
            unset($_SESSION['quiz_feedback']);self::voltar();
        }
        if(isset($_SESSION['quiz_feedback'])) {
            self::voltar('erro','Leia a explicação e continue para a próxima questão.');
        }
        if($acao==='dica')self::usarDica($p,$pos);
        else self::registrarResposta($p,$pos);
        self::voltar();
    }

    /** A dica só existe para quem equipou o item e vale uma vez por quiz. */
    private static function usarDica($p,$pos) {
        $temDica=Game::bonuses($_SESSION['quiz_habilidades']??[])['hint'];
        if(!$temDica || $_SESSION['quiz_dica_usada'])return;
        foreach(['A','B','C','D'] as $letra) {
            if($letra!==$p['correta']){$_SESSION['quiz_eliminada'][$pos]=$letra;break;}
        }
        $_SESSION['quiz_dica_usada']=true;
    }

    private static function registrarResposta($p,$pos) {
        $resp=$_POST['resposta']??'';
        if(!in_array($resp,['A','B','C','D'],true) || $resp===($_SESSION['quiz_eliminada'][$pos]??null)) {
            self::voltar('erro','Selecione uma alternativa válida.');
        }
        $certa=$resp===$p['correta'];
        if($certa)$_SESSION['quiz_acertos']++;
        $alternativas=['A'=>$p['alternativa_a'],'B'=>$p['alternativa_b'],'C'=>$p['alternativa_c'],'D'=>$p['alternativa_d']];
        $_SESSION['quiz_feedback']=['certa'=>$certa,'texto'=>$p['explicacao'],'correta'=>$p['correta'],'pergunta'=>$p['pergunta'],'resposta'=>$resp,'alternativas'=>$alternativas,'estrutura'=>$p['estrutura']];
        $_SESSION['quiz_respostas'][]=['pergunta'=>$p['pergunta'],'resposta'=>$resp,'correta'=>$p['correta'],'explicacao'=>$p['explicacao'],'alternativas'=>$alternativas,'estrutura'=>$p['estrutura']];
        $_SESSION['quiz_pos']++;
        if($_SESSION['quiz_pos']>=count($_SESSION['quiz_perguntas']))self::concluir();
    }

    private static function concluir() {
        $total=count($_SESSION['quiz_perguntas']);$acertos=$_SESSION['quiz_acertos'];
        [$coins,$xp]=Quiz::finalizar((int)$_SESSION['usuario_id'],$total,$acertos,$_SESSION['quiz_habilidades']??[]);
        $_SESSION['quiz_resultado']=compact('coins','xp','total','acertos')+['respostas'=>$_SESSION['quiz_respostas']];
        unset($_SESSION['quiz_perguntas'],$_SESSION['quiz_nonce']);
    }

    /** Reúne os dados das telas (preparação, pergunta ou resultado) e renderiza. */
    private static function mostrar() {
        $u=usuarioAtual();$items=Shop::items();$gear=Game::gear($u,$items);
        $lobby=isset($_GET['preparar']) || (!isset($_SESSION['quiz_perguntas'])&&!isset($_SESSION['quiz_resultado']));
        $abilities=$lobby?Shop::equippedAbilities($u['id']):($_SESSION['quiz_habilidades']??[]);
        $bonuses=Game::bonuses($abilities);
        $history=$lobby?Quiz::historico($u['id']):[];
        $titulo='Quiz de estruturas';$basePath='./';
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/quiz.php';
        require __DIR__.'/../../includes/footer.php';
    }
}
