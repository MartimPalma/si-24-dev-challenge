<?php
include_once "../../connections/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_restaurantes = $_POST['id_restaurantes'];
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $descricao = $_POST['descricao'];
        $ref_cidades = $_POST['cidade'];

        // Criar a ligação com a base de dados
        $link = new_db_connection();

        // Preparar a query para atualizar os dados
        $query = "UPDATE restaurantes SET nome = ?, endereco = ?, descricao = ?, ref_cidades = ? WHERE id_restaurantes = ?";

        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssssi', $nome, $endereco, $descricao, $ref_cidades, $id_restaurantes);

            if (mysqli_stmt_execute($stmt)) {
                // Redirecionar para a página de sucesso
                header("Location: ../../restaurante.php");
                exit();
            } else {
                // Mostrar mensagem de erro
                echo "Erro ao atualizar restaurante: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            // Mostrar mensagem de erro
            echo "Erro ao preparar a query: " . mysqli_error($link);
        }

        // Fechar a ligação com a base de dados
        mysqli_close($link);
    } else {
        echo "Método de requisição inválido.";
    }
?>
