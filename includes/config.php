<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'estruturas_dados');
define('SITE_NOME', 'EstruturaNET');
define('SITE_VERSAO', '2.0');

date_default_timezone_set('America/Sao_Paulo');
if (session_status() === PHP_SESSION_NONE) session_start();

function conectar() {
    try { $db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME); }
    catch (mysqli_sql_exception $e) { http_response_code(503); exit('Banco indisponível. Confira o serviço MySQL e as instruções no README.md.'); }
    if ($db->connect_error) {
        die('<div style="font-family:sans-serif;padding:24px"><h2>Banco de dados indisponível</h2><p>Crie o banco <b>'.DB_NAME.'</b> usando <a href="sql/estruturas_dados.sql">sql/estruturas_dados.sql</a> e confira o MySQL/MariaDB.</p></div>');
    }
    $db->set_charset('utf8mb4');
    $db->query("SET time_zone = '-03:00'");
    return $db;
}
function limpar($texto) { return htmlspecialchars(strip_tags(trim((string)$texto)), ENT_QUOTES, 'UTF-8'); }
function flash($tipo, $msg) { $_SESSION['flash'] = ['tipo'=>$tipo,'msg'=>$msg]; }
function mostrarFlash() {
    if (!empty($_SESSION['flash'])) { $f=$_SESSION['flash']; unset($_SESSION['flash']); echo '<div class="alerta alerta-'.htmlspecialchars($f['tipo']).'">'.htmlspecialchars($f['msg']).'</div>'; }
}
function verificarUsuario() {
    if (empty($_SESSION['usuario_id'])) { header('Location: '.((($GLOBALS['basePath'] ?? './'))).'login-usuario.php'); exit; }
    if (!usuarioAtual()) { unset($_SESSION['usuario_id'],$_SESSION['usuario_logado']); header('Location: login-usuario.php'); exit; }
}
function campoCsrf() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf']=bin2hex(random_bytes(32));
    return '<input type="hidden" name="csrf" value="'.$_SESSION['csrf'].'">';
}
function validarCsrf() {
    if (empty($_SESSION['csrf']) || !hash_equals($_SESSION['csrf'], (string)($_POST['csrf']??''))) {
        http_response_code(403); exit('Formulário expirado. Volte à página e tente novamente.');
    }
}
function verificarAdmin() {
    if (empty($_SESSION['admin_logado'])) { header('Location: ../admin/login.php'); exit; }
}
function usuarioAtual() {
    if (empty($_SESSION['usuario_id'])) return null;
    $db=conectar(); $id=(int)$_SESSION['usuario_id'];
    $st=$db->prepare("SELECT * FROM usuarios WHERE id=? AND ativo=1"); $st->bind_param('i',$id); $st->execute();
    $u=$st->get_result()->fetch_assoc(); $st->close(); $db->close(); return $u;
}
?>
