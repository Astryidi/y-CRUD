

<?php
session_start(); 



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    require 'conexao.php';

    $username = $_POST['username'];
    $senha = $_POST['senha']; 
    $nome = $_POST['nome'];
    $tipo = strtoupper($_POST['tipo']);
    $status = strtoupper($_POST['status']); 


    if (!in_array($tipo, ['A', 'C'])) {
        die("Tipo de usuário inválido! Use 'A' ou 'C'.");
    }
    if (!in_array($status, ['A', 'B'])) {
        die("Status inválido! Use 'A' (ativo) ou 'B' (bloqueado).");
    }

    $sql = "INSERT INTO tb_usuario (username, senha, nome, tipo, status) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $username, $senha, $nome, $tipo, $status);

    if ($stmt->execute()) {
        $_SESSION['mensagem'] = "Usuário cadastrado com sucesso!";
    } else {
        $_SESSION['erro'] = "Erro ao cadastrar: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
    header("Location: cadastro.php"); 
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Usuário</title>
</head>
<body>
    <h2>Cadastrar novo usuário</h2>

    <?php
 
    if (isset($_SESSION['mensagem'])) {
        echo "<p style='color: green;'>{$_SESSION['mensagem']}</p>";
        unset($_SESSION['mensagem']);
    }
    if (isset($_SESSION['erro'])) {
        echo "<p style='color: red;'>{$_SESSION['erro']}</p>";
        unset($_SESSION['erro']);
    }
    ?>

    <form method="POST" action="cadastro.php">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Senha:</label>
        <input type="password" name="senha" required><br><br>

        <label>Nome completo:</label>
        <input type="text" name="nome" required><br><br>

        <label>Tipo de usuário (A = Admin, C = Comum):</label>
        <input type="text" name="tipo" maxlength="1" pattern="[AC]" title="Use 'A' ou 'C'" required><br><br>

        <label>Status (A = Ativo, B = Bloqueado):</label>
        <input type="text" name="status" maxlength="1" pattern="[AB]" title="Use 'A' ou 'B'" required><br><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>