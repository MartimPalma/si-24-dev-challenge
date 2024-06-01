<?php
    include_once "./connections/connection.php";
?>

<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_fran.php" ?>

        <!-- Listar filmes -->
        <div class="row justify-content-center">
            <?php

            if ((!isset($_POST['pesquisa']) || !$_POST['pesquisa'])) {
                // Query para obter os dados
                $query = "SELECT id_francesinhas, nome, preco ,capa FROM francesinhas";

                // ligação com a base de dados//
                $link = new_db_connection();
                // Iniciar a ligação
                $stmt = mysqli_stmt_init($link);
                // Preparar a ligação
                mysqli_stmt_prepare($stmt,$query);

                mysqli_stmt_execute($stmt);
                //atribuição dos dados a variáveis
                mysqli_stmt_bind_result($stmt, $id_francesinhas, $nome, $preco, $capa);


                while (mysqli_stmt_fetch($stmt)) {
                    ?>
                    <div class='col-md-4 mb-md-0 pb-5'>
                        <div class='card pb-2 h-100 shadow rounded'>
                            <div class='capas-preview rounded-top' style='background-image: url("./imgs/capas/<?= $capa ?>")'></div>
                            <div class='card-body text-center'>
                                <h4 class='text-uppercase m-0 mt-2'><?= $nome ?></h4>
                                <hr class='my-3 mx-auto'/>
                                <div class='tipo-filme mb-0 small text-black-50'><?= $preco ?>€</div>
                                <a href='francesinha_detail.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-primary'>
                                    <b>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                        </svg>
                                    </b>
                                </a>
                                <?php
                                if ( (isset($_SESSION['id'])) && $_SESSION['ref_perfis'] == 1) {
                                    ?>
                                    <a href='scripts/sc_delete_fran.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-danger tipo-filme mb-0 small text-black-50'>
                                        <b>
                                            <i class=' text-primary'>Delete</i>
                                        </b>
                                    </a>
                                    <a href='update_fran.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-secondary tipo-filme mb-0 small text-black-50'>
                                        <b>
                                            Editar
                                        </b>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                // Fechar ligação
                mysqli_stmt_close($stmt);
                // Fechar ligação
                mysqli_close($link);
            } else {
                $pesquisa = $_POST['pesquisa'];

                $query = "SELECT id_francesinhas, nome, preco ,capa FROM francesinhas
                          WHERE nome LIKE ? ";

                // ligação com a base de dados
                $link = new_db_connection();
                // Iniciar a ligação
                $stmt = mysqli_stmt_init($link);
                // Preparar a ligação
                if (mysqli_stmt_prepare($stmt, $query)) {
                    $param = '%' . $pesquisa . '%';
                    mysqli_stmt_bind_param($stmt, 's',  $param);
                    // Executar a ligação
                    mysqli_stmt_execute($stmt);

                    mysqli_stmt_bind_result($stmt, $id_francesinhas, $nome, $preco, $capa);
                    mysqli_stmt_store_result($stmt);

                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        // Executa o loop para mostrar os dados do restaurante
                        while (mysqli_stmt_fetch($stmt)) {
                            ?>
                            <div class='col-md-4 mb-md-0 pb-5'>
                                <div class='card pb-2 h-100 shadow rounded'>
                                    <div class='capas-preview' style='background-image: url("./imgs/capas/<?= $capa ?>")'></div>
                                    <div class='card-body text-center'>
                                        <h4 class='text-uppercase m-0 mt-2'><?= $nome ?></h4>
                                        <hr class='my-3 mx-auto'/>
                                        <div class='tipo-filme mb-0 small text-black-50'><?= $preco ?>€</div>
                                        <a href='francesinha_detail.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-primary'>
                                            <b>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                                </svg>
                                            </b>
                                        </a>
                                        <?php
                                        if ( (isset($_SESSION['id'])) && $_SESSION['ref_perfis'] == 1) {
                                            ?>
                                            <a href='scripts/sc_delete_fran.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-danger tipo-filme mb-0 small text-black-50'>
                                                <b>
                                                    <i class=' text-primary'>Delete</i>
                                                </b>
                                            </a>
                                            <a href='update_fran.php?id=<?= $id_francesinhas ?>' class='mt-2 btn btn-outline-secondary tipo-filme mb-0 small text-black-50'>
                                                <b>
                                                    Editar
                                                </b>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }
                    } else {
                        // Verifica se a variável $_SERVER['HTTP_REFERER'] está definida e não vazia
                        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                            // Obtém a URL da página anterior
                            $previousPage = $_SERVER['HTTP_REFERER'];
                        } else {
                            // Se não estiver definida ou vazia, define a URL de uma página padrão
                            $previousPage = "francesinha.php";
                        }
                        ?>

                        <div class="alert-warning p-4">Nenhuma francesinha corresponde à sua pesquisa!</div>
                        <a class="btn btn-info mt-4" href="<?=$previousPage?>">Voltar</a>
                        <?php
                    }
                    // Fechar ligação
                    mysqli_stmt_close($stmt);
                }
                // Fechar ligação
                mysqli_close($link);
            }
            ?>
        </div>
    </div>
</section>

