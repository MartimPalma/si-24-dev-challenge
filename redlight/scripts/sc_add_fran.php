<?php

    include_once "../connections/connection.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $ingredientes = $_POST['ingredientes'] ?? [];
        $quantidades = $_POST['quantidade'] ?? [];

        // Criar a ligação com a base de dados
        $link = new_db_connection();

        // Inserir dados na tabela de francesinhas
        $query = "INSERT INTO francesinhas (nome, preco, descricao) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 'sds', $nome, $preco, $descricao);

            if (mysqli_stmt_execute($stmt)) {
                $francesinha_id = mysqli_stmt_insert_id($stmt);
                mysqli_stmt_close($stmt);

                // Inserir ingredientes na francesinha
                $query_ingrediente = "INSERT INTO ingredientes_francesinhas (ref_francesinhas, ref_ingredientes, quantidade) VALUES (?, ?, ?)";
                $stmt_ingrediente = mysqli_stmt_init($link);

                if (mysqli_stmt_prepare($stmt_ingrediente, $query_ingrediente)) {
                    foreach ($ingredientes as $id_ingrediente => $ingrediente) {
                        $quantidade = $quantidades[$id_ingrediente];
                        mysqli_stmt_bind_param($stmt_ingrediente, 'iii', $francesinha_id, $id_ingrediente, $quantidade);

                        if (!mysqli_stmt_execute($stmt_ingrediente)) {
                            mysqli_stmt_close($stmt_ingrediente);
                            mysqli_close($link);
                            echo "Erro ao adicionar ingrediente: " . mysqli_stmt_error($stmt_ingrediente);
                            header("Location: ../add_francesinhas.php?error=ingrediente");
                            exit;
                        }
                    }
                    mysqli_stmt_close($stmt_ingrediente);

                    // Redirecionar ou mostrar mensagem de sucesso
                    echo "Francesinha adicionada com sucesso!";
                    header("Location: ../fran.php?success=true");
                    exit;
                } else {
                    echo "Erro ao preparar statement de ingredientes: " . mysqli_error($link);
                }
            } else {
                echo "Erro ao adicionar francesinha: " . mysqli_stmt_error($stmt);
            }
        } else {
            echo "Erro ao preparar statement: " . mysqli_error($link);
        }

        // Fechar a ligação com a base de dados
        mysqli_close($link);
    } else {
        echo "Método de requisição inválido.";
    }

?>