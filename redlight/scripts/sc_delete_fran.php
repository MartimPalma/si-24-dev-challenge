<?php

include_once "../../connections/connection.php";

    if (isset($_GET['id'])) {

        $id_restaurante = $_GET['id'];

        $deleted = 1;

        // Crie a conexão com o banco de dados
        $link = new_db_connection();

        // Prepare a query de atualização
        $query = "UPDATE francesinhas SET deleted = ? WHERE id_francesinhas = ?";

        // Inicie a preparação da declaração
        if ($stmt = mysqli_stmt_init($link)) {
            if (mysqli_stmt_prepare($stmt, $query)) {
                // Vincule os parâmetros
                mysqli_stmt_bind_param($stmt, 'ii', $deleted, $id_francesinha);

                // Execute a declaração
                if (mysqli_stmt_execute($stmt)) {
                    echo "Coluna 'deleted' atualizada com sucesso.";
                    header("Location: ../../fran.php?success=true");
                } else {
                    echo "Erro ao atualizar a coluna 'deleted': " . mysqli_stmt_error($stmt);
                    header("Location: ../../fran.php?error=deleted");
                }
            } else {
                echo "Erro ao preparar a declaração: " . mysqli_stmt_error($stmt);
                header("Location: ../../fran.php?error=stmtfailed");

            }

            // Feche a declaração
            mysqli_stmt_close($stmt);
        } else {
            echo "Erro ao iniciar a declaração: " . mysqli_error($link);
            header("Location: ../../fran.php?error=stmtfailed");

        }

        // Feche a conexão
        mysqli_close($link);
    } else {
        echo "Requisição inválida.";
    }
?>
