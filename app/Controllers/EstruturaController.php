<?php
require_once __DIR__.'/../Models/Estrutura.php';
class EstruturaController {
    public static function mostrar($slug){
        $aula=Estrutura::aula($slug);$titulo=$aula['titulo'];$basePath='../';
        require __DIR__.'/../../includes/header.php';
        require __DIR__.'/../Views/estrutura.php';
        require __DIR__.'/../../includes/footer.php';
    }
}
