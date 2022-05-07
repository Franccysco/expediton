<div class="modal fade" id="modal-etiqueta">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Etiqueta para impressão <i class="fa fa-sticky-note"></i> </h4>
            </div>

            <!-- form start -->


            <div class="modal-body">

                <div class="box-body">

                    

                    <div id="print" class="col-md-12 col-sm-12 col-xs-12">
                        <!-- Widget: user widget style 1 -->
                        <div class="box box-widget widget-user">
             
                            <div class="box-footer">

                                <div class="row">
                                    <div class="col-sm-12 border-right">
                                        <div class="description-block">
                                        <h1 style="font-size: 36px;"><?php echo $doca_selecionada['cod_doca']?> | <?php echo $palete_selecionado['cod_palete']?></h5>
                                           
                                        </div>
                                        <!-- /.description-block -->
                                    </div>
                                   
                                  
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                        </div>
                        <!-- /.widget-user -->
                        
                    </div>

                      

                </div>

                

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cancelar</button>
                <button id="imprimir" type="button" class="btn btn-defaut"  onclick="cont();"><i class="fa fa-print" style="color:#0073b7;"></i> Imprimir</button>
            </div>


        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>