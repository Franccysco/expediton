<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <input type="hidden" name="idDoca" id="idDoca" value="<?=$doca_selecionada['id']?>">
        <h1>Paletes na Doca:
            <span class="badge <?=$stat_doca == 1 ? 'bg-green' : 'bg-red'?>" style="font-size:18px; margin-left:5px;">
                <?=$doca_selecionada['cod_doca']?></span>

            <!--php echo $doca_selecionada['cod_doca'] -->
            <?php if ($stat_doca == 0) {?>
            <span class="badge bg-red " data-toggle="tooltip" title="Capacidade máxima atingida" style="font-size:17px; margin-bottom:opx;">
                <i class="fa fa-remove "></i> DOCA CHEIA
            </span>
            <?php }?>
        </h1>



        <ol class="breadcrumb">
            <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
            <li class="active"><a href="<?=base_url('doca/'.$doca_selecionada['id'])?>">
                    <?php echo $doca_selecionada['cod_doca']?></a></li>
        </ol>
    </section>

    <!-- Main content -->
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

        <div class="col-md-12" id="msg"> </div>

        
        <!-- Inserir palets na doca -->
        <section class="content" id="paletesAddDoca" style="display: none;">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title"><b>Todos os Paletes Disponíveis</b></h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                                    title="Minimizar" data-original-title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" onclick="hidePaletesAdd();"><i class="fa fa-times"></i></button>
                            </div>
                            
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <div class="box-body">

                            <div class="row" id="paletesDisponivieis"></div>

                        </div>
                        <div class="box-footer" style="text-align: right;">
                            
                            <a onclick="hidePaletesAdd();" class="btn btn-xs btn-danger" style="padding:3px; margin-right: 5px;">Finalizar
                                Operação
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </section>
        




       
        <!-- Paletes na Doca Selecionada -->
        <section class="content">


            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">

                        <div class="box-header with-border">
                            <h2 class="box-title col-md-6"> <b>Paletes encontrados!</b></h2>


                            <?php if ($stat_doca == 1) {?>

                            <?php if ($this->ion_auth->is_admin()) {?>
                            <div class="box-header col-md-6">
                                <a onclick="showPaletesAdd('<?=$this->uri->segment(2)?>');" class="btn btn-success  btn-xs pull-right">
                                    <i class="fa fa-plus-circle"></i> Inserir palete
                                </a>
                            </div>
                            <?php } 
                            } else {?>

                            <div class="col-md-12" style="margin-top: 8px;">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-times-circle"></i> Capacidade Máxima</h4>
                                    <?php echo'Doca: '.$doca_selecionada['cod_doca'].' na sua capacidade máxima'?>
                                </div>
                            </div>


                            <?php }?>

                        </div>

                        <div class="box-body">

                            <!-- <php echo var_dump($ids) ?> -->


                            <div class="row" id="paleteDocaSelecionada">

                               <?php if ($paletes_relacionados == false) {?>

                                <section class="content">
                                    <div class="callout callout-warning">
                                        <h4><i class="icon fa fa-exclamation-circle"></i> Insira um palete na doca selecionada!
                                        </h4>
                                    </div>
                                </section>

                                <?php } else {?>

                                <?php foreach ($paletes_relacionados as $palete) {?>
                                <!-- /.col -->

                            
                                <div class="col-md-3 col-sm-6 col-xs-6">
                                    <div class="info-box 
                                    <?php if ($palete['status'] == 1 ) {
                                       echo 'bg-green';
                                    } elseif ($palete['status'] == 0) {
                                       echo 'bg-red';
                                    } else{
                                       echo 'bg-yellow';
                                    }?>">
                                        <?php $id_doca = $this->uri->segment(2); $idPalte = $palete['id']?>

                                        <?php  if ($this->ion_auth->is_admin()):?>
                                        <?php if (!empty($this->pedido_model->getPedidosPaletes(true, $palete['id']))) {?>

                                        <a href="#" onclick="removerPaleteDocaOcupado('<?=$id_doca?>', '<?= $idPalte?>')"
                                            data-toggle="tooltip" title="Retirar palete da doca atual"
                                            style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
                                            <span class="badge" style="background-color:#b23b2c; border:solid 2px; border-color:#727272">remover</span>
                                        </a>

                                        <?php  if ($palete['status'] == 0):?>
                                        <a href="#" data-toggle="modal" data-target="#limpar-palete" data-toggle="tooltip"
                                            title="Limpar todos os pedidos do palete" data-rota="<?=base_url('limpa-pedidos/')?>"
                                            data-idp="<?=$palete['id']?>" data-rta="<?=$id_doca?>" style="position: absolute;top: -3px;right: 70px;font-size: 10px;font-weight: 400;">
                                            <span class="badge bg-yellow" style="border:solid 2px; border-color:#727272">limpar</span>
                                        </a>
                                        <?php  endif;?>

                                        
                                        <?php } else {?>

                                        <a href="#" onclick="removerPaleteDoca('<?=$id_doca?>', '<?= $idPalte?>')"
                                            data-toggle="tooltip" title="Retirar palete da doca atual" style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400; ">
                                            <span class="badge" style="background-color:#b23b2c; border:solid 2px; border-color:#727272">remover</span>
                                        </a>
                                        <?php }?>

                                        <?php if ($palete['status'] == 2): ?>
                                        <a href="#" onclick="showModalAtivarPalete('<?= $idPalte?>')" data-toggle="tooltip"
                                            title="Ativar palete, para uso" 
                                            style="position: absolute;top: -3px;right: 70px;font-size: 10px;font-weight: 400;">
                                            <span class="badge bg-green" style="border:solid 2px; border-color:#727272">ativar</span>
                                        </a>
                                        <?php endif;?>

                                        <?php endif;?>

                                        <span class="info-box-icon"><i class="fa fa-pallet"></i></span>

                                        <div class="info-box-content">
                                            <span style="margin-top: 9px;" class="info-box-text">
                                                <?=$palete['cod_palete']?></span>
                                            <p><span class=" badge bg-default" data-toggle="tooltip" title="Nº de pedidos no palete">
                                                    Ped:
                                                    <?=$palete['qtdPedidos_atual']?>
                                                </span> <span class=" badge bg-default" data-toggle="tooltip" title="Rota do palete">

                                                    <?=$palete['rota']?>
                                                </span>
                                            </p>

                                        </div>

                                        <!-- /.info-box-content -->
                                    </div>
                                    <div class="small-box-pedidos">
                                        <a href="<?=base_url('doca/' . $id_doca . '/' . 'palete/' . $palete['id'].'/1')?>"
                                            class="small-box-footer">
                                            <?php if ($palete['status'] == 1) {
                                               echo 'Adicionar Pedidos <i class="fa fa-plus-circle"></i> </a>';
                                               
                                            } elseif ($palete['status'] == 0) {
                                               echo 'Visualizar Pedidos <i class="fa fa-eye"></i> </a>';
                                            } else{?>
                                            <a data-toggle="tooltip" title="Palete em uso, usar o próximo disponível"
                                                class="small-box-footer">Está
                                                em uso <i class="fa fa-lock"></i></a>
                                            <?php }  ?>
                                        
                                    </div>
                                </div>

                                <?php }?>
                                <?php };?>


                            </div>

                            

                        </div>

                        <div class="box-footer" style="text-align: right;">

                            <a href="#"  class="btn btn-xs btn-warning" data-toggle="modal" data-target="#limpar-doca" data-rota="<?=base_url('limpa-pedidos-doca/' . $doca_selecionada['id']);?>"
                                data-toggle="tooltip"
                                title="Limpar todos os pedidos da doca" style="padding:3px;">
                                <!-- style="position: absolute;top: -10px;right: -8px;font-size: 17px;font-weight: 400;" 
                                
                                <span class="badge bg-yellow" style="border:solid 2px; border-color:#727272">Limpar pedidos</span> -->
                                Limpar pedidos
                            </a>
                            <a href="<?=base_url()?>" class="btn btn-xs btn-danger" style="padding:3px; margin-right: 5px;">Finalizar
                                Operação</a>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <!-- /.content -->
        

       

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->