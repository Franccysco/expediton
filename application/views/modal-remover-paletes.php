<!-- Modal para aviso qdo remover paletes da doca e estiverem com pedidos inseridos -->
<div class="modal modal-default fade" id="remove-palete">
    <div class="modal-dialog" style="top: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Remover Palete da Doca <i class="fa fa-warning"></i></h4>
            </div>
            <div class="modal-body">
                <p>Palete possui Pedidos!!! <br>A ação irá remover o palete da doca e todos os pedidos inseridos</p>
            </div>
            <div class="modal-footer" id="footermodal">
                <a id="confirm-remover" class="btn btn-danger" href="#">Sim</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->