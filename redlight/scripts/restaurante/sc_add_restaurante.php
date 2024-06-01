<?php

    include_once "../../connections/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $endereco = $_POST['endereco'];
        $cidade = $_POST['cidade'];
        $descricao = $_POST['descricao'];

        // Definir o valor padrão para a capa
        $capa_padrao = '../../imgs/capas/default.png';

        // Criar a ligação com a base de dados
        $link = new_db_connection();

        // Preparar a query para inserir os dados
        $query = "INSERT INTO restaurantes (nome, endereco, ref_cidades, descricao, capa) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'ssiss', $nome, $endereco, $cidade, $descricao, $capa_padrao);

            if (mysqli_stmt_execute($stmt)) {
                // Redirecionar para a página de sucesso
                header("Location: ../../restaurante.php?success=true");
                exit();
            } else {
                // Mostrar mensagem de erro
                echo "Erro ao adicionar restaurante: " . mysqli_stmt_error($stmt);
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

