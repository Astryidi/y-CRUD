<?php
session_start();


if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

if ($_SESSION['tipo'] === 'A') {
    header("Location: cadastro.php"); 
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['nome'] ?? 'Usuário'); ?>!</h1>
    <p>Usuário: <?php echo htmlspecialchars($_SESSION['username']); ?></p>
    <a href="logout.php">Sair</a>
</body>
</html>