

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2018 <a href="#">F&H</a>.</strong>
    Todos
    os Direitos Reservados.
</footer>



<!-- Modal rotas cadastro -->
<?php $this->load->view('modal-pedidos-rotas')?>
<!-- Modal para remover Paletes -->
<?php $this->load->view('modal-remover-paletes') ?>
<!-- Despachar Pedidos -->
<?php $this->load->view('modal-despachar-pedidos')?>
<!-- Limpar Palete -->
<?php $this->load->view('modal-limpar-pedidos')?>
<!-- Limpar Pedidos DOCA -->
<?php $this->load->view('modal-limpar-pedidos-doca')?>
<!-- Ativar Palete -->
<?php $this->load->view('modal-ativar-palete')?>


<!-- Modal para exlusão de dados gerais -->
<div class="modal modal-default fade" id="delete-modal">
    <div class="modal-dialog" style="top: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Exluir item <i class="fa fa-trash"></i></h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente excluir este item?</p>
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-danger" href="#">Sim</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- Modal para logout do sistema -->
<div class="modal fade" id="modal-default">
    <div class="modal-dialog" style="top: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4>Deseja realmente sair? <i class="fa fa-sign-out-alt"></i></h4>
            </div>
            <div class="modal-body">
                <p>Ao sair todas as ações que estão em andamento serão encerradas.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                <a href="<?=base_url('logout')?>" class="btn btn-danger">Sair</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<div class="modal modal-default fade" id="desativar-usuario">
    <div class="modal-dialog" style="top: 20%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <p>Deseja realmente desativar este usuário?</p>
            </div>
            <div class="modal-footer">
                <a id="confirm" class="btn btn-danger" href="#"><i class="fa fa-toggle-on"></i> Desativar</a>
                <a id="cancel" class="btn btn-default" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<!-- jQuery 3 -->
<script src="<?=base_url('assets/bower_components/jquery/dist/jquery.min.js')?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
<!-- Select2 -->
<script src="<?=base_url('assets/bower_components/select2/dist/js/select2.full.min.js')?>"></script>
<!-- FastClick -->
<script src="<?=base_url('assets/bower_components/fastclick/lib/fastclick.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/dist/js/adminlte.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?=base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')?>"></script>
<!-- jvectormap  -->
<script src="<?=base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')?>"></script>
<script src="<?=base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')?>"></script>
<!-- SlimScroll -->
<script src="<?=base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')?>"></script>


<!-- iCheck 1.0.1 -->
<script src="<?=base_url('assets/')?>plugins/iCheck/icheck.min.js"></script>
<script src="<?=base_url('assets/dist/js/excluir.js')?>"></script>

<?php if($this->router->fetch_class() == "home" && $this->router->fetch_method() == "doca"){?>
<script src="<?=base_url('assets/dist/js/funcoes.js')?>"></script>
<?php }?>
<!-- Docas scripts -->
<?php if($this->router->fetch_class() == "doca"){?>
   <script src="<?=base_url('assets/dist/js/docas.js')?>"></script>
<?php }?>
<?php if($this->router->fetch_class() == "palete"){?>
   <script src="<?=base_url('assets/dist/js/paletes.js')?>"></script>
<?php }?>
<?php if($this->router->fetch_class() == "pedido"){?>
   <input type="hidden" name="metodo" id="metodoUsado" value="<?=$this->router->fetch_method()?>">
   <script src="<?=base_url('assets/dist/js/pedidos.js')?>"></script>
<?php }?>


<!-- DataTables -->
<script src="<?=base_url('assets/')?>bower_components/datatables/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/js/dataTables.buttons.min.js"></script>
<!-- <script src="<=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/js/buttons.flash.min.js"></script> -->
<script src="<?=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/js/buttons.html5.min.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/js/buttons.print.min.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/buttons-1.5.4/js/buttons.bootstrap.min.js"></script>

<script src="<?=base_url('assets/')?>bower_components/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
<script src="<?=base_url('assets/')?>bower_components/datatables/jszip-2.5.0/jszip.min.js"></script>




<script>
    $(function () {
        $('#tables-exp').DataTable({

            "sScrollX": true,
            "scrollCollapse": true,
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "Mostrar _MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",

                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                }
            }

        })


        $('#example2').DataTable({

            "autoWidth": true,
            "fixedHeader": true,
            'searching': false,
            'paging': false,
            'info': true,
            dom: 'Bfrtip',
            buttons: [{
                    "extend": 'excelHtml5',
                    "text": '<i class="fa fa-file-excel-o text-green"></i> Exportar EXCEL',
                    "titleAttr": 'Excel'
                },
                {
                    "extend": 'pdfHtml5',
                    // "pageSize": 'A4',
                    // "pageMargins": [150, 150, 150, 150],
                    // "margin": [150, 150, 150, 150],
                    "text": '<i class="fa fa-file-pdf-o text-red"></i> Exportar PDF',
                    "titleAttr": 'PDF',

                },
                {
                    "extend": 'csvHtml5',
                    "text": '<i class="fa fa-file-text text-yellow"></i> Exportar CSV',
                    "titleAttr": 'CSV'
                },
                {
                    "extend": 'print',
                    "text": '<i class="fa fa-print text-blue"></i> Imprimir',
                    "titleAttr": 'Imprimir'

                }
            ],

            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
            }

        })

       
    })
</script>
<?php if($this->router->fetch_class() == "home" && $this->router->fetch_method() == "palete"){?>
<script>
function cont(){
   var conteudo = document.getElementById('print').innerHTML;
   var rota = '<?php echo base_url('updatePalete/'.$palete_selecionado['id'].'/'.$doca_selecionada['id'])?>';
   window.location.href = rota;
   tela_impressao = window.open('about:blank');
//    for (i = 0; i < qtdPedidos; i++) {
   tela_impressao.document.write(conteudo);
//    }
   tela_impressao.window.print();
   tela_impressao.window.close();
  
}
</script>
<?php } ?>


<script>
    $(function () {

        //Initialize Select2 Elements
        $('.select2').select2();

    });


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    })
</script>

</body>

</html>