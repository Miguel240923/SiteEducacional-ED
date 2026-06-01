<?php
require_once 'includes/config.php';
unset($_SESSION['usuario_logado'], $_SESSION['usuario_id'], $_SESSION['usuario_nome'], $_SESSION['usuario_email']);
header('Location: login-usuario.php?msg=Você saiu do sistema.');
exit;
