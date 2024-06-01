<section class="sec-filmes pb-5" id="lista-filmes">
    <div class="container px-lg-5 pt-3">
        <div class="row">
            <?php include_once "./components/cp_intro_registo.php"; ?>
            <!-- Coluna para o formulário -->
            <div class="col-md-6">
                <!-- Formulário de registro -->
                <form id="registrationForm" action="./scripts/sc_registo.php" method="post" class="needs-validation" novalidate>
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please enter your name.</div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="login" class="form-label">Login:</label>
                        <input type="text" class="form-control" id="login" placeholder="Enter login" name="login" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please enter a login name.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" id="password" placeholder="Enter password" name="password" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please enter your password.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <!-- Coluna para a imagem -->
            <div class="col-md-6">
                <img src="./imgs/undraw_proud_coder_re_exuy.svg" alt="Imagem alusiva ao registro" class="img-fluid">
            </div>
        </div>
    </div>
</section>

<script>

    document.addEventListener('DOMContentLoaded', function() {

        var form = document.getElementById('registrationForm');

        form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    }, false);

</script>
