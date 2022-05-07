<div class="modal fade" id="modal-ped-palet">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Selecione um Palete</h4>
            </div>


            <div class="modal-body">

                <div class="row">


                    <?php if ($paletes == FALSE): ?>
                    <section class="content">
                        <div class="callout callout-warning">
                            <a style="float:right;" href="<?=base_url('paletes/cadastro')?>" class="btn btn-success">
                                <i class="fa fa-plus-circle"></i> Cadastrar palete
                            </a>
                            <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre mais um palete no sistema!</h4>
                            Nenhum Palete cadastrado ainda!
                        </div>
                    </section>

                    <?php else: ?>



                    <?php foreach ($paletes as $palete){ ?>

                    <div class="col-md-3 col-sm-6 col-xs-6" data-produce data-palete-id="<?=$palete['id']?>"
                        data-palete-cod="<?=$palete['cod_palete']?>">
                        <div class="info-box <?=$palete['status'] == 1 ? 'bg-green': 'bg-red'?>">
                            <span class="info-box-icon"><i class="fa fa-pallet"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <?=$palete['cod_palete']?></span>
                                <p><span class=" badge bg-default">12/
                                        <?=$palete['qnt_vagas']?></span></p>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 10%"></div>
                                </div>

                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <?php $id_doca = $this->uri->segment(2);?>
                        <a style="margin-top: -11px; margin-bottom: 20px;" class="btn btn-primary btn-xs pull-right">
                            <i class="fa fa-arrow-right"></i> Selecionar</a>

                    </div>

                    <?php }?>

                    <?php endif;?>
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