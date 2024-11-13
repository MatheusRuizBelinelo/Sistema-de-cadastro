<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro de Vendedores</title>
</head>
<body>
    <h2>Cadastro de Vendedores</h2>
    <form method="POST" action="cadastro_vendedores.php">
        Nome: <input type="text" name="nomevendedor" maxlength="50" required><br><br>
        CPF: <input type="text" name="cpfvendedor" maxlength="20" required><br><br>
        Telefone: <input type="text" name="telefonevendedor" maxlength="15" required><br><br>
        Email: <input type="email" name="emailvendedor" maxlength="50" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require("conecta.php");

        $nome = htmlentities($_POST["nomevendedor"]);
        $cpf = htmlentities($_POST["cpfvendedor"]);
        $telefone = htmlentities($_POST["telefonevendedor"]);
        $email = htmlentities($_POST["emailvendedor"]);

        $stmt = $mysqli->prepare("INSERT INTO tb_vendedores (nomevendedor, cpfvendedor, telefonevendedor, emailvendedor) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $cpf, $telefone, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<br>Vendedor cadastrado com sucesso!";
        } else {
            echo "<br>Erro ao cadastrar vendedor: " . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    }
    ?>
</body>
</html>
