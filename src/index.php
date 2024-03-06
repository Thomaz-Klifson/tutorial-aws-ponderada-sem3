<?php

include "../inc/dbinfo.inc";


function AddProduct($connection, $nome, $preco, $quantidade, $data_adicao)
{
    $nome = mysqli_real_escape_string($connection, $nome);
    $preco = mysqli_real_escape_string($connection, $preco);
    $quantidade = mysqli_real_escape_string($connection, $quantidade);
    $data_adicao = mysqli_real_escape_string($connection, $data_adicao);
    $query = "INSERT INTO Produtos (nome, preco, quantidade, data_adicao) VALUES ('$nome', '$preco', '$quantidade', '$data_adicao')";
    if (!mysqli_query($connection, $query)) {
        echo "<p class='error'>Erro ao adicionar produto.</p>";
    } else {
        header("Location: {$_SERVER['REQUEST_URI']}");
        exit();
    }
}


function VerifyProductsTable($connection, $dbName)
{
    if (!TableExists("Produtos", $connection, $dbName)) {
        $query = "CREATE TABLE Produtos (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100),
            preco DECIMAL(10,2),
            quantidade INT,
            data_adicao DATE
        )";
        if (!mysqli_query($connection, $query)) {
            echo "<p class='error'>Erro ao criar tabela.</p>";
        }
    }
}


function TableExists($tableName, $connection, $dbName)
{
    $tableName = mysqli_real_escape_string($connection, $tableName);
    $dbName = mysqli_real_escape_string($connection, $dbName);
    $query = "SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_NAME = '$tableName' AND TABLE_SCHEMA = '$dbName'";
    $result = mysqli_query($connection, $query);
    $exists = mysqli_num_rows($result) > 0;
    mysqli_free_result($result);
    return $exists;
}


$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno()) {
    echo "<p class='error'>Falha na conexão com MySQL: " . mysqli_connect_error() . "</p>";
    exit();
}
$database = mysqli_select_db($connection, DB_DATABASE);
VerifyProductsTable($connection, DB_DATABASE);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $data_adicao = $_POST['data_adicao'];
    AddProduct($connection, $nome, $preco, $quantidade, $data_adicao);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciamento de Produtos</h1>

        <!-- Formulário de adição de produto -->
        <h2>Adicionar Produto</h2>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>
            <label for="quantidade">Quantidade:</label>
            <input type="number" id="quantidade" name="quantidade" required>
            <label for="data_adicao">Data de Adição:</label>
            <input type="date" id="data_adicao" name="data_adicao" required>
            <button type="submit">Adicionar Produto</button>
        </form>

        <!-- Tabela de produtos -->
        <h2>Lista de Produtos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Quantidade</th>
                    <th>Data de Adição</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                $result = mysqli_query($connection, "SELECT * FROM Produtos");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['nome']}</td>";
                    echo "<td>{$row['preco']}</td>";
                    echo "<td>{$row['quantidade']}</td>";
                    echo "<td>{$row['data_adicao']}</td>";
                    echo "</tr>";
                }

                
                mysqli_free_result($result);
                mysqli_close($connection);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>