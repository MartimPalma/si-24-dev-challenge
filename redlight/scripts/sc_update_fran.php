<?php
    include_once "../connections/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id_francesinhas = $_POST['id_francesinhas'];
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $pontuacao = $_POST['pontuacao'];
        $ingredientes = $_POST['ingredientes'];

        $link = new_db_connection();

        // Iniciar transação
        mysqli_begin_transaction($link);

        // Atualizar os dados da francesinha
        $query_update = "UPDATE francesinhas SET nome = ?, descricao = ?, preco = ?, pontuacao = ? WHERE id_francesinhas = ?";
        $stmt_update = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt_update, $query_update)) {
            mysqli_stmt_bind_param($stmt_update, "ssdii", $nome, $descricao, $preco, $pontuacao, $id_francesinhas);

            if (!mysqli_stmt_execute($stmt_update)) {
                echo "Erro ao atualizar francesinha: " . mysqli_stmt_error($stmt_update);
                mysqli_stmt_close($stmt_update);
                mysqli_close($link);
                exit();
            }

            mysqli_stmt_close($stmt_update);
        } else {
            echo "Erro ao preparar a query de atualização: " . mysqli_error($link);
            mysqli_close($link);
            exit();
        }

        // Remover ingredientes atuais
        $query_delete_ingredientes = "DELETE FROM ingredientes_francesinhas WHERE ref_francesinhas = ?";
        $stmt_delete = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt_delete, $query_delete_ingredientes)) {
            mysqli_stmt_bind_param($stmt_delete, "i", $id_francesinhas);

            if (!mysqli_stmt_execute($stmt_delete)) {
                mysqli_rollback($link);
                echo "Erro ao remover ingredientes antigos: " . mysqli_stmt_error($stmt_delete);
                mysqli_stmt_close($stmt_delete);
                mysqli_close($link);
                exit();
            }

            mysqli_stmt_close($stmt_delete);
        } else {
            echo "Erro ao preparar a query de remoção de ingredientes: " . mysqli_error($link);
            mysqli_close($link);
            exit();
        }

        // Adicionar novos ingredientes
        $query_insert_ingredientes = "INSERT INTO ingredientes_francesinhas (ref_francesinhas, ref_ingredientes, quantidade) VALUES (?, ?, ?)";
        $stmt_insert = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt_insert, $query_insert_ingredientes)) {
            foreach ($ingredientes as $id_ingrediente => $quantidade) {
                if ($quantidade > 0) {
                    mysqli_stmt_bind_param($stmt_insert, "iii", $id_francesinhas, $id_ingrediente, $quantidade);

                    if (!mysqli_stmt_execute($stmt_insert)) {
                        mysqli_rollback($link);
                        echo "Erro ao adicionar novos ingredientes: " . mysqli_stmt_error($stmt_insert);
                        mysqli_stmt_close($stmt_insert);
                        mysqli_close($link);
                        exit();
                    }
                }
            }

            mysqli_stmt_close($stmt_insert);
        } else {
            echo "Erro ao preparar a query de inserção de ingredientes: " . mysqli_error($link);
            mysqli_close($link);
            exit();
        }

        // Confirmar a transação
        mysqli_commit($link);
        mysqli_close($link);

        // Redirecionar para a página de sucesso
        header("Location: ../fran.php");
        exit();
    } else {
        echo "Método de requisição inválido.";
    }
?>

