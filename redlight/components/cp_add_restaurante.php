<?php
include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_add_restaurante.php"; ?>

        <!-- Listar filmes -->
        <div class="row justify-content-center">
            <form class="col-6" action="./scripts/restaurante/sc_add_restaurante.php" method="post" class="was-validated">
                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome:*</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="endereco" class="form-label">Endereço:*</label>
                    <textarea class="form-control" id="endereco" name="endereco" rows="5" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="cidade">Cidade:*</label>
                    <select class="form-control" id="cidade" name="cidade" required>
                        <option value="">Seleciona a cidade</option>
                        <?php
                        $query = "SELECT nome, id_cidades FROM cidades";
                        $link = new_db_connection();
                        $stmt = mysqli_stmt_init($link);
                        mysqli_stmt_prepare($stmt, $query);
                        mysqli_stmt_bind_result($stmt, $nome, $id_cidades);
                        mysqli_stmt_execute($stmt);
                        while (mysqli_stmt_fetch($stmt)) {
                            echo '<option value="' . $id_cidades . '">' . $nome . '</option>';
                        }
                        mysqli_stmt_close($stmt);
                        mysqli_close($link);
                        ?>
                    </select>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="descricao" class="form-label">Descrição:*</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Insert
                </button>
            </form>
        </div>
    </div>
</section>
