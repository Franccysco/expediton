<?php $rota = $this->uri->segment(3);if ($rota == 'add' && $this->ion_auth->is_admin()): ?>
        <!-- Inserir palets na doca -->
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Todos os Paletes Disponíveis</b></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Minimizar" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="row">


                                <?php if ($paletes_not_relacionados == false): ?>
                                <section class="content">
                                    <div class="callout callout-warning">
                                        <a style="float:right;" href="<?=base_url('paletes/cadastro')?>" class="btn btn-success">
                                            <i class="fa fa-plus-circle"></i> Cadastrar palete
                                        </a>
                                        <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre mais um palete no
                                            sistema!</h4>
                                        Nenhum Palete cadastrado ainda!
                                    </div>
                                </section>

                                <?php else: ?>



                                <?php foreach ($paletes_not_relacionados as $palete) {?>

                                <div style="top: -12px;" class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="info-box <?=$palete['status'] == 1 ? 'bg-green' : 'bg-red'?>">
                                        <span class="info-box-icon-ped2"><i class="fa fa-pallet"></i></span>

                                        <div class="info-box-content">
                                            <span class="info-box-text">
                                                <?=$palete['cod_palete']?></span>
                                            <p><span class=" badge bg-default">Ped: 0</span> <span class=" badge bg-default"
                                                    data-toggle="tooltip" title="Rota do palete">

                                                    <?=$palete['rota']?></span></p>
                                            <!-- <div class="progress">
                                                <div class="progress-bar" style="width: 0%"></div>
                                            </div> -->

                                        </div>
                                        <!-- /.info-box-content -->
                                    </div>
                                    <?php $id_doca = $this->uri->segment(2);?>
                                    <a href="<?=base_url('doca/' . $id_doca . '/addPalete' . '/' . $palete['id'])?>"
                                        style="margin-top: -11px; margin-bottom: 20px;" href="#" class="btn btn-primary btn-xs pull-right">
                                        <i class="fa fa-arrow-right"></i> Adicionar
                                    </a>

                                </div>

                                <?php }?>

                                <?php endif;?>
                            </div>

                        </div>
                        <div class="box-footer" style="text-align: right;">
                            <?php $id_doca = $this->uri->segment(2)?>
                            <a href="<?=base_url('doca/' . $id_doca)?>" class="btn btn-xs btn-danger" style="padding:3px; margin-right: 5px;">Finalizar
                                Operação
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section>
        <?php endif;?>