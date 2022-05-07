<!-- Modal para aviso qdo remover paletes da doca e estiverem com pedidos inseridos -->
<div class="modal modal-default fade" id="limpar-palete">
    <div class="modal-dialog" style="top: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Limpar todos os pedidos <i class="fa fa-warning"></i></h4>
            </div>
            <div class="modal-body">
                <p>Palete possui pedidos!!! <br>A ação irá expedir todos os pedidos inseridos no palete!!!</p>
            </div>
            <div class="modal-footer">
                <a id="confirm-remover" class="btn btn-danger" href="#">Sim</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->