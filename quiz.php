<?php
require_once 'includes/config.php';require_once 'app/Controllers/AppController.php';verificarUsuario();
AppController::quiz();
require_once 'app/Models/Game.php';
$u=usuarioAtual();$items=Shop::items();$gear=Game::gear($u,$items);
$lobby=isset($_GET['preparar']) || (!isset($_SESSION['quiz_perguntas'])&&!isset($_SESSION['quiz_resultado']));
$abilities=$lobby?Shop::equippedAbilities($u['id']):($_SESSION['quiz_habilidades']??[]);
$bonuses=Game::bonuses($abilities);$history=$lobby?Quiz::historico($u['id']):[];
$titulo='Quiz de estruturas';$basePath='./';require 'includes/header.php';
require 'app/Views/quiz.php';require 'includes/footer.php';
