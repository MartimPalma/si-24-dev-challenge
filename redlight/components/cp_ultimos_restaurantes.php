<?php
    include_once "./connections/connection.php";
?>

    <section class="sec-filmes pb-5 mt-5" id="last">
        <div class="container px-lg-5 pt-3">
            <!-- Intro -->
            <?php include_once "./components/cp_intro_index.php"; ?>

            <!-- Listar três filmes mais recentes -->

            <div class="row">
                <?php
                $link = new_db_connection();
                $stmt = mysqli_stmt_init($link);
                mysqli_stmt_prepare($stmt, "SELECT id_restaurantes, nome, endereco, capa
                                     FROM restaurantes
                                     ORDER BY id_restaurantes DESC
                                     LIMIT 3");
                mysqli_stmt_execute($stmt);

                mysqli_stmt_bind_result($stmt, $id_restaurantes, $titulo, $endereco , $capa);

                while (mysqli_stmt_fetch($stmt)) {
                    ?>
                    <div class='col-md-4 mb-md-0 pb-5'>
                         <div class='card pb-2 h-100 shadow rounded'>

                                <div class='capas-preview' style='background-image: url("./imgs/capas/<?= $capa ?>");'></div>

                                <div class='card-body text-center'>
                                         <h4 class='text-uppercase m-0 mt-2'><?=$titulo?></h4>
                                         <hr class='my-3 mx-auto'/>
                                     <div class='genero-filme mb-0 small text-black-50'><?=$endereco?></div>
                                         <a href='restaurante_detail.php?id=<?= $id_restaurantes ?>' class='mt-2 btn btn-outline-primary'>
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
                mysqli_stmt_close($stmt);
                ?>

                <div class="col text-center my-5">
                    <a href="./restaurante.php" class="btn btn-primary">Ver todos</a>
                </div>

            </div>
        </div>
    </section>