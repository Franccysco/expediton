<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?=base_url('assets/dist/img/user.png')?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>
                    <?php $user = $this->ion_auth->user()->row();
                    echo $user->first_name . ' ' . $user->last_name;
                    ?>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU OPÇÕES</li>
            <li>
                <a href="<?=base_url()?>">
                    <i class="fa fa-home"></i> <span>Dashboard - Home</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('pedidos')?>">
                    <i class="fa fa-boxes"></i> <span>Pedidos</span>
                </a>
            </li>
            <?php  if ($this->ion_auth->is_admin()):?>
            <li>
                <a href="<?=base_url('docas')?>">
                    <i class="fa fa-th-large"></i>
                    <span>Docas</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('paletes')?>">
                    <i class="fa fa-pallet"></i> <span>Paletes</span>
                </a>
            </li>
            <!-- <li>
                <a href="<=base_url('rotas')?>">
                    <i class="fa fa-route"></i>
                    <span>Rotas</span>
                </a>
            </li> -->
            <!-- <li>
                <a href="<=base_url('clientes')?>">
                    <i class="fa fa-users"></i>
                    <span>Clientes</span>
                </a>
            </li> -->
            <li>
                <a href="<?=base_url('usuarios')?>">
                    <i class="fa fa-users"></i> <span>Usuários</span>
                </a>
            </li>
            <li>
                <a href="<?=base_url('relatorios')?>">
                    <i class="fa fa-file-text"></i> <span>Relatórios</span>
                </a>
            </li>
            <?php  endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>

<!-- =============================================== -->