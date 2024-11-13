<?php
require("conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário com validação
    $cliente_nome = htmlentities($_POST["cliente_nome"]);
    $cliente_celular = htmlentities($_POST["cliente_celular"]);
    $cliente_email = htmlentities($_POST["cliente_email"]);
    $produto_nome = htmlentities($_POST["produto_nome"]);
    $preco = (float)$_POST["preco"];
    $quantidade = (int)$_POST["quantidade"];
    $frete = htmlentities($_POST["frete"]);

    // Calcula o valor total
    $total = $preco * $quantidade;

    // Insere os dados na tabela `vendas` com uma declaração preparada
    $stmt = $mysqli->prepare("INSERT INTO vendas (cliente_nome, cliente_celular, cliente_email, produto_nome, preco, quantidade, frete, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssdids", $cliente_nome, $cliente_celular, $cliente_email, $produto_nome, $preco, $quantidade, $frete, $total);

    // Executa e verifica se a operação foi bem-sucedida
    if ($stmt->execute()) {
        echo "Venda registrada com sucesso!<br>";
        echo "Total da venda: R$ " . number_format($total, 2, ',', '.');
    } else {
        echo "Erro ao registrar venda: " . $stmt->error;
    }

    $stmt->close();
}
?>
