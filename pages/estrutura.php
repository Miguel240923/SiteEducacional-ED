<?php
$slug=$_GET['estrutura']??'fila_fifo';
$permitidas=['fila_fifo'=>'fila-fifo.php','fila_prioridade'=>'fila-prioridade.php','pilha'=>'pilha.php'];
header('Location: '.($permitidas[$slug]??'fila-fifo.php')); exit;