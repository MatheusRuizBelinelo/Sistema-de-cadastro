<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastrar Cliente</title>
</head>
<body>
    <h2>Cadastro de Cliente</h2>
    <form method="POST" action="adcli.php">
        CPF: <input type="text" name="cpfcli" maxlength="20" placeholder="Digite o CPF" required><br/><br/>
        Nome do Cliente: <input type="text" name="nomecli" maxlength="50" placeholder="Digite o nome" required><br/><br/>
        <input type="submit" value="Salvar" name="botao">
    </form>

</body>
</html>

<?php 
if (isset($_POST["botao"])) {

    require("conecta.php");

    // Obter e limpar os dados
    $cpfcli = htmlspecialchars($_POST["cpfcli"]);
    $nomecli = htmlspecialchars($_POST["nomecli"]);

    // Verificação básica para garantir que CPF e Nome não estejam vazios
    if (empty($cpfcli) || empty($nomecli)) {
        echo "Todos os campos são obrigatórios.";
        exit;
    }

    // Preparar e executar o comando para evitar injeção SQL
    $stmt = $mysqli->prepare("INSERT INTO tb_clientes (cpfcli, nomecli) VALUES (?, ?)");
    $stmt->bind_param("ss", $cpfcli, $nomecli);

    if ($stmt->execute()) {
        echo "<br />Inserido com sucesso<br />";
        echo "<a href='clientes.php'>Voltar</a>";
    } else {
        echo "Erro ao inserir: " . $stmt->error;
    }

    // Fechar a declaração preparada
    $stmt->close();
}
?>
