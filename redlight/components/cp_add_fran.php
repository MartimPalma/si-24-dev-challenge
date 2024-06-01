<?php
    include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_add_fran.php"; ?>

        <div class="row justify-content-center">
            <form class="col-6" action="./scripts/sc_add_fran.php" method="post" class="was-validated">
                <div class="mb-3 mt-3">
                    <label for="nome" class="form-label">Nome:*</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="preco" class="form-label">Preço:*</label>
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="descricao" class="form-label">Descrição:*</label>
                    <textarea class="form-control" id="descricao" name="descricao" rows="5" required></textarea>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
                </div>

                <div class="mb-3 mt-3">
                    <label for="ingredientes">Ingredientes:*</label>
                    <div id="ingredientes">
                        <?php
                        $query_ingredientes = "SELECT nome, id_ingredientes FROM ingredientes";
                        $link = new_db_connection();
                        $stmt_ingredientes = mysqli_stmt_init($link);
                        mysqli_stmt_prepare($stmt_ingredientes, $query_ingredientes);
                        mysqli_stmt_bind_result($stmt_ingredientes, $nome_ingrediente, $id_ingrediente);
                        mysqli_stmt_execute($stmt_ingredientes);
                        while (mysqli_stmt_fetch($stmt_ingredientes)) {
                            echo '<div class="input-group mb-3">';
                            echo '<div class="input-group-prepend">';
                            echo '<div class="input-group-text">';
                            echo '<input type="checkbox" name="ingredientes[' . $id_ingrediente . ']" value="' . $id_ingrediente . '"> ' . $nome_ingrediente;
                            echo '</div></div>';
                            echo '<input type="number" name="quantidade[' . $id_ingrediente . ']" class="form-control" placeholder="Quantidade" min="1" disabled>';
                            echo '</div>';
                        }
                        mysqli_stmt_close($stmt_ingredientes);
                        mysqli_close($link);
                        ?>
                    </div>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('#ingredientes input[type="checkbox"]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() { // quando o checkbox mudar de estado
                var input = this.closest('.input-group').querySelector('input[type="number"]');
                if (this.checked) { //verifica se o checkbox está marcado. Se estiver marcado, habilita o input associado e torna obrigatório.
                    input.disabled = false;
                    input.required = true;
                } else {
                    input.disabled = true;
                    input.required = false;
                    input.value = '';
                }
            });
        });
    });
</script>
