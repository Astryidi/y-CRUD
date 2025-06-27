<?php
    $host = "localhost";
    $user = "root"; 
    $pass = "";   
    $database = "db_lenda";

    $conn = new mysqli($host, $user, $pass, $database);

    if ($conn->connect_error) {
        die("Falha na conexão: " . $conexao->connect_error);
    }
?>