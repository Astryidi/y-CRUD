<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM tb_usuario WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

    
        if ($row['status'] === 'B') {
            $_SESSION['erro'] = "Usuário bloqueado. Contate o administrador.";
            header("Location: index.php");
            exit();}

        else{    
        if ($password===$row['senha']) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['nome'] = $row['nome'];
            $_SESSION['tipo'] = $row['tipo'];
            $_SESSION['status'] = $row['status'];
            unset($_SESSION['tentativas']);
            if ($row['tipo'] === 'A') {
                header("Location: cadastro.php");
            } else {
                header("Location: home.php");
            }
        
        } else {
            $_SESSION['erro'] = "Senha incorreta!";
            
          
            $_SESSION['tentativas'] = ($_SESSION['tentativas'] ?? 0) + 1;
            
        
            if ($_SESSION['tentativas'] >= 3) {
                $sql_bloqueio = "UPDATE tb_usuario SET status='B' WHERE username=?";
                $stmt_bloqueio = $conn->prepare($sql_bloqueio);
                $stmt_bloqueio->bind_param("s", $username);
                $stmt_bloqueio->execute();
                $_SESSION['erro'] = "Conta bloqueada por muitas tentativas falhas!";
            }
        }
    }
    } else {
        $_SESSION['erro'] = "Usuário não encontrado!";
    }
    
    header("Location: index.php");
    exit();
}

header("Location: index.php");
exit();
?>