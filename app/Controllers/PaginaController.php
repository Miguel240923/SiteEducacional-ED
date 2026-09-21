<?php
require_once __DIR__.'/../Models/Conteudo.php';
class PaginaController {
    public static function index() {


$titulo   = 'Início';
$basePath = './';


        $titulo=$titulo_pag??$titulo??SITE_NOME;
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/index.php';
        require __DIR__.'/../../includes/footer.php';
    }
    public static function pages_tad() {


$titulo   = 'TAD — Tipo Abstrato de Dados';
$basePath = '../';


        $titulo=$titulo_pag??$titulo??SITE_NOME;
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/pages_tad.php';
        $extras=Conteudo::listar('tad');
        require __DIR__.'/../Views/complementos.php';
        require __DIR__.'/../../includes/footer.php';
    }
    public static function pages_lista_simples() {


$titulo   = 'Lista Simplesmente Encadeada';
$basePath = '../';


        $titulo=$titulo_pag??$titulo??SITE_NOME;
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/pages_lista_simples.php';
        $extras=Conteudo::listar('lista_simples');
        require __DIR__.'/../Views/complementos.php';
        require __DIR__.'/../../includes/footer.php';
    }
    public static function pages_lista_dupla() {


$titulo   = 'Lista Duplamente Encadeada';
$basePath = '../';


        $titulo=$titulo_pag??$titulo??SITE_NOME;
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/pages_lista_dupla.php';
        $extras=Conteudo::listar('lista_dupla');
        require __DIR__.'/../Views/complementos.php';
        require __DIR__.'/../../includes/footer.php';
    }
}
