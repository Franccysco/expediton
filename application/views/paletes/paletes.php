<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manter Paletes
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('paletes')?>">Paletes</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">


    <?php if ($this->session->flashdata('error') == true): ?>
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-times-circle"></i> Erros</h4>
      <?php echo $this->session->flashdata('error');?>
    </div>
    <?php endif;?>

    <?php if ($this->session->flashdata('success') == true): ?>
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check-circle"></i> Sucesso</h4>
      <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php endif;?>


    <?php $rota = $this->uri->segment(2); if($rota == 'cadastro' ):?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Paletes</h3>
          </div>
          <form method="post" action="<?=base_url('salvar-palete')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <label id="cod_palete">Código</label>
                  <input type="text" id="cod_palete" name="cod_palete" class="form-control" placeholder="Código do palete"
                    value="<?=set_value('cod_palete')?>" required>
                </div>
                 <input type="hidden" name="status" class="form-control"  value="1" required>
               <div class="col-md-4">
                  <label id="rota">Rota</label>
                  <input type="text" id="rota" name="rota" class="form-control" placeholder="Informe a rota"
                    value="<?=set_value('rota')?>" required>
                </div>
                <div class="col-md-4">
                  <!-- <label id="qtd_vagas">Limite de Pedidos</label> -->
                  <input type="hidden" id="qnt_vagas" name="qnt_vagas" class="form-control" placeholder="Limite de pedidos" value="99"
                    required>
                </div>
                <input type="hidden" name="ativo" class="form-control" 
                  value="0" required>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('paletes')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>

    <?php $id = $this->uri->segment(2);if ($id == 'editar'): ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar palete</h3>
          </div>

          <!-- <php var_dump($palete);
          echo $this->uri->segment(3);?> -->

          <form method="post" action="<?=base_url('atualizar-palete')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <label id="cod_palete">Código</label>
                  <input type="text" id="cod_palete" name="cod_palete" class="form-control" placeholder="Código do palete"
                    value="<?=$palete_ed['cod_palete']?>" required>
                </div>
                <div class="col-md-4">
                  <label id="rota">Rota</label>
                  <input type="text" id="rota" name="rota" class="form-control" placeholder="Informe a rota"
                    value="<?=$palete_ed['rota']?>" required>
                </div>
                <input type="hidden" name="ativo" class="form-control" 
                  value="<?=$palete_ed['ativo']?>" required>
                <div class="col-md-4">
                  <label>Status</label>
                  <select name="status" class="form-control" style="width: 100%;">
                    <option disabled>Selecione status</option>
                    <?php if($palete_ed['status'] == 1){?>
                    <option value="1" selected>Disponível</option>
                    <option value="0">Fechado</option>
                    <option value="2">Em uso</option>
                    <?php } elseif($palete_ed['status'] == 0){?>
                    <option value="1">Disponível</option>
                    <option value="0" selected>Fechado</option>
                    <option value="2">Em uso</option>
                     <?php } else{?>
                     <option value="1">Disponível</option>
                    <option value="0" >Fechado</option>
                    <option value="2" selected>Em uso</option>
                     <?php } ?>
                  </select>
                </div>
                <div class="col-md-4">
                  <label id="estado">Limite de Pedidos</label>
                  <input type="text" id="qnt_vagas" name="qnt_vagas" class="form-control" placeholder="Limite de pedidos" value="<?=$palete_ed['qnt_vagas']?>"
                    required>
                </div>

                <input type="hidden" name="id" value="<?=$palete_ed['id']?>"/>

              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button disabled type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('paletes')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-defaut">

          <div class="box-header col-md-12">
            <a href="<?=base_url('paletes/cadastro')?>" class="btn btn-success pull-right">
              <i class="fa fa-plus-circle"></i> Cadastrar Palete
            </a>
          </div>

          <div class="box-body">
            <table id="paletesTable" class="table table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Rota</th>
                  <th>Status</th>
                  <th>Situação</th>
                  <th style="width: 140px">Ações</th>
                </tr>
              </thead>
              <tbody>

                <!-- <?php if ($paletes == FALSE): ?>
                <tr>
                  <td colspan="6">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre um palete!</h4>
                      Nenhum palete encontrado!
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($paletes as $palete){ ?>
                <tr>
                  <td>
                    <?=$palete['id']?>
                  </td>
                  <td>
                    <?=$palete['cod_palete']?>
                  </td>
                  <td>
                    <?=$palete['rota']?>
                  </td>
                  <td>
                      <span <?php  
                                  if($palete['status']==1){echo 'class="label label-success">Disponível</span>';}
                                  elseif ($palete['status']==0) { echo 'class="label label-danger">Fechado</span>'; }
                                  else{echo 'class="label label-warning">Em uso</span>';}
                              ?>
                  </td>
                  <td>
                    <?=$palete['ativo'] == 1  ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';?>
                  </td>
                  <td>
                    <a href="<?=base_url('paletes/editar/'.$palete['id'])?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
                      Editar</a>

                    <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $palete['id'];?>"
                      data-rota="<?php echo base_url('exluir-palete/');?>" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> Excluir</a>
                  </td>
                </tr>

                <?php } ?>
                <?php endif; ?> -->

              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
    </div>



    <!-- Modal usuarios cadastro -->
    <!-- <php $this->load->view('modal-client-create')?>
    <php $this->load->view('modal-client-update')?> -->


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->