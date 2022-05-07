<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>

            Dashboard
            <small>Distribuição das docas </small>

        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>

        <div class="col-md-4" style="margin-top:10px;">
            <form method="post" action="<?=base_url('busca-rota')?>" enctype="multipart/form-data" class="search-form">
                <div class="input-group">
                    <!-- <input type="text" name="busca" class="form-control" placeholder="Buscar por rota..."> -->

                    <select name="busca" class="form-control select2" style="width: 100%;">
                        <option disabled="disabled" selected="selected">Buscar por rota...</option>
                        <?php foreach ($rotas as $rota): ?>
                        <option value="<?=$rota['rota']?>">
                            <?=$rota['rota']?>
                        </option>
                        <?php endforeach;?>
                    </select>

                    <div class="input-group-btn">
                        <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- /.input-group -->
            </form>
        </div>

        <br>

    </section>

    <!-- Main content -->
    <section class="content" style="margin-top:24px;">


        <?php if ($this->session->flashdata('success') == true): ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h4><i class="icon fa fa-check-circle"></i> Sucesso</h4>
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        </div>
        <?php endif;?>


        <!-- Docas (Stat box) -->
        <div class="row">
            <?php if ($docas == FALSE): ?>
            <div class="col-md-12">
                <div class="callout callout-warning">
                    <a style="float:right;" href="<?=base_url('docas/cadastro')?>" class="btn btn-success">
                        <i class="fa fa-plus-circle"></i> Cadastrar Doca
                    </a>
                    <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre uma Doca!</h4>
                    Nenhuma Doca encontrada ainda!
                </div>
            </div>

            <?php else: ?>
            <?php foreach ($docas as $doca){ ?>
            <!-- ./col -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <?php

                 $qtd_atual = $this->doca_model->qtdPaletes($doca['id']);
                                
                ?>
                <div class="small-box  <?=$doca['status'] == 1? 'bg-green': 'bg-red'?>">

                    <!-- <php if ($this->ion_auth->is_admin() && !$qtd_atual == 0) {?>
                    <a href="#" data-toggle="modal" data-target="#limpar-doca" data-rota="<=base_url('limpa-pedidos-doca/' . $doca['id']);?>"
                        style="position: absolute;top: -10px;right: -8px;font-size: 10px;font-weight: 400;" data-toggle="tooltip"
                        title="Limpar todos os pedidos da doca">
                        <span class="badge bg-yellow" style="border:solid 2px; border-color:#727272">Limpar pedidos</span>
                    </a>
                    <php }?> -->


                    <!-- 
                     <a href="#" style="position: absolute;top: -6px;right: 43px;font-size: 10px;font-weight: 400;">
                        <span class="badge bg-orange" style="border:solid 2px; border-color:#727272">Limpar pedidos</span>
                    </a>
                     -->

                    <div class="inner">
                        <h3>
                            <?=$doca['cod_doca']?>
                        </h3>

                        <p>
                            <span class=" badge bg-default" data-toggle="tooltip" title="Nº de paletes na doca / Capacidade máxima">
                                <?=$qtd_atual?> /
                                <?=$doca['qnt_vagas']?>
                            </span>
                            <?php if($doca['tipo'] == 0):?>
                            <span class="badge bg-purple">MISTA</span>
                            <?php endif?>


                        </p>

                        <!-- <?php if ($this->ion_auth->is_admin() && !$qtd_atual == 0) {?>
                        <a href="#" data-toggle="modal" data-target="#limpar-doca" data-rota="<?=base_url('limpa-pedidos-doca/' . $doca['id']);?>"
                            style="border-radius:10px; padding: 0px 7px; border:solid 2px; border-color:#727272" type="button"
                            class="btn btn-warning btn-xs" data-toggle="tooltip" title="Limpar todos os pedidos da doca">
                            Limpar pedidos
                        </a>
                        <?php }?>
                       

                        <?php if ($this->ion_auth->is_admin() && !$qtd_atual == 0) {?>
                        <a href="#" style="position: relative;margin: -9px -44px 12px; font-size: 10px;font-weight: 400;">
                            <span class="badge bg-blue">Limpar pedidos</span>
                        </a>
                        <?php }?> -->






                    </div>
                    <div class="icon">
                        <i class="fa fa-th-large "></i>
                    </div>
                    <a href="<?=base_url('doca/'.$doca['id'])?>" class="small-box-footer">Ver Paletes <i class="fa fa-eye"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <?php } ?>
            <?php endif; ?>

        </div>
        <!-- /.row -->




    </section>

</div>
<!-- /.content-wrapper -->