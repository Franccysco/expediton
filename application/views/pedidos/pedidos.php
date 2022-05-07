<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manter Pedidos
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('pedidos')?>">Pedidos</a></li>
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


    <!-- <php $rota = $this->uri->segment(2); if($rota == 'cadastro' ):?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Pedido</h3>
          </div>
          <form method="post" action="<?=base_url('salvar-pedido')?>" enctype="multipart/form-data">
            <div class="box-body">

              <div class="row">
                <div class="col-md-3">
                  <label id="cod_pedido">Código</label>
                  <input type="text" id="cod_pedido" name="cod_pedido" class="form-control" placeholder="Código do pedido"
                    value="<?=set_value('cod_pedido')?>" required>
                </div> -->
    <!-- <div class="col-md-3">
                  <label>Rota</label>
                  <input type="text" id="rota_input" class="form-control" placeholder="Selecione a Rota" value="<?=set_value('rota')?>"
                    required onclick="getRota()">
                  <input type="hidden" id="rota_id" name="rota_id" class="form-control" value="<?=set_value('rota_id')?>">
                </div> -->
    <!-- <div class="col-md-3">
                  <label for="palet">Palete</label>
                  <input type="text" id="palete" class="form-control" placeholder="Selecione o Palete"
                    value="<=set_value('palete_id')?>" required onclick="getPalete()">
                    <input type="hidden" id="palete_id" name="palete_id" class="form-control" 
                    value="<=set_value('palete_id')?>">
                </div> -->
    <!-- <div class="col-md-3">
                  <div class="form-group">
                    <label id="cliente">Cliente</label>
                    <select name="cliente_id" class="form-control select2" style="width: 100%;">
                      <option disabled="disabled" selected="selected">Selecione o Cliente</option>
                      <php foreach ($clientes as $cliente): ?>
                      <option value="<=$cliente['id']?>">
                        <=$cliente['nome_empresa']?>
                      </option>
                      <php endforeach;?>
                    </select>
                  </div>
                </div> -->
    <!-- <input type="hidden" name="status" class="form-control" value="1" required>
                <input type="hidden" name="id_palete" value="7">
                <input type="hidden" name="id_doca" value="1"
              </div>
            </div> -->
    <!-- /.box-body -->

    <!-- <div class="box-footer" style="text-align: right;">
              <button type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('pedidos')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form> -->
    <!-- /.box-body -->
    <!-- </div>
      </div>
    </div> -->
    <!-- <php endif;?> -->

    <?php $id = $this->uri->segment(2);if ($id == 'editar'): ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar pedido</h3>
          </div>


          <form method="post" action="<?=base_url('atualizar-pedido')?>" enctype="multipart/form-data">

            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <label id="cod_pedido">Código</label>
                  <input type="text" id="cod_pedido" name="cod_pedido" class="form-control" placeholder="Código do pedido"
                    value="<?=$pedido_ed['cod_pedido']?>" required>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select id="status" name="status" class="form-control select2" style="width: 100%;">
                      <option disabled="disabled">Selecione o status</option>

                      <?php if($pedido_ed['status'] == 1){?>

                      <option value="1" selected>Recebido</option>
                      <option value="0">Despachado</option>

                      <?php } else{?>
                      <option value="1">Recebido</option>
                      <option value="0" selected>Despachado</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

              </div>
              <input type="hidden" name="id" value="<?=$pedido_ed['id']?>" />
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button disabled type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('pedidos')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>

    <?php endif;?>

    <?php $rota = $this->uri->segment(1);if ($rota == 'pedidos-expedidos'): ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-defaut">

          <div class="box-header col-md-12">
          <h2 class="box-title col-md-6"> <b>Pedidos Expedidos</b></h2>
            <a href="<?=base_url('pedidos')?>" class="btn btn-success pull-right">
              <i class="fa fa-boxes"></i> Pedidos Recebidos
            </a>
          </div>

          <div class="box-body">
            <table id="pedidosTable" class="table  table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Data de Saída</th>
                  <th>Status</th>
                  <th>Palete</th>
                  <th>Rota</th>
                  <?php  if ($this->ion_auth->is_admin()):?>
                  <th style="width: 140px">Ações</th>
                  <?php  endif;?>
                </tr>
              </thead>
              <tbody>

                <!-- <?php if ($pedidos == FALSE): ?>
                <tr>
                  <td colspan="7">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre um pedido!</h4>
                      Nenhum Pedido encontrado
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($pedidos as $pedido){ ?>
                <tr>
                  <td>
                    <?=$pedido['id']?>
                  </td>
                  <td>
                    <?=$pedido['cod_pedido']?>
                  </td>
                  <td>
                    <?php echo data($pedido['horario_ocorrencia']);?>
                  </td>
                  <td>
                    <span <?=$pedido['tipo_ocorrencia']==1 ? 'class="label label-success">Recebido</span>' :
                      'class="label label-danger">Expedido</span>' ?>
                  </td>
                  <td>
                    <?=$pedido['cod_palete']?>
                  </td>
                  <td>
                    <?=$pedido['rota']?>
                  </td>
                  
                  <?php  if ($this->ion_auth->is_admin()):?>
                  <td>
                    
                    <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $pedido['id'];?>"
                      data-rota="<?php echo base_url('exluir-pedido/');?>" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> Excluir</a>
                  </td>
                  <?php endif;?>
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

    <?php endif;?>

<?php $rota = $this->uri->segment(1);if ($rota == 'pedidos'): ?>

    <div class="row">
      <div class="col-md-12">
        <div class="box box-defaut">

          <div class="box-header col-md-12">
            <a href="<?=base_url('pedidos-expedidos')?>" class="btn btn-danger pull-right">
              <i class="fa fa-truck"></i> Pedidos Expedidos
            </a>
          </div>

          <div class="box-body">
            <table id="pedidosTable" class="table  table-striped" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Código</th>
                  <th>Data de Entrada</th>
                  <th>Status</th>
                  <th>Palete</th>
                  <th>Rota</th>
                  <th>Doca</th>
                  <?php  if ($this->ion_auth->is_admin()):?>
                  <th style="width: 140px">Ações</th>
                  <?php  endif;?>
                </tr>
              </thead>
              <tbody>

                <!-- <?php if ($pedidos == FALSE): ?>
                <tr>
                  <td colspan="7">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre um pedido!</h4>
                      Nenhum Pedido encontrado
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($pedidos as $pedido){ ?>
                <tr>
                  <td>
                    <?=$pedido['id']?>
                  </td>
                  <td>
                    <?=$pedido['cod_pedido']?>
                  </td>
                  <td>
                    <?php echo data($pedido['horario_entrada']);?>
                  </td>
                  <td>
                    <span <?=$pedido['status']==1 ? 'class="label label-success">Recebido</span>' :
                      'class="label label-danger">Despachado</span>' ?>
                  </td>
                  <td>
                    <?=$pedido['cod_palete']?>
                  </td>
                  <td>
                    <?=$pedido['rota']?>
                  </td>
                  <td>
                    <?=$pedido['cod_doca']?>
                  </td>
                  <?php  if ($this->ion_auth->is_admin()):?>
                  <td>
                    <a href="<?=base_url('pedidos/editar/'.$pedido['id'])?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
                      Editar</a>

                    <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $pedido['id'];?>"
                      data-rota="<?php echo base_url('exluir-pedido/');?>" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> Excluir</a>
                  </td>
                  <?php endif;?>
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
<?php endif;?>


    <!-- Modal paletes cadastro -->
    <!-- <php $this->load->view('modal-pedidos-paletes')?> -->



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->