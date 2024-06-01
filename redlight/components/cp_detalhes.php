
<?php
    include_once "./connections/connection.php";

    // Query para obter os dados do restaurante e das francesinhas associadas
    $query = "SELECT 
                restaurantes.id_restaurantes,  
                restaurantes.nome, 
                restaurantes.endereco, 
                restaurantes.capa AS capa_restaurante,
                restaurantes.descricao, 
                restaurantes.pontuacao,
                cidades.nome AS cidade_nome,
                francesinhas.id_francesinhas, 
                francesinhas.pontuacao,
                francesinhas.nome AS francesinha_nome, 
                francesinhas.descricao AS francesinha_descricao, 
                francesinhas.preco AS francesinha_preco,
                francesinhas.capa AS capa_francesinha
              FROM 
                restaurantes 
              INNER JOIN 
                cidades ON restaurantes.ref_cidades = cidades.id_cidades
              LEFT JOIN 
                francesinhas_restaurantes ON restaurantes.id_restaurantes = francesinhas_restaurantes.ref_restaurantes
              LEFT JOIN 
                francesinhas ON francesinhas_restaurantes.ref_francesinhas = francesinhas.id_francesinhas
              WHERE 
                restaurantes.id_restaurantes = ?";


    if (isset($_GET['id'])) {
        $id_restaurante = $_GET['id'];

        $link = new_db_connection();

        $stmt = mysqli_stmt_init($link);

        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $id_restaurante);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_restaurante, $nome, $endereco, $capa, $descricao, $pontuacao, $cidade_nome, $id_francesinhas,$pontuacao, $francesinha_nome, $francesinha_descricao, $francesinha_preco , $francesinha_capa);
            mysqli_stmt_store_result($stmt);

            // Verificar se o restaurante foi encontrado
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $francesinhas = [];
                while (mysqli_stmt_fetch($stmt)) {
                    $francesinhas[] = [
                        'id_francesinhas' => $id_francesinhas,
                        'nome' => $francesinha_nome,
                        'descricao' => $francesinha_descricao,
                        'preco' => $francesinha_preco,
                        'capa_francesinha' => $francesinha_capa
                    ];
                }
                ?>
                <section class="sec-filmes pb-5" id="lista-filmes">
                    <div class="container px-lg-5 pt-3">
                        <?php
                            if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                                $previousPage = $_SERVER['HTTP_REFERER'];
                            } else {
                                $previousPage = "restaurante.php";
                            }
                        ?>

                        <a class="btn btn-info mt-4" href="<?=$previousPage?>">Voltar</a>

                        <?php
                            if (isset($_SESSION['ref_perfis']) && $_SESSION['ref_perfis'] == 1) {
                                echo '<a class="btn btn-primary mt-4" href="update_restaurante.php?id=' . $id_restaurante . '">Editar</a>';
                            }
                        ?>
                        <h1 class="pt-5 pb-3"><?= $nome ?></h1>
                        <div class="row d-flex flex-row justify-content-between">
                            <div class="col detalhes">
                                <img class="img-fluid mb-3 rounded" src="./imgs/capas/<?= $capa ?>" />
                            </div>
                            <div class="col detalhes">
                                <h4 class="text-primary"><span class="text-black-50"><?= $endereco ?></span> | <?= $cidade_nome ?></h4>
                                <div class="card pb-2 mt-4 shadow rounded">
                                    <div class="card-body">
                                        <h4 class="text-uppercase text-primary m-0 mt-2">Descrição</h4>
                                        <hr class="my-3 mx-auto" />
                                        <p class="tipo-filme mb-0"><?= $descricao ?></p>
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

                        <div class="row pt-4 mt-5">
                            <h3>Francesinhas Disponíveis</h3>
                            <?php
                            if (!empty($francesinhas)) {
                                foreach ($francesinhas as $francesinha) {
                                    if ($francesinha['id_francesinhas']) {
                                        ?>
                                        <div class="col-md-4 mb-4">
                                            <div class="card shadow-sm">
                                                <img src="./imgs/capas/<?= $francesinha['capa_francesinha'] ?>" class="card-img-top" alt="Capa da Francesinha">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?= $francesinha['nome'] ?></h5>
                                                    <p class="card-text"><?= $francesinha['descricao'] ?></p>
                                                    <p class="card-text"><strong>Preço:</strong> <?= $francesinha['preco'] ?>€</p>
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

                                        <?php
                                    }
                                }
                            } else {
                                echo '<div class="col-12 alert-warning p-4">Não há francesinhas disponíveis para este restaurante!</div>';
                            }
                            ?>
                        </div>
                    </div>
                </section>
                <?php
            } else {
                echo '<div class="alert-warning p-4">O restaurante que procura não existe!</div>';
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Erro na preparação da declaração";
        }

        mysqli_close($link);
    } else {
        header("Location: restaurante.php");
    }
?>
