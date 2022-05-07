<nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>


    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

            <li class="dropdown tasks-menu">
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="pull-right" id="navbar-collapse">
                    <form action="<?=base_url('pesquisa')?>" class="navbarr-form navbar-left" role="search">
                        <div class="form-group" style="margin-bottom:0px;">
                            <input name="termo" style="float:left; display: inline-block; width:auto;" type="text"
                                class="form-control" id="navbar-search-input" placeholder="Pesquisar pedidos...">
                            <button style="float:left; display: inline-block; border-radius: 0px;" class="btn btn-success my-2 my-sm-0"
                                type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /.navbar-collapse -->
            </li>

            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding:10px; padding-top:15px;">
                    <img src="<?=base_url('assets/dist/img/user.png')?>" class="user-image" alt="User Image">
                    <span class="hidden-xs">
                        <?php $user = $this->ion_auth->user()->row();
                            echo $user->first_name .' '. $user->last_name;
                        ?>
                    </span>
                </a>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
                <a href="#" data-toggle="modal" data-target="#modal-default" style="padding:10px; padding-top:15px;"><i class="fas fa-sign-out-alt"></i></a>
            </li>
           
        </ul>
    </div>
</nav>