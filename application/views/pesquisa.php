<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Pesquisar
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="<?=base_url('pesquisa')?>">pesquisar</a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">

            <!-- /.col -->
            <div class="col-md-12">

                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title col-md-6"><b>Resultados da busca</b></h3>

                        <div class="col-md-6">
                            <form action="<?=base_url('pesquisa')?>" enctype="multipart/form-data" class="search-form">
                                <div class="input-group">
                                    <input type="text" name="termo" class="form-control"
                                        placeholder="Digite um termo para pesquisa de mais pedidos...">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-success btn-flat"><i
                                                class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.input-group -->
                            </form>
                        </div>
                    </div>

                    <div class="box-body">

                        <?php if ($pedido == false){ ?>
                        <div class="callout callout-warning">
                            <h4><i class="icon fa fa-exclamation-circle"></i> Sem resultados!</h4>
                            Nenhum pedido encontrado referente a sua pesquisa...<br> Ou então pedido já foi despachado!
                        </div>
                        <?php }else{?>



                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-blue">
                                    Pedidos
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-boxes bg-blue"></i>

                                <div class="timeline-item">


                                    <h3 class="timeline-header"><a href="#">Pedido Encontrado</a></h3>

                                    <div class="timeline-body">

                                        <div class="box box-solid">


                                            <div class="box-body">

                                                <div class="col-md-2 col-sm-4 col-md-4 text-center">
                                                    <div class="info-box bg-gray">

                                                        <!-- <php if($this->ion_auth->is_admin()){?>
                                                        <a href="#" data-toggle="modal" data-target="#despacha-pedidos"
                                                            data-rota="<=base_url('doca/' . $doca['id'] . '/palete' . '/' . $palete['id'] . '/removePedido' . '/' . $pedido['id'])?>"
                                                            style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
                                                            <span class="badge bg-yellow">Despachar</span>
                                                        </a>
                                                        <php }?> -->
                                                        <span class="info-box-icon-ped"><i
                                                                class="fa fa-barcode text-center"></i></span>
                                                        <?=$pedido['cod_pedido']?>
                                                    </div>
                                                </div>


                                            </div>



                                        </div>

                                    </div>

                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-green">
                                    Paletes de Localização do Pedido
                                </span>
                            </li>
                            <!-- /.timeline-label -->

                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-pallet bg-green"></i>

                                <div class="timeline-item">

                                    <h3 class="timeline-header"><a href="#">Paletes do Pedido</a></h3>

                                    <div class="timeline-body">

                                        <div class="box box-solid">


                                            <div class="box-body">


                                                <?php foreach ($paletes as $palete) {    ?>

                                                <?php $qtdPedidos_atual = $this->palete_model->qtdPedidos($palete['id']);?>


                                                <div class="col-md-3 col-sm-6 col-xs-6">
                                                    <div class="info-box 
                                                        <?php if ($palete['status'] == 1 ) {
                                                        echo 'bg-green';
                                                        } elseif ($palete['status'] == 0) {
                                                        echo 'bg-red';
                                                        } else{
                                                        echo 'bg-yellow';
                                                        }?>">
                                                        <?php $id_doca = $this->uri->segment(2);?>



                                                        <span class="info-box-icon"><i class="fa fa-pallet"></i></span>

                                                        <div class="info-box-content">
                                                            <span style="margin-top: 9px;" class="info-box-text">
                                                                <?=$palete['cod_palete']?></span>
                                                            <p><span class=" badge bg-default" data-toggle="tooltip"
                                                                    title="Nº de pedidos no palete">
                                                                    Ped:
                                                                    <?=$qtdPedidos_atual?>
                                                                </span> <span class=" badge bg-default"
                                                                    data-toggle="tooltip" title="Rota do palete">

                                                                    <?=$palete['rota']?>
                                                                </span>
                                                            </p>



                                                        </div>

                                                        <!-- /.info-box-content -->
                                                    </div>
                                                    <div class="small-box-pedidos">
                                                        <a data-toggle="tooltip"
                                                                title="Palete finalizado" class="small-box-footer">
                                                            <?php if ($palete['status'] == 0) {
                                                            echo 'Palete finalizado <i class="fa fa-minus-circle"></i>';
                                                            } else{?>
                                                            <a data-toggle="tooltip"
                                                                title="Palete em uso"
                                                                class="small-box-footer">Está em uso <i
                                                                    class="fa fa-lock"></i></a>
                                                            <?php }  ?>
                                                        </a>


                                                    </div>

                                                </div>


                                                <?php }?>


                                            </div>



                                        </div>



                                    </div>

                                </div>
                            </li>
                            <!-- END timeline item -->
                            <!-- timeline time label -->
                            <li class="time-label">
                                <span class="bg-purple">
                                    Doca de Localização do Pedido
                                </span>
                            </li>
                            <!-- /.timeline-label -->
                            <!-- timeline item -->
                            <li>
                                <i class="fa fa-th-large bg-purple"></i>

                                <div class="timeline-item">
                                    <!-- <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span> -->

                                    <h3 class="timeline-header"><a href="#">Doca do Pedido</a></h3>

                                    <div class="timeline-body">


                                        <div class="box box-solid">


                                            <div class="box-body">

                                            <?php foreach ($docas as $doca) {    ?>

                                                <div class="col-lg-3 col-md-6">
                                                    <!-- small box -->
                                                    <?php $qtd_atual = $this->doca_model->qtdPaletes($doca['id']);?>

                                                    <div
                                                        class="small-box  <?=$doca['status'] == 1? 'bg-green': 'bg-red'?>">

                                                        <?php if($doca['tipo'] == 0):?>
                                                        <a href="#"
                                                            style="position: absolute;top: -11px;right: -8px;font-size: 10px;font-weight: 400;">
                                                            <span class="badge bg-yellow">MISTA</span>
                                                        </a>
                                                        <?php endif?>

                                                        <div class="inner">
                                                            <h3>
                                                                <?=$doca['cod_doca']?>
                                                            </h3>

                                                            <p><span class=" badge bg-default">
                                                                    <?=$qtd_atual?> /
                                                                    <?=$doca['qnt_vagas']?></span></p>

                                                        </div>
                                                        <div class="icon">
                                                            <i class="fa fa-th-large "></i>
                                                        </div>
                                                        <a href="<?=base_url('doca/'.$doca['id'])?>"
                                                            class="small-box-footer">Ver
                                                            Paletes <i class="fa fa-eye"></i></a>
                                                    </div>
                                                </div>

                                            <?php }  ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </li>
                            <!-- END timeline item -->
                            <li>
                                <i class="fa fa-search bg-gray"></i>
                            </li>
                        </ul>


                        <?php }?>


                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->