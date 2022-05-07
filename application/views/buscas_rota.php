<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Resultados da Busca
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="#">Busca por rota</a></li>
        </ol>
    </section>


    <!-- Paletes na Doca Selecionada -->
    <section class="content">

        <?php if ($this->session->flashdata('error') == true): ?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-times-circle"></i> Erros</h4>
                <?php echo $this->session->flashdata('error'); ?>
            </div>
        </div>
        <?php endif;?>



        <?php if ($this->session->flashdata('success') == true): ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check-circle"></i> Sucesso</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        </div>
        <?php endif;?>

        <!-- Paletes da busca por rota -->
        <?php $rota_url = $this->uri->segment(1);if ($rota_url == 'busca-rota'): ?>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title col-md-6" style="badge bg-black"
                                style="font-size:18px; margin-left:5px;">
                                <b>Paletes encontrados na Rota:
                                    <span class=" badge bg-black" style="font-size:18px; margin-left:5px;">
                                        <?=$rota?></span></b></h2>


                            <div class="col-md-4" style="float:right;">
                                <form method="post" action="<?=base_url('busca-rota')?>" enctype="multipart/form-data"
                                    class="search-form">
                                    <div class="input-group">
                                        <!-- <input type="text" name="busca" class="form-control" placeholder="Buscar Por Rota...">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-search"></i>
                                        </button>
                                    </div> -->
                                        <select name="busca" class="form-control select2" style="width: 100%;">
                                            <option disabled="disabled" selected="selected">Buscar por rota...</option>
                                            <?php foreach ($rotas_all as $rota_busca): ?>
                                            <option value="<?=$rota_busca['rota']?>">
                                                <?=$rota_busca['rota']?>
                                            </option>
                                            <?php endforeach;?>
                                        </select>

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

                            <div class="row">

                                <?php if ($paletes_busca == false) {?>

                                <section class="content">
                                    <div class="callout callout-warning">
                                        <h4><i class="icon fa fa-exclamation-circle"></i> Sem resultados!</h4>
                                        Nenhuma rota encontrada referente a sua pesquisa...<br> Revise a rota informada!

                                    </div>
                                </section>

                                <?php } else {?>

                                <?php  foreach ($paletes_busca as $palete) {?>
                                <!-- /.col -->

                                <?php $qtdPedidos_atual = $this->palete_model->qtdPedidos($palete['id']);?>

                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="info-box <?php if ($palete['status'] == 1 ) {
                                       echo 'bg-green';
                                    } elseif ($palete['status'] == 0) {
                                       echo 'bg-red';
                                    } else{
                                       echo 'bg-yellow';
                                    }?>">

                                        <?php  if ($this->ion_auth->is_admin()):?>
                                        <?php if (!empty($this->pedido_model->getPedidosPaletes(true, $palete['id'])) && $palete['status'] != 2) {?>

                                        <a href="#" data-toggle="modal" data-target="#limpar-palete"
                                            data-toggle="tooltip" title="Limpar todos os pedidos do palete"
                                            data-rota="<?=base_url('limpa-pedidos/')?>" data-idp="<?=$palete['id']?>"
                                            data-rta="<?=$palete['rota']?>"
                                            style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
                                            <span class="badge bg-yellow"
                                                style="border:solid 2px; border-color:#727272">Limpar
                                                pedidos</span>
                                        </a>

                                        <?php } ?>
                                        <?php endif;?>

                                        <span class="info-box-icon"><i class="fa fa-pallet"></i></span>

                                        <div class="info-box-content">
                                            <span style="margin-top: 9px;" class="info-box-text">
                                                <?=$palete['cod_palete']?></span>
                                            <p>
                                                <span class=" badge bg-default" data-toggle="tooltip"
                                                    title="Nº de pedidos no palete">
                                                    Ped:
                                                    <?=$qtdPedidos_atual?>
                                                </span>
                                                <span class=" badge bg-default" data-toggle="tooltip"
                                                    title="Rota do palete">
                                                    <?=$palete['rota']?>
                                                </span>
                                                <span class=" badge bg-default" data-toggle="tooltip"
                                                    title="Doca do palete">
                                                    <?=$palete['cod_doca']?>
                                                </span>
                                            </p>





                                        </div>

                                        <!-- /.info-box-content -->
                                    </div>
                                    <div class="small-box-pedidos">
                                        <?php if (!empty($this->pedido_model->getPedidosPaletes(true, $palete['id']))) {?>
                                        <a href="<?=base_url('ver-pedidos/'.'palete/'.$palete['id'].'/'.$rota)?>"
                                            class="small-box-footer">Visualizar
                                            Pedidos <i class="fa fa-eye"></i>
                                        </a>
                                        <?php } else {?>
                                        <a class="small-box-footer">Palete Vazio
                                            <i class="fas fa-box-open"></i>
                                        </a>
                                        <?php  }?>


                                    </div>


                                </div>

                                <?php }?>
                                <?php };?>

                            </div>


                        </div>


                        <div class="box-footer" style="text-align: right;">

                            <a href="<?=base_url()?>" class="btn btn-xs btn-danger" style="padding:3px;">Finalizar
                                Operação</a>
                        </div>

                    </div>
                </div>
            </div>
        </section>
        <?php endif;?>

        <!-- Pedidos no palete Selecionado -->
        <?php $rota_url = $this->uri->segment(1);if ($rota_url == 'ver-pedidos'): ?>
        <section class="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">

                            <div class="col-md-6">
                                <h3 class="box-title"><b>Pedidos no Palete:
                                        <?php if ($stat_palete == 0) {
                                                        echo '<span class="badge bg-red" style="font-size:14px">
                                                            ' . $palete_selecionado['cod_palete'] . '</span>';

                                                    } elseif ($stat_palete == 2) {
                                                        echo '<span class="badge bg-yellow" style="font-size:14px">
                                                            ' . $palete_selecionado['cod_palete'] . '</span>';
                                                    } else {
                                                        echo '<span class="badge bg-green" style="font-size:14px">
                                                             ' . $palete_selecionado['cod_palete'] . '</span>';
                                                    }
                                                    ?>
                                </h3>



                                <?php if ($stat_palete == 0) {
                                                    echo '<span class="badge bg-red" data-toggle="tooltip" title="Status do palete"
                                                             style="font-size:14px;margin-bottom:2.4px;">  PALETE FINALIZADO </span>';
                                                } elseif ($stat_palete == 2) {
                                                    echo '<span class="badge bg-yellow" data-toggle="tooltip" title="Status do palete"
                                                            style="font-size:14px;margin-bottom:2.4px;">   Em uso </span>';
                                                } else {
                                                    echo '<span class="badge bg-green" data-toggle="tooltip" title="Status do palete"
                                                           style="font-size:14px;margin-bottom:2.4px;">   Liberado </span>';
                                                }
                                                ?>
                            </div>
                            <?php  if ($this->ion_auth->is_admin() && !$palete_selecionado['status'] == 1):?>
                            <div class="col-md-6">

                                <a data-toggle="modal" data-target="#limpar-palete" data-toggle="tooltip"
                                    title="Limpar os pedidos do Palete!" data-rota="<?=base_url('limpa-pedidos/')?>"
                                    data-idp="<?=$palete_selecionado['id']?>"
                                    data-rta="<?=$palete_selecionado['rota']?>" class="btn bg-orange margin pull-right"
                                    style="padding:7px;" data-toggle="tooltip" title="Limpar os pedidos do Palete!">
                                    <i class="fa fa-trash"></i> Limpar pedidos do palete
                                </a>

                            </div>
                            <?php  endif;?>



                        </div>
                        <div class="box-body">
                            <div class="row">



                                <?php if ($pedidos_relacionados == false) {?>

                                <section class="content">
                                    <div class="callout callout-warning">

                                        <h4><i class="icon fa fa-exclamation-circle"></i> Palete Vazio!</h4>

                                    </div>
                                </section>

                                <?php } else {?>

                                <?php foreach ($pedidos_relacionados as $pedido) {?>


                                <div class="col-md-2 col-sm-4 col-xs-4 text-center">
                                    <div class="info-box bg-gray">

                                        <?php  $id_palt = $this->uri->segment(3); $id_doca = $this->palete_model->docaPalete($id_palt);  
                                                            if ($this->ion_auth->is_admin()){
                                                            ?>
                                        <a href="#" data-toggle="modal" data-target="#despacha-pedidos"
                                            data-rota="<?=base_url('doca/'  . $id_doca . '/palete' . '/' . $id_palt . '/removePedido' . '/' . $pedido['id'].'/'.$palete_selecionado['rota'])?>"
                                            style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
                                            <span class="badge bg-yellow"
                                                style="border:solid 2px; border-color:#727272">Despachar</span>
                                        </a>
                                        <?php }?>
                                        <span class="info-box-icon-ped"><i class="fa fa-barcode text-center"></i></span>
                                        <?=$pedido['cod_pedido']?>
                                    </div>
                                </div>

                                <?php }?>

                                <?php }?>
                            </div>

                        </div>

                        <div class="box-footer" style="text-align: right;">
                            <form method="post" action="<?=base_url('busca-rota')?>" enctype="multipart/form-data">
                            <input type="hidden" name="busca" value="<?=$palete_selecionado['rota']?>">
                                <button type="submit" class="btn btn-xs btn-danger" style="padding:3px;">Finalizar
                                    Operação</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
        <?php endif;?>

    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->