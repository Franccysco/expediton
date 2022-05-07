<div class="modal fade" id="modal-ped-rotas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione uma Rota</h4>
            </div>
            
            
                <div class="modal-body">

                    <div class="row">


                            <?php if ($rotas == FALSE): ?>
                            <section class="content">
                               <div class="callout callout-warning">
                                    <a style="float:right;" href="<?=base_url('rotas/cadastro')?>" class="btn btn-success">
                                        <i class="fa fa-plus-circle"></i> Cadastrar uma Rota
                                    </a>
                                    <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre mais uma Rota no sistema!</h4>
                                    Nenhum Rsota cadastrado ainda!
                                </div>
                            </section>

                            <?php else: ?>



                            <?php foreach ($rotas as $rota){ ?>

                           
                            <div class="col-md-6 col-sm-6 col-xs-6" data-produce data-rta="<?=$rota['rota']?>">
                                <!-- Widget: user widget style 1 -->
                                <div class="box box-widget widget-user">
                                    <!-- Add the bg color to the header using any of the bg-* classes -->
                                    <div class="widget-user-header bg-yellow">
                                        <h4 class="widget-user-desc"><i class="fas fa-directions"></i> Rota - <?=$rota['rota']?></h4>
                                    </div>

                                    <div class="box-footer">
                                    
                                        <div class="row">
                                            <div class="col-sm-5 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header">Origem</h5>
                                                     <i class="far fa-dot-circle"></i><span class="description-text pull-left"></span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-2 border-right">
                                                <div class="description-block">
                                                    <h5 class="description-header"><i class="fas fa-shipping-fast"></i></h5>
                                                    <span class="description-text">
                                                        <div class="progress progress-sm active">
                                                            <div class="progress-bar progress-bar-success progress-bar-striped"
                                                                role="progressbar" aria-valuenow="20" aria-valuemin="0"
                                                                aria-valuemax="100" style="width: 100%">
                                                                
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-5">
                                                <div class="description-block">
                                                    <h5 class="description-header">Destino </h5>
                                                    <i class="fas fa-map-marker-alt"></i><span class="description-text pull-left"></span>
                                                </div>
                                                <!-- /.description-block -->
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                </div>
                                <!-- /.widget-user -->
                                <button style="margin-top: -11px; margin-bottom: 20px;" class="btn btn-primary btn-xs pull-right">
                                    <i class="fa fa-arrow-right"></i> Selecionar</button>
                            </div>

                            <?php }?>

                            <?php endif; ?>
                        </div>

                </div>

                <div class="modal-footer">
                    <!-- <button type="reset" class="btn btn-default pull-left">Limpar</button> -->
                    <!-- <button type="submit" class="btn btn-primary">Salvar</button> -->
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>

        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>