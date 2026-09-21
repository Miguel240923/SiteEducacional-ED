<?php
require_once __DIR__.'/../Models/Conteudo.php';

/** Páginas públicas de teoria: início e as aulas de TAD, lista simples e lista dupla. */
class PaginaController {
    /**
     * Monta a página: cabeçalho, View da aula e, quando há uma estrutura,
     * o material complementar cadastrado pelo administrador.
     */
    private static function renderizar($view,$titulo,$basePath,$estrutura=null) {
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/'.$view.'.php';
        if($estrutura!==null) {
            $extras=Conteudo::listar($estrutura);
            require __DIR__.'/../Views/complementos.php';
        }
        require __DIR__.'/../../includes/footer.php';
    }

    public static function index() {
        self::renderizar('index','Início','./');
    }
    public static function pages_tad() {
        self::renderizar('pages_tad','TAD — Tipo Abstrato de Dados','../','tad');
    }
    public static function pages_lista_simples() {
        self::renderizar('pages_lista_simples','Lista Simplesmente Encadeada','../','lista_simples');
    }
    public static function pages_lista_dupla() {
        self::renderizar('pages_lista_dupla','Lista Duplamente Encadeada','../','lista_dupla');
    }
}
