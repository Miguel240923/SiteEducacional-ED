<?php
// ============================================
// config.php - Configurações do sistema
// ============================================

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'estruturas_dados');
define('SITE_NOME', 'EstruturaNET');
define('SITE_VERSAO', '1.0');

// Fuso horário
date_default_timezone_set('America/Sao_Paulo');

// Configuração de sessão
session_start();

// Função de conexão
function conectar() {
    $conexao = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conexao->connect_error) {
        die('<div style="font-family:sans-serif;padding:20px;background:#fee;border:1px solid red;margin:20px;">
            <h3>Erro de Conexão com Banco de Dados</h3>
            <p>Verifique se o MySQL está rodando e se o banco <strong>' . DB_NAME . '</strong> foi criado.</p>
            <p>Detalhe: ' . $conexao->connect_error . '</p>
            <p><a href="../sql/estruturas_dados.sql">Clique aqui para ver o arquivo SQL</a></p>
        </div>');
    }

    $conexao->set_charset('utf8mb4');
    return $conexao;
}

// Função de sanitização básica
function limpar($texto) {
    return htmlspecialchars(strip_tags(trim($texto)));
}

// Verifica se está logado no admin
function verificarAdmin() {
    if (!isset($_SESSION['admin_logado']) || $_SESSION['admin_logado'] !== true) {
        header('Location: ../admin/login.php');
        exit;
    }
}
?>
