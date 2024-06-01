<section >
    <div class="container px-lg-5 pt-3">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 text-center">
                <h1 class="pt-5 pb-3">Terminar Sessão</h1>
                <p>Tem a certeza que deseja terminar a sua sessão?</p>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#logoutModal">Confirmar Logout</button>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="logoutModalLabel">Confirmar Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem a certeza que deseja terminar a sua sessão? Todas as suas informações não salvas serão perdidas.
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <a href="./scripts/sc_logout.php" class="btn btn-danger">Confirmar Logout</a>
            </div>
        </div>
    </div>
</div>
