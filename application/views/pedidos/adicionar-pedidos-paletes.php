 <!-- Pedidos no palete Selecionado -->
 <div class="content-wrapper">
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
        

         <div class="row">
             <div class="col-md-12">
                 <div class="box box-success">
                     <div class="box-header with-border">

                         <div class="col-md-6">
                             <h3 class="box-title"><b>Pedidos no palete:</b>

                                 <?php  if ($stat_palete == 0) {
                                                            echo '<span class="badge bg-red" style="font-size:14px">
                                                            '.$palete_selecionado['cod_palete'].'</span>';
                                                        
                                                        } elseif($stat_palete == 2) {
                                                            echo '<span class="badge bg-yellow" style="font-size:14px">
                                                            '.$palete_selecionado['cod_palete'].'</span>';
                                                        } else{
                                                            echo '<span class="badge bg-green" style="font-size:14px">
                                                            '.$palete_selecionado['cod_palete'].'</span>';
                                                        }
                                                         ?>
                             </h3>



                             <?php  if ($stat_palete == 0) {
                                                            echo '<span class="badge bg-red" data-toggle="tooltip" title="Status do palete"
                                                            style="font-size:14px;margin-bottom:2.4px;">  PALETE FINALIZADO </span>';
                                                        } elseif($stat_palete == 2) {
                                                           echo '<span class="badge bg-yellow" data-toggle="tooltip" title="Status do palete"
                                                           style="font-size:14px;margin-bottom:2.4px;">   Em uso </span>';
                                                        } else{
                                                            echo '<span class="badge bg-green" data-toggle="tooltip" title="Status do palete"
                                                            style="font-size:14px;margin-bottom:2.4px;">   Adicionando </span>';
                                                        }
                                                         ?>

                             <!-- <div class="col-md-3 box-header"> -->
                             <?php if (($pedidos_relacionados != false && !$this->uri->segment(5) == 1) || $palete_selecionado['status'] == 0 ) { ?>
                             <a data-toggle="modal" data-target="#modal-etiqueta" data-toggle="tooltip"
                                 title="Gerar etiqueta para impressão" class="pull-right btn btn-xs btn-warning ">
                                 <i class="fa fa-sticky-note"></i> Gerar Etiqueta
                             </a>
                             <?php $this->load->view('modal-gerar-etiqueta')?>
                             <!-- </div> -->
                             <?php } ?>



                         </div>



                         <?php if ($stat_palete == 1) { ?>
                         <div class="col-md-4" style="float:right;">
                             <?php $id_doca = $this->uri->segment(2); $id_palete = $this->uri->segment(4);?>
                             <form method="post" action="<?=base_url('salvar-pedido')?>" class="search-form">
                                 <div class="input-group">
                                     <input required type="text" name="cod_pedido" class="form-control"
                                         placeholder="Adicionar pedidos..." autofocus>
                                     <input type="hidden" name="id_palete" value="<?=$id_palete?>">
                                     <input type="hidden" name="id_doca" value="<?=$id_doca?>">
                                     <input type="hidden" name="status" class="form-control" value="1">


                                     <div class="input-group-btn">
                                         <button type="submit" class="btn btn-success btn-flat"><i
                                                 class="fa fa-plus-circle"></i>
                                         </button>
                                     </div>
                                 </div>
                                 <!-- /.input-group -->
                             </form>
                         </div>


                         <?php } elseif($stat_palete == 0) { ?>


                         <div class="col-md-12" style="margin-top: 10px;">
                             <div class="alert alert-danger alert-dismissible">
                                 <button type="button" class="close" data-dismiss="alert"
                                     aria-hidden="true">&times;</button>
                                 <h4><i class="icon fa fa-times-circle"></i> Palete Finalizado</h4>
                                 <?php echo'Palete: '.$palete_selecionado['cod_palete'].' finalizado, gere a etiqueta.'?>
                             </div>
                         </div>

                         <?php } else{?>

                         <div class="col-md-12" style="margin-top: 10px;">
                             <div class="alert alert-warning alert-dismiss">
                                 <a style="float:right; text-decoration:unset;"
                                     href="<?=base_url('doca/'.$doca_selecionada['id'])?>" class="btn btn-success">
                                     <i class="fa fa-pallet"></i> Paletes disponíveis
                                 </a>
                                 <!-- <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> -->
                                 <h4><i class="icon fa fa-lock"></i> Palete sendo usado</h4>
                                 <?php echo'Palete: <span class="badge bg-blue">'.$palete_selecionado['cod_palete'].'</span> em uso, usar o próximo <span class="badge bg-green">disponível!</span>' ?>
                             </div>
                         </div>

                         <?php }?>




                     </div>

                     <div class="box-body">
                         <div class="row">

                            <?php if ($pedidos_relacionados == false && $stat_palete==1) {?>

                             <section class="content">
                                 <div class="callout callout-warning">
                                    
                                    <h4><i class="icon fa fa-exclamation-circle"></i> Insira um pedido no palete selecionado!</h4>

                                 </div>
                             </section>

                             <?php } else {?>

                             <?php foreach ($pedidos_relacionados as $pedido) {?>


                             <div class="col-md-2 col-sm-4 col-xs-4 text-center">
                                 <div class="info-box bg-gray">

                                     <?php $rota=1 ; $id_doca = $this->uri->segment(2); $id_palt = $this->uri->segment(4);  
                                                            if ($this->ion_auth->is_admin()){
                                                            ?>
                                     <a href="#" data-toggle="modal" data-target="#despacha-pedidos"
                                         data-rota="<?=base_url('doca/' . $id_doca . '/palete' . '/' . $id_palt . '/removePedido' . '/' . $pedido['id'].'/'.$rota)?>"
                                         style="position: absolute;top: -3px;right: 6px;font-size: 10px;font-weight: 400;">
                                         <span class="badge bg-yellow"
                                             style="border:solid 2px; border-color:#727272;">expedir</span>
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
                     <div class="box-footer">
                         <?php if($palete_selecionado['ativo'] == 1 && $stat_palete != 0 && $stat_palete != 2){?>
                         <h3 class="box-title"><b>Sairá da página somente após gerar etiqueta!!</b></h3>
                         <?php } elseif($stat_palete == 0){?>


                         <a href="<?=base_url('doca/' . $id_doca)?>" class="btn btn-xs pull-right btn-danger"
                             style="padding:3px; margin-right: 5px;">Finalizar
                             Operação
                         </a>
                         <?php }?>

                     </div>
                 </div>

             </div>
         </div>

     </section>
     <!-- /.content -->
 </div>