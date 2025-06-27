<?php
session_start();


if (isset($_SESSION['username'])) {
    if ($_SESSION['tipo'] === 'A') {
        header("Location: cadastro.php");
    } else {
        header("Location: home.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($_SESSION['erro'])): ?>
        <p style="color: red;"><?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?></p>
    <?php endif; ?>
    <form action="login.php" method="POST">
        <label>Usuário:</label>
        <input type="text" name="username" required><br><br>
        <label>Senha:</label>
        <input type="password" name="password" required><br><br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>