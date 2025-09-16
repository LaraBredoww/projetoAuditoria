<?php
if (!function_exists('conecta_db')) {
    function conecta_db() {
        $db_name = "auditoria_db"; 
        $user = "root"; 
        $pass = ""; 
        $server = "localhost:3306"; 
    
        $conn = new mysqli($server, $user, $pass, $db_name);
    
        if ($conn->connect_error) {
            die("Erro na conexão com o banco de dados: " . $conn->connect_error);
        }
    
        $conn->set_charset("utf8");
    
        return $conn;
    }
}
?>
