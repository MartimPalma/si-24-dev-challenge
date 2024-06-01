<div class="row">
    <h1>Restaurantes</h1>

    <div class="col-8">
        <p class="text-black-60 text-left pb-4">
            A lista dos melhores restaurantes está disponível.
            <br />
            Não percas!
        </p>
    </div>

    <!-- Input de pesquisa -->
    <form class="col-4" method="post" action="restaurante.php">
        <div class="row">
            <div>
                <label for="pesquisa">Nome:</label>
                <input class="form-control" id="pesquisa" name="pesquisa" type="text" placeholder="Insere o nome" aria-label="Pesquisa" />
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-3 mb-3 mt-3">
                <input class="form-control btn-primary" type="submit" value="Ir" />
            </div>
        </div>
    </form>
</div>
