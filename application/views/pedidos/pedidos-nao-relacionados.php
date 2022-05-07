<?php $rota = $this->uri->segment(5);if ($rota == 'addPed' && $this->ion_auth->is_admin()): ?>
                            <!-- Inserir pedidos no Palete-->
                            <section class="content">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box box-success">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"><b>Todos os Pedidos Disponíveis</b></h3>

                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                                        data-toggle="tooltip" title="Minimizar" data-original-title="Collapse">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                            </div>
                                            <!-- /.box-header -->
                                            <!-- form start -->
                                            <div class="box-body">

                                                <div class="row">
                                                    <?php if ($pedidos_not_relacionados == false): ?>
                                                    <section class="content">
                                                        <div class="callout callout-warning">

                                                            <h4><i class="icon fa fa-exclamation-circle"></i> Insira um
                                                                pedido no palete selecionado!</h4>
                                                        </div>
                                                    </section>

                                                    <?php else: ?>

                                                    <?php foreach ($pedidos_not_relacionados as $pedido) {?>

                                                    <div class="col-md-2 col-sm-4 col-xs-4 text-center">
                                                        <div class="info-box bg-gray">

                                                            <span class="info-box-icon-ped"><i class="fa fa-barcode text-center"></i></span>
                                                            <?=$pedido['cod_pedido']?>
                                                        </div>

                                                        <?php $id_doca = $this->uri->segment(2); $id_palt = $this->uri->segment(4);?>
                                                        <a href="<?=base_url('doca/' . $id_doca . '/palete' . '/' . $id_palt . '/addPedido' . '/' . $pedido['id'])?>"
                                                            style="margin-top: -11px; margin-bottom: 20px;" href="#"
                                                            class="btn btn-primary btn-xs pull-right">
                                                            <i class="fa fa-arrow-right"></i> Adicionar</a>
                                                    </div>

                                                    <?php }?>

                                                    <?php endif;?>
                                                </div>

                                            </div>
                                            <div class="box-footer" style="text-align: right;">
                                                <?php $id_doca = $this->uri->segment(2); $id_palt = $this->uri->segment(4)?>
                                                <a href="<?=base_url('doca/' . $id_doca . '/palete' . '/' . $id_palt)?>"
                                                    class="btn btn-xs btn-danger" style="padding:3px; margin-right: 5px;">Finalizar
                                                    Operação</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>

                            <?php endif;?>