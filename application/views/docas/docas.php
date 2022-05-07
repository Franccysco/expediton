<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manter Docas
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('docas')?>">Docas</a></li>
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
            <h3 class="box-title">Cadastrar Doca</h3>
          </div>
          <form method="post" action="<?=base_url('salvar-doca')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <label id="cod_doca">Código</label>
                  <input type="text" id="cod_doca" name="cod_doca" class="form-control" placeholder="Código da doca"
                    value="<?=set_value('cod_doca')?>" required>
                </div>
                <input type="hidden" name="status" class="form-control" placeholder="Status da Doca" value="1" required>
                <!-- <div class="col-md-4">
                  <label id="status">Status</label>
                  
                </div> -->
                <div class="col-md-4">
                  <label id="qnt_vagas">Limite de Paletes</label>
                  <input type="text" id="qnt_vagas" name="qnt_vagas" class="form-control"
                    placeholder="Limite de paletes" value="<?=set_value('qnt_vagas')?>" required>
                </div>


                <div class="col-md-4">
                  <label>Tipo de Doca</label>
                  <select name="tipo" class="form-control" style="width: 100%;">
                    <option disabled selected>Selecione o tipo de doca</option>

                    <option value="1">Padrão</option>
                    <option value="0">Mista</option>

                  </select>
                </div>


              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('docas')?>" class="btn btn-danger">Cancelar</a>
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
            <h3 class="box-title">Editar Doca</h3>
          </div>

          <!-- <php var_dump($doca);
          echo $this->uri->segment(3);?> -->

          <form method="post" action="<?=base_url('atualizar-doca')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-4">
                  <label id="cod_doca">Código</label>
                  <input type="text" id="cod_doca" name="cod_doca" class="form-control" placeholder="Código da doca"
                    value="<?=$doca_ed['cod_doca']?>" required>
                </div>
                <input type="hidden" name="status" class="form-control" placeholder="status da doca"
                  value="<?=$doca_ed['status']?>" required>
                <!-- <div class="col-md-4">
                  <label id="status">Status</label>                  
                </div> -->
                <div class="col-md-4">
                  <label id="qnt_vagas">Limite de Paletes</label>
                  <input type="text" id="qnt_vagas" name="qnt_vagas" class="form-control"
                    placeholder="Limite de paletes" value="<?=$doca_ed['qnt_vagas']?>" required>
                </div>

                <div class="col-md-4">
                  <label>Tipo de Doca</label>
                  <select name="tipo" class="form-control" style="width: 100%;">
                    <option disabled>Selecione o tipo de doca</option>
                    <?php if($doca_ed['tipo'] == 1){?>
                    <option value="1" selected>Padrão</option>
                    <option value="0">Mista</option>
                    <?php } else{?>
                    <option value="1">Padrão</option>
                    <option value="0" selected>Mista</option>
                    <?php } ?>
                  </select>
                </div>

              </div>
              <input type="hidden" name="id" value="<?=$doca_ed['id']?>" />
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button disabled type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('docas')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>



    <div class="box box-defaut">

      <div class="box-header col-md-12">
        <a href="<?=base_url('docas/cadastro')?>" class="btn btn-success pull-right">
          <i class="fa fa-plus-circle"></i> Cadastrar Doca
        </a>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="box-body">
            <table id="docasTable" class="table table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Status</th>
                  <th>Limite de Paletes</th>
                  <th>Tipo Doca</th>
                  <th style="width: 140px">Ações</th>
                </tr>
              </thead>
              <tbody>

                <!-- <?php if ($docas == FALSE): ?>
                <tr>
                  <td colspan="6">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre uma Doca!</h4>
                      Nenhuma Doca encontrada!
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($docas as $doca){ ?>
                <tr>
                  <td>
                    <?=$doca['id']?>
                  </td>
                  <td>
                    <?=$doca['cod_doca']?>
                  </td>
                  <td>
                    <span <?=$doca['status']==1 ? 'class="label label-success">Disponível</span>' :
                          'class="label label-danger">Ocupado</span>' ?> </td> <td>
                      <?=$doca['qnt_vagas']?>
                  </td>
                  <td>
                    <span <?=$doca['tipo']==1 ? 'class="label label-success">Padrão</span>' :
                          'class="label label-warning">Mista</span>' ?> </td> <td>
                      <a href="<?=base_url('docas/editar/'.$doca['id'])?>" class="btn btn-primary btn-xs"><i
                          class="fa fa-edit"></i>
                        Editar</a>

                      <a href="#" data-toggle="modal" data-target="#delete-modal"
                        data-customer="<?php echo $doca['id'];?>" data-rota="<?php echo base_url('exluir-doca/');?>"
                        class="btn btn-danger btn-xs">
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


  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->