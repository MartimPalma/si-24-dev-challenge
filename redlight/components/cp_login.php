
<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <!-- Intro -->
        <?php include_once "./components/cp_intro_login.php"; ?>
        <div class="row">
            <!-- Coluna para o formulário -->
            <div class="col-md-6">
                <h1>Introduz os teus dados</h1>
                <!-- Formulário de login -->
                <!-- Envia os dados para sc_login.php através do post -->
                <form id="loginForm" action="./scripts/sc_login.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3 mt-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" placeholder="Enter login" name="login" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- Coluna para a imagem -->
            <div class="col-md-6">
                <img src="./imgs/undraw_welcoming_re_x0qo.svg" alt="Imagem alusiva ao login" class="img-fluid w-75 mt-3">
            </div>
        </div>
    </div>
</section>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        var form = document.getElementById('loginForm');

        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);

</script>