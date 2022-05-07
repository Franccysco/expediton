<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Relatórios
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('relatorios')?>">Relatórios</a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- START CUSTOM TABS -->
    <!-- <h2 class="page-header">Selecione a Categoria para o relatório</h2> -->

    <div class="row">
      <div class="col-md-12">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-boxes"></i> Pedidos</a></li>
            <!-- <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-th-large"></i> Docas</a></li>
            <li><a href="#tab_3" data-toggle="tab"> <i class="fa fa-pallet"></i> Paletes</a></li> -->

            <!-- <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li> -->
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <!-- <b>Relatório de Pedidos:</b> -->

              <div class="row">

                <div class="col-md-4">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <i class="fa fa-file-text"></i>

                      <h3 class="box-title">Relatórios Rápidos</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <a href="<?=base_url('todos-os-pedidos')?>" class="btn btn-app">
                        <span class="badge bg-blue">Todos</span>
                        <i class="fa fa-boxes"></i>Todos os Pedidos
                      </a>
                      <a href="<?=base_url('pedidos-por-doca')?>" class="btn btn-app">
                        <span class="badge bg-green">Doca</span>
                        <i class="fa fa-boxes"></i>Pedidos por Doca
                      </a>
                      <a href="<?=base_url('pedidos-por-doca-mista')?>" class="btn btn-app">
                        <span class="badge bg-yellow">Mista</span>
                        <i class="fa fa-boxes"></i> Pedidos doca Mista
                      </a>

                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->

                <div class="col-md-8">
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <i class="fa fa-file-text"></i>

                      <h3 class="box-title">Relatórios Customizáveis</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                      <!-- <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-exclamation-circle"></i> Deixe em branco caso não deseje utilizar o
                          parâmetro.!</h4>
                      </div> -->

                      <div class="row">

                        <div class="col-md-6">
                          <form action="<?=base_url('pedidos-por-rota')?>" method="post">
                             <div class="input-group">
                              <label id="rota">Rota</label>
                              <select name="rota" class="form-control select2" style="width: 100%;">
                                <option disabled="disabled" selected="selected">Selecione a rota</option>
                                <?php foreach ($rotas as $rota): ?>
                                <option value="<?=$rota['rota']?>">
                                  <?=$rota['rota']?>
                                </option>
                                <?php endforeach;?>
                              </select>
                              <span class="input-group-btn" style="top: 13px; right: -9px;">
                                <button type="submit" class="btn btn-success btn-flat"> <i class="fa fa-file-text"></i> Emitir Relatório</button>
                              </span>
                            </div>
                          </form>
                        </div>

                      </div>







                    </div>
                    <!-- /.box-body -->
                  </div>
                  <!-- /.box -->
                </div>
                <!-- /.col -->




                <?php if ($this->uri->segment(1) == "todos-os-pedidos") {?>
                <div class="col-md-12">
                  <div class="box box-success">


                    <div class="box-body">

                      <table id="example2" class="table  table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Código</th>
                            <th>Data de Entrada</th>
                            <th>Palete</th>
                            <th>Rota</th>
                            <th>Doca</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if ($pedidos == false): ?>
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
                          <?php foreach ($pedidos as $pedido) {?>
                          <tr>
                            <td>
                              <?=$pedido['id']?>
                            </td>
                            <td>
                              <?=$pedido['cod_pedido']?>
                            </td>
                            <td>
                              <?php echo data($pedido['horario_entrada'])?>
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

                          </tr>

                          <?php }?>
                          <?php endif;?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php }?>

                <?php if ($this->uri->segment(1) == "pedidos-por-doca") {?>
                <div class="col-md-12">
                  <div class="box box-success">


                    <div class="box-body">

                      <table id="example2" class="table  table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <!-- <th style="width: 10px">#</th> -->
                            <th>Doca</th>
                            <th>Palete</th>
                            <th>Pedido</th>
                            <th>Data de Entrada</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if ($pedidos_doca == false): ?>
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
                          <?php foreach ($pedidos_doca as $pedido) {?>
                          <tr>
                            <td>
                              <?=$pedido['cod_doca']?>
                            </td>
                            <td>
                              <?=$pedido['cod_palete']?>
                            </td>
                            <td>
                              <?=$pedido['cod_pedido']?>
                            </td>
                            <td>
                              <?php echo data($pedido['horario_entrada'])?>
                            </td>

                          </tr>

                          <?php }?>
                          <?php endif;?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php }?>

                <?php if ($this->uri->segment(1) == "pedidos-por-doca-mista") {?>
                <div class="col-md-12">
                  <div class="box box-success">


                    <div class="box-body">

                      <table id="example2" class="table  table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Doca Mista</th>
                            <th>Palete</th>
                            <th>Pedido</th>
                            <th>Data de Entrada</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if ($pedidos_doca_mista == false): ?>
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
                          <?php foreach ($pedidos_doca_mista as $pedido) {?>
                          <tr>
                            <td>
                              <?=$pedido['cod_doca']?>
                            </td>
                            <td>
                              <?=$pedido['cod_palete']?>
                            </td>
                            <td>
                              <?=$pedido['cod_pedido']?>
                            </td>
                            <td>
                              <?php echo data($pedido['horario_entrada'])?>
                            </td>

                          </tr>

                          <?php }?>
                          <?php endif;?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php }?>


                <?php if ($this->uri->segment(1) == "pedidos-por-rota") {?>
                <div class="col-md-12">
                  <div class="box box-success">

                  

                    <div class="box-body">

                      <table id="example2" class="table  table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Rota</th>
                            <th>Pedido</th>
                            <th>Data de Entrada</th>
                            <th>Palete</th>
                            <th>Doca</th>                            
                          </tr>
                        </thead>
                        <tbody>

                          <?php if ($pedidos_rota == false): ?>
                          <tr>
                            <td colspan="7">
                              <div class="alert alert-warning alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h4><i class="icon fa fa-exclamation-circle"></i> Rota sem pedidos ainda!</h4>
                                Nenhum Pedido encontrado na rota, cadastre pedidos no palete da rota: <?php echo'<span class="badge bg-blue">'.$rota_input.'</span>'; ?>
                              </div>
                            </td>
                          </tr>
                          <?php else: ?>
                          <?php foreach ($pedidos_rota as $pedido) {?>
                          <tr>
                            <td>
                              <?=$pedido['rota']?>
                            </td>
                            <td>
                              <?=$pedido['cod_pedido']?> 
                            </td>
                            <td>
                              <?php echo data($pedido['horario_entrada'])?>
                            </td>
                             <td>
                              <?=$pedido['cod_palete']?>
                            </td>
                             <td>
                              <?=$pedido['cod_doca']?>
                            </td>

                          </tr>

                          <?php }?>
                          <?php endif;?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <?php }?>

                <!-- <php if ($this->uri->segment(1) == "pedidos-por-cliente") {?>
                <div class="col-md-12">
                  <div class="box box-success">


                    <div class="box-body">

                      <table id="example2" class="table  table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>Cod Cliente</th>
                            <th>Cliente</th>
                            <th>Pedido</th>
                            <th>Data de Entrada</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php if ($pedidos_cliente == false): ?>
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
                          <?php foreach ($pedidos_cliente as $pedido) {?>
                          <tr>
                            <td>
                              <?=$pedido['cod_cliente']?>
                            </td>
                            <td>
                             <?=$pedido['nome_empresa']?> 
                            </td>
                            <td>
                              <?=$pedido['cod_pedido']?>
                            </td>
                            <td>
                              <?php echo data($pedido['horario_entrada'])?>
                            </td>

                          </tr>

                          <?php }?>
                          <?php endif;?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <php }?> -->



              </div>

            </div>
            <!-- /.tab-pane -->
            <!-- <div class="tab-pane" id="tab_2">
              The European languages are members of the same family. Their separate existence is a myth.
              For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
              in their grammar, their pronunciation and their most common words. Everyone realizes why a
              new common language would be desirable: one could refuse to pay expensive translators. To
              achieve this, it would be necessary to have uniform grammar, pronunciation and more common
              words. If several languages coalesce, the grammar of the resulting language is more simple
              and regular than that of the individual languages.
            </div> -->
            <!-- /.tab-pane -->
            <!-- <div class="tab-pane" id="tab_3">
              Lorem Ipsum is simply dummy text of the printing and typesetting industry.
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
              when an unknown printer took a galley of type and scrambled it to make a type specimen book.
              It has survived not only five centuries, but also the leap into electronic typesetting,
              remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset
              sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
              like Aldus PageMaker including versions of Lorem Ipsum.
            </div> -->
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div>
        <!-- nav-tabs-custom -->
      </div>
      <!-- /.col -->


    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->



  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->