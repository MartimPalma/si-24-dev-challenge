<?php
include_once "./connections/connection.php";

if (isset($_GET['id'])) {
    $id_restaurantes = $_GET['id'];

    // Query para obter os dados do restaurante
    $query = "SELECT nome, endereco, descricao, capa, ref_cidades FROM restaurantes WHERE id_restaurantes = ?";
    $link = new_db_connection();
    $stmt = mysqli_stmt_init($link);

    if (mysqli_stmt_prepare($stmt, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id_restaurantes);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $nome, $endereco, $descricao, $capa, $ref_cidades);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        echo "Erro ao preparar a query: " . mysqli_error($link);
        mysqli_close($link);
        exit();
    }

    // Fechar a ligação com a base de dados
    mysqli_close($link);
} else {
    echo "ID do restaurante não especificado.";
    exit();
}
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <div class="row justify-content-center">

            <?php
            include_once "./components/cp_intro_update_restaurante.php";
            ?>

            <form class="col-6" action="./scripts/restaurante/sc_update_restaurante.php" method="post" enctype="multipart/form-data" class="was-validated">
                <input type="hidden" name="id_restaurantes" value="<?= $id_restaurantes ?>">

                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome:*</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= $nome ?>" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="endereco" class="form-label">Endereço:*</label>
                    <textarea class="form-control" id="endereco" name="endereco" rows="5" required><?= $endereco ?></textarea>
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
                    <label for="cidade" class="form-label">Cidade:*</label>
                    <select class="form-control" id="cidade" name="cidade" required>
                        <option value="">Seleciona a cidade</option>
                        <?php
                        $link = new_db_connection();
                        $query_cidades = "SELECT id_cidades, nome FROM cidades";
                        $stmt_cidades = mysqli_stmt_init($link);

                        if (mysqli_stmt_prepare($stmt_cidades, $query_cidades)) {
                            mysqli_stmt_execute($stmt_cidades);
                            mysqli_stmt_bind_result($stmt_cidades, $id_cidades, $nome_cidade);
                            while (mysqli_stmt_fetch($stmt_cidades)) {
                                $selected = ($id_cidades == $ref_cidades) ? 'selected' : '';
                                echo "<option value='$id_cidades' $selected>$nome_cidade</option>";
                            }
                            mysqli_stmt_close($stmt_cidades);
                        }

                        mysqli_close($link);
                        ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <button type="submit" class="btn btn-primary">Atualizar</button>
            </form>

        </div>
    </div>
</section>
