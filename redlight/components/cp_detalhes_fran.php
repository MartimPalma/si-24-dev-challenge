<?php
    include_once "./connections/connection.php";

        function getIngredients($francesinha_id) {
            $query = "SELECT ingredientes.nome, ingredientes_francesinhas.quantidade 
                      FROM francesinhas
                      INNER JOIN ingredientes_francesinhas ON francesinhas.id_francesinhas = ingredientes_francesinhas.ref_francesinhas
                      INNER JOIN ingredientes ON ingredientes_francesinhas.ref_ingredientes = ingredientes.id_ingredientes
                      WHERE francesinhas.id_francesinhas = ?";

            $link = new_db_connection();
            $stmt = mysqli_stmt_init($link);

            if (mysqli_stmt_prepare($stmt, $query)) {
                mysqli_stmt_bind_param($stmt, "i", $francesinha_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $ingredient, $quantity);
                mysqli_stmt_store_result($stmt);

                $ingredients = [];

                while (mysqli_stmt_fetch($stmt)) {
                    $ingredients[] = ['name' => $ingredient, 'quantity' => $quantity];
                }

                mysqli_stmt_close($stmt);
                mysqli_close($link);

                return $ingredients;
            } else {
                return false;
            }
        }



// Query para obter os dados da francesinha e os restaurantes associados
    $query = "SELECT 
                f.id_francesinhas, 
                f.nome AS francesinha_nome, 
                f.pontuacao,
                f.descricao, 
                f.preco, 
                f.capa AS francesinha_capa,
                r.id_restaurantes, 
                r.nome AS restaurante_nome, 
                r.endereco AS restaurante_endereco, 
                r.capa AS restaurante_capa,
                c.nome AS cidade_nome
              FROM 
                francesinhas f
              LEFT JOIN 
                francesinhas_restaurantes fr ON f.id_francesinhas = fr.ref_francesinhas
              LEFT JOIN 
                restaurantes r ON fr.ref_restaurantes = r.id_restaurantes
              LEFT JOIN 
                cidades c ON r.ref_cidades = c.id_cidades
              WHERE 
                f.id_francesinhas = ?";

    if (isset($_GET['id'])) {
        $id_francesinhas = $_GET['id'];

        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_francesinhas);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_francesinhas, $francesinha_nome, $pontuacao, $descricao, $preco, $francesinha_capa, $id_restaurantes, $restaurante_nome, $restaurante_endereco, $restaurante_capa, $cidade_nome);
            mysqli_stmt_store_result($stmt);

            // Verificar se a francesinha foi encontrada
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $restaurantes = [];
                while (mysqli_stmt_fetch($stmt)) {
                    if ($id_restaurantes) {
                        $restaurantes[] = [
                            'id_restaurantes' => $id_restaurantes,
                            'nome' => $restaurante_nome,
                            'endereco' => $restaurante_endereco,
                            'capa' => $restaurante_capa,
                            'cidade_nome' => $cidade_nome
                        ];
                    }
                }
                ?>
                <section class="sec-filmes pb-5" id="lista-filmes">
                    <div class="container px-lg-5 pt-3">
                        <?php
                            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                                $previousPage = $_SERVER['HTTP_REFERER'];
                            } else {
                                $previousPage = "francesinha.php";
                            }
                        ?>

                        <a class="btn btn-info mt-4" href="<?=$previousPage?>">Voltar</a>

                        <?php
                            if (isset($_SESSION['ref_perfis']) && $_SESSION['ref_perfis'] == 1) {
                                echo '<a class="btn btn-primary mt-4" href="update_fran.php?id=' . $id_francesinhas . '">Editar</a>';
                            }
                        ?>
                        <h1 class="pt-5 pb-3"><?= $francesinha_nome ?></h1>
                        <div class="row d-flex flex-row justify-content-between">
                            <div class="col detalhes">
                                <img class="img-fluid mb-3 rounded" src="./imgs/capas/<?= $francesinha_capa ?>" />
                            </div>
                            <div class="col detalhes">
                                <div class="card pb-2 shadow rounded">
                                    <div class="card-body">
                                        <h4 class="text-uppercase text-primary m-0 mt-2">Descrição</h4>
                                        <hr class="my-3 mx-auto" />
                                        <p class="tipo-filme mb-3"><?= $descricao ?></p>
                                        <div class="tipo-filme mb-0 small text-black-50 mt-3">
                                            <?php
                                                $francesinha_id = $id_francesinhas;
                                                $ingredients = getIngredients($francesinha_id);

                                                echo "<strong>Ingredientes da $francesinha_nome:</strong><br>";

                                                if ($ingredients !== false && !empty($ingredients)) {
                                                    foreach ($ingredients as $ingredient) {
                                                        echo "<span class='fs-5 fw-bold'>.</span> <span class='text-primary'>{$ingredient['name']}</span> ({$ingredient['quantity']})<br>";
                                                    }
                                                } else {
                                                    echo "- Ainda não tem ingredientes associados<br>";
                                                }
                                            ?>
                                        </div>
                                        <div class="tipo-filme mb-0 small text-black-50 mt-3"><strong>Preço:</strong> <?= $preco ?>€</div>
                                        <div class="tipo-filme mb-0 small text-black-50 mt-3">
                                            <strong>Pontuação:</strong>
                                            <?php
                                                for ($i = 0; $i < 5; $i++) {
                                                    if ($i < $pontuacao) {
                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill text-warning" viewBox="0 0 16 16"><path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73-3.522-3.356c-.33-.314-.158-.888.283-.95l4.898-.696 2.124-4.287c.197-.397.73-.397.927 0l2.124 4.287 4.898.696c.441.062.613.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/></svg>';
                                                    } else {
                                                        echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star text-warning" viewBox="0 0 16 16"><path d="M2.866 14.85c-.078.443.36.79.746.592L8 13.187l4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.158-.888-.283-.95l-4.898-.696-2.124-4.287c-.197-.397-.73-.397-.927 0L6.178 3.88l-4.898.696c-.441.062-.613.636-.282.95l3.522 3.356-.83 4.73zM8 12.094l-3.686 1.896.7-3.978L2.184 6.74l4.027-.573L8 2.427l1.789 3.74 4.027.573-2.828 2.673.7 3.978L8 12.094z"/></svg>';
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row pt-4 mt-3">
                            <h3 class="pt-5 pb-3">Restaurantes que servem esta Francesinha</h3>
                            <?php
                            if (!empty($restaurantes)) {
                                foreach ($restaurantes as $restaurante) {
                                    ?>
                                    <div class="col-md-4 mb-md-0 pb-5">
                                        <div class="card pb-2 h-100 shadow rounded">
                                            <div class="capas-preview" style='background-image: url("./imgs/capas/<?= $restaurante['capa'] ?>")'></div>
                                            <div class="card-body text-center">
                                                <h4 class="text-uppercase m-0 mt-2"><?= $restaurante['nome'] ?></h4>
                                                <hr class="my-3 mx-auto"/>
                                                <div class="tipo-filme mb-0 small text-black-50"><?= $restaurante['endereco'] ?> | <?= $restaurante['cidade_nome'] ?></div>
                                                <a href='restaurante_detail.php?id=<?= $restaurante['id_restaurantes'] ?>' class='mt-2 btn btn-outline-primary'>
                                                    <b>
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                        </svg>
                                                    </b>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo '<div class="col-12 alert-warning p-4">Não há restaurantes que servem esta francesinha!</div>';
                            }
                            ?>
                        </div>
                    </div>
                </section>

                <?php
            } else {
                echo '<div class="alert-warning p-4">A francesinha que procura não existe!</div>';
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da declaração";
        }

        mysqli_close($link);
    } else {
        header("Location: francesinha.php");
    }
?>
