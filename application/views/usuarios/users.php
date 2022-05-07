<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Configurações de controle de acesso<small>Manter Usuários, Grupos</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?=base_url('')?>"><i class="fa fa-home"></i> Home</a></li>
      <li class="active"><a href="<?=base_url('usuarios')?>">Usuários</a></li>
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

    <!-- Cadastrar Usuários -->
    <?php $rota = $this->uri->segment(2); if($rota == 'cadastro' ):?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Cadastrar Usuário</h3>
          </div>
          <form method="post" action="<?=base_url('salvar-usuario')?>" enctype="multipart/form-data">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <label id="nome">Nome</label>
                  <input type="text" id="nome" name="first_name" class="form-control" placeholder="Nome do usuário" value="<?=set_value('first_name')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="cpf">Sobrenome</label>
                  <input type="text" name="last_name" class="form-control" placeholder="Sobrenome do usuário" value="<?=set_value('last_name')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="login">Login</label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Login do usuário" value="<?=set_value('username')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="senha">Senha</label>
                  <input type="password" name="password" class="form-control" placeholder="Senha do usuário" value="<?=set_value('password')?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="senha">Confirmar Senha</label>
                  <input type="password" name="password_confirm" class="form-control" placeholder="Confirme Senha" value="<?=set_value('password_confirm')?>"
                    required>
                </div>
                <!-- 
                <div class="col-md-3">
                  <label>Tipo de Usuário</label>
                  <select name="tipo_perfil" class="form-control select2" style="width: 100%;">
                    <option disabled selected="selected">Selecione nível de usuário</option>
                    <?php foreach ($grupos as $grupo):?>
                    <option value="<?=$grupo->id?>">
                      <?=$grupo->name?>
                    </option>
                    <?php endforeach; ?>
                  </select>
                </div> -->

                <!-- <div class="col-md-3">
                  <php
                if (isset($grupos)) {
                    echo form_label('Grupos', 'grupos[]');
                    foreach ($grupos as $group) {
                        echo '<div>';
                        echo '<label>';
                        echo '<input type="checkbox" name="grupos[]" class="flat-red" value="$group->id">';
                       // echo form_checkbox('grupos[]', $group->id, set_checkbox('grupos[]', $group->id));
                        echo ' ' . $group->name;
                        echo '</label>';
                        echo '</div>';
                    }
                }
                ?>
                </div> -->

                

              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('usuarios')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>
    <!-- Editar Usuários -->
    <?php $id = $this->uri->segment(2);if ($id == 'editar'): ?>
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Editar Usuário</h3>
          </div>

          <!-- <php var_dump($usuario);
          echo $this->uri->segment(3);?> -->

          <form method="post" action="<?=base_url('atualizar-usuario')?>">
            <div class="box-body">
              <div class="row">
                <div class="col-md-3">
                  <label id="nome">Nome</label>
                  <input type="text" id="nome" name="first_name" class="form-control" placeholder="Nome do usuário" value="<?=$usuario_ed->first_name?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="cpf">Sobrenome</label>
                  <input type="text" name="last_name" class="form-control" placeholder="Sobrenome do usuário" value="<?=$usuario_ed->last_name?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="login">Login</label>
                  <input type="text" id="username" name="username" class="form-control" placeholder="Login do usuário" value="<?=$usuario_ed->username?>"
                    required>
                </div>
                <div class="col-md-3">
                  <label id="senha">Senha <i class="icon fa fa-warning" data-toggle="tooltip"
                                    title="Preencher somente se quiser alterar a senha" ></i></label>
                  <input type="password" name="password" class="form-control" placeholder="Senha do usuário" value="<?=set_value('password')?>">
                </div>
                <div class="col-md-3">
                  <label id="senha">Confirmar Senha</label>
                  <input type="password" name="password_confirm" class="form-control" placeholder="Confirme Senha" value="<?=set_value('password_confirm')?>">
                    
                </div>
                

                <!-- <div class="col-md-3">
                  <php
                if (isset($grupos)) {
                    echo form_label('Grupos', 'grupos[]');
                    foreach ($grupos as $group) {
                        echo '<div>';
                        echo '<label>';
                        echo '<input type="checkbox" name="grupos[]" class="flat-red" value="$group->id">';
                       // echo form_checkbox('grupos[]', $group->id, set_checkbox('grupos[]', $group->id));
                        echo ' ' . $group->name;
                        echo '</label>';
                        echo '</div>';
                    }
                }
                ?>
                </div> -->

                <div class="col-md-3">
                 <label id="grupo">Grupos:   </label>

                <?php foreach ($groups as $group): ?>
              <label  style="margin-top:30px;">
                    <?php
                    $gID = $group['id'];
                    $checked = null;
                    $item = null;
                    foreach ($currentGroups as $grp) {
                        if ($gID == $grp->id) {
                            $checked = 'checked="checked"';
                            break;
                        }
                    }
                    ?>
              <input type="checkbox" class="flat-red" name="groups[]" value="<?php echo $group['id']; ?>"<?php echo $checked; ?>>
              <?php echo $group['name']; ?>
              </label>
          <?php endforeach?>
                    </div>
                

              </div>
              <input type="hidden" name="id" value="<?=$usuario_ed->id?>" />
            </div>
            <!-- /.box-body -->

            <div class="box-footer" style="text-align: right;">
              <button disabled type="reset" class="btn btn-default pull-left">Limpar</button>
              <button type="submit" class="btn btn-primary">Salvar</button>
              <a href="<?=base_url('usuarios')?>" class="btn btn-danger">Cancelar</a>
            </div>
          </form>
          <!-- /.box-body -->
        </div>
      </div>
    </div>
    <?php endif;?>

    <!-- Lista de Usuários -->
    <div class="row">
      <div class="col-md-12">
        <div class="box box-defaut">

          <div class="box-header col-md-12">
            <a href="<?=base_url('usuarios/cadastro')?>" class="btn btn-success pull-right">
              <i class="fa fa-plus-circle"></i> Cadastrar Usuário
            </a>
          </div>

          <div class="box-body">
            <table id="tables-exp" class="table table-striped dataTable" style="width: 100%">
              <thead>
                <tr>
                  <th style="width: 10px">#</th>
                  <th>Nome</th>
                  <th>Sobrenome</th>
                  <th>Login</th>
                  <th>Grupos</th>
                  <th>Status</th>
                  <th style="width: 180px">Ações</th>
                </tr>
              </thead>
              <tbody>

                <?php if ($users == FALSE): ?>
                <tr>
                  <td colspan="6">
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fa fa-exclamation-circle"></i> Cadastre um Usuário!</h4>
                      Nenhum Usuário encontrado
                    </div>
                  </td>
                </tr>
                <?php else: ?>
                <?php foreach ($users as $user){ ?>
                <tr>
                  <td>
                    <?=$user->id?>
                  </td>
                  <td>
                    <?=$user->first_name?>
                  </td>
                  <td>
                    <?=$user->last_name?>
                  </td>
                  <td>
                    <?=$user->username?>
                  </td>
                  <td>
                    <?php foreach ($user->groups as $group): ?>
                    <span class="label <?php if($group->name == "admin"){ echo "label-warning";}else{echo"label-info";}?>">
                      <?php echo $group->name;?>
                    </span><br>
                    <?php endforeach?>
                  </td>
                  <td>
                    <?php echo ($user->active == 1) ? '<span class="label label-success">Ativo</span>' : '<span class="label label-default">Inativo</span>' ?>
                  </td>


                  <!-- Usuario adm sem opções -->
                  <?php if ($user->username != 'admin') {?>

                  <td>
                    <a href="<?=base_url('usuarios/editar/'.$user->id)?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i>
                      Editar</a>
                    <?php if ($user->active == 1) {?>
                    <a href="#" data-toggle="modal" data-target="#desativar-usuario" data-customer="<?php echo $user->id;?>"
                      data-rota="<?php echo base_url('desativar-usuario/');?>" data-nome="<?php echo $user->username?>" class="btn btn-success btn-xs"><i class="fa fa-toggle-on"></i>
                      Desativar</a>
                    <?php }else{?>
                    <a href="<?=base_url('ativar-usuario/'.$user->id)?>" class="btn btn-default btn-xs"><i class="fa fa-toggle-off"></i>
                      Ativar</a>
                    <?php }?>

                    <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="<?php echo $user->id;?>"
                      data-rota="<?php echo base_url('exluir-usuario/');?>" class="btn btn-danger btn-xs">
                      <i class="fa fa-trash"></i> Excluir</a>
                  </td>

                  <?php }else{?>
                  <td></td>
                  <?php }?>

                </tr>

                <?php } ?>
                <?php endif; ?>

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