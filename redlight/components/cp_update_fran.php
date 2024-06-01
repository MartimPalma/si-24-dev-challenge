<?php
include_once "./connections/connection.php";

if (isset($_GET['id'])) {
    $id_francesinhas = $_GET['id'];

    // Query para obter os dados da francesinha
    $query = "SELECT nome, descricao, preco, pontuacao FROM francesinhas WHERE id_francesinhas = ?";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_francesinhas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $descricao, $preco, $pontuacao);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a query: " . mysqli_error($link);
        mysqli_close($link);
        exit();
    }

    // Query para obter os ingredientes da francesinha
    $query_ingredientes = "SELECT ingredientes.id_ingredientes, ingredientes.nome, ingredientes_francesinhas.quantidade 
                               FROM ingredientes 
                               INNER JOIN ingredientes_francesinhas 
                               ON ingredientes.id_ingredientes = ingredientes_francesinhas.ref_ingredientes 
                               WHERE ingredientes_francesinhas.ref_francesinhas = ?";

    $stmt = mysqli_stmt_init($link);
    $ingredientes_francesinha = [];

    if (mysqli_stmt_prepare($stmt, $query_ingredientes)) {
        mysqli_stmt_bind_param($stmt, "i", $id_francesinhas);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_ingredientes, $ingrediente_nome, $quantidade);
        while (mysqli_stmt_fetch($stmt)) {
            $ingredientes_francesinha[] = ['id_ingredientes' => $id_ingredientes, 'nome' => $ingrediente_nome, 'quantidade' => $quantidade];
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a query dos ingredientes: " . mysqli_error($link);
        mysqli_close($link);
        exit();
    }

    // Query para obter todos os ingredientes
    $query_all_ingredientes = "SELECT id_ingredientes, nome FROM ingredientes";
    $stmt = mysqli_stmt_init($link);
    $todos_ingredientes = [];

    if (mysqli_stmt_prepare($stmt, $query_all_ingredientes)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $id_ingredientes, $ingrediente_nome);
        while (mysqli_stmt_fetch($stmt)) {
            $todos_ingredientes[] = ['id_ingredientes' => $id_ingredientes, 'nome' => $ingrediente_nome];
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a query de todos os ingredientes: " . mysqli_error($link);
        mysqli_close($link);
        exit();
    }

    // Fechar a ligação com a base de dados
    mysqli_close($link);
} else {
    echo "ID da francesinha não especificado.";
    exit();
}
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <div class="row justify-content-center">

            <?php
            include_once "./components/cp_intro_update_fran.php";
            ?>

            <form class="col-6" action="./scripts/sc_update_fran.php" method="post" enctype="multipart/form-data" class="was-validated">
                <input type="hidden" name="id_francesinhas" value="<?= $id_francesinhas ?>">

                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome:*</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="descricao" class="form-label">Descrição:*</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" required><?= $descricao ?></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="preco" class="form-label">Preço:*</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" value="<?= $preco ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="pontuacao" class="form-label">Pontuação:*</label>
                    <input type="number" class="form-control" id="pontuacao" name="pontuacao" value="<?= $pontuacao ?>" min="0" max="5" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="ingredientes" class="form-label">Ingredientes:*</label>
                    <?php
                    foreach ($todos_ingredientes as $ingrediente) {
                        $quantidade = 0;
                        foreach ($ingredientes_francesinha as $ingrediente_fran) {
                            if ($ingrediente['id_ingredientes'] == $ingrediente_fran['id_ingredientes']) {
                                $quantidade = $ingrediente_fran['quantidade'];
                                break;
                            }
                        }
                        echo "<div class='mb-3'>";
                        echo "<label for='ingrediente_" . $ingrediente['id_ingredientes'] . "'>" . $ingrediente['nome'] . "</label>";
                        echo "<input type='number' class='form-control' id='ingrediente_" . $ingrediente['id_ingredientes'] . "' name='ingredientes[" . $ingrediente['id_ingredientes'] . "]' value='" . $quantidade . "' min='0'>";
                        echo "</div>";
                    }
                    ?>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>
        </div>
    </div>
</section>
