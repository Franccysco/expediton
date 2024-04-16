<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Relatorio extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->verify_login();
        $this->verify_permission();

    }

    public function index()
    {
     
      
        $dados['titulo'] = 'Relatórios';
        
        $dados['rotas'] = $this->palete_model->rotas();


       $this->render_page("relatorios/relatorios", $dados);



    }

    public function todosPedidos()
    {
        $dados['pedidos'] = $this->pedido_model->pedidosRelatorio();
        $dados['titulo'] = 'Relatórios - Todos os pedidos';
        

        $dados['rotas'] = $this->palete_model->rotas();


       $this->render_page("relatorios/relatorios", $dados);


    }

    public function pedidosDoca()
    {
        //Pedidos por doca, passando parametro 1 para tipo de doca normal
        $dados['pedidos_doca'] = $this->pedido_model->pedidosRelatorio(1);
        $dados['titulo'] = 'Relatórios - Pedidos por Doca';
        $dados['rotas'] = $this->palete_model->rotas();

       
       $this->render_page("relatorios/relatorios", $dados);

    }

    public function pedidosDocaMista()
    {
        //Pedidos por doca, passando parametro 0 para tipo de doca normal
        $dados['pedidos_doca_mista'] = $this->pedido_model->pedidosRelatorio(0);
        $dados['titulo'] = 'Relatórios - Pedidos por Doca Mista';

        $dados['rotas'] = $this->palete_model->rotas();

        

       $this->render_page("relatorios/relatorios", $dados);

    }

    public function pedidosRota()
    {
        $dados['rotas'] = $this->palete_model->rotas();
        
        $rota = $this->input->post('rota');
        $buscaInterna = $this->input->post('buscaInterna');
        if ($buscaInterna) {
            print_r($_POST);
            var_dump($this->input->post()); die;
        }
        $dados['rota_input'] = $rota;
        $dados['pedidos_rota'] = $this->pedido_model->pedidoRotaRelatorio($rota);
        $dados['titulo'] = 'Relatórios - Pedidos por Rota';

       $this->render_page("relatorios/relatorios", $dados);

    }

   /* public function pedidosCliente()
    {

        $cliente_id = $this->input->post('cliente_id');

        $dados['pedidos_cliente'] = $this->pedido_model->pedidoClienteRelatorio($cliente_id);
        $dados['titulo'] = 'Relatórios - Pedidos por Cliente';
        $dados['rotas'] = $this->rota_model->GetAll('cod_rota');
        $dados['clientes'] = $this->cliente_model->GetAll('cod_cliente');

        $this->load->view('template/header', $dados);
        $this->load->view('relatorios');
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');
    }*/

}
