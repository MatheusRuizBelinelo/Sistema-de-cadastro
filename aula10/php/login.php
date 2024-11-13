<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        Usuário: <input type="text" name="usuario" required><br/>
        Senha: <input type="password" name="senha" required><br/>
        <input type="submit" value="Entrar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require("conecta.php");
        
        $usuario = $mysqli->real_escape_string($_POST["usuario"]);
        $senha = $mysqli->real_escape_string($_POST["senha"]);

        $query = $mysqli->prepare("SELECT * FROM usuarios WHERE usuario = ? AND senha = ?");
        $query->bind_param("ss", $usuario, $senha);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            header("Location: cadastro.php");
            exit;
        } else {
            echo "Usuário ou senha incorretos.";
        }
    }
    ?>
</body>
</html>
