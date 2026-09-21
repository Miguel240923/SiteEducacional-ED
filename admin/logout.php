<?php
require_once '../includes/config.php';
// destroi a sessão e manda pro login
$_SESSION = [];
session_destroy();
header('Location: login.php?msg=Você saiu do sistema.');
exit;
