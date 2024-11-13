<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro de Produtos</title>
</head>
<body>
    <h2>Cadastro de Produtos</h2>
    <form method="POST" action="produtos.php">
        Nome do Produto: <input type="text" name="nomeproduto" maxlength="50" required><br><br>
        Descrição: <input type="text" name="descricao" maxlength="255"><br><br>
        Preço: <input type="number" step="0.01" name="preco" required><br><br>
        Quantidade: <input type="number" name="quantidade" required><br><br>
        <input type="submit" value="Cadastrar">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        require("conecta.php");

        $nomeproduto = htmlentities($_POST["nomeproduto"]);
        $descricao = htmlentities($_POST["descricao"]);
        $preco = htmlentities($_POST["preco"]);
        $quantidade = htmlentities($_POST["quantidade"]);

        $stmt = $mysqli->prepare("INSERT INTO tb_produtos (nomeproduto, descricao, preco, quantidade) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssdi", $nomeproduto, $descricao, $preco, $quantidade);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "<br>Produto cadastrado com sucesso!";
        } else {
            echo "<br>Erro ao cadastrar produto: " . $mysqli->error;
        }

        $stmt->close();
        $mysqli->close();
    }
    ?>
</body>
</html>
