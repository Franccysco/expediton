<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

    public function __construct() 
    {
        parent::__construct();
        $this->verfica_metodo_pagamento();
    }

    public function verify_login()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('login'));
        }
    }

    public function verify_permission()
    {
        if (!$this->ion_auth->in_group('admin')) {
            // $this->session->set_flashdata('error', 'Sem permissão para acessar esta página!');
            // redirect(base_url(), 'refresh');

            redirect(base_url('acesso-restrito'));
        }

    }

    public function verfica_metodo_pagamento() {
        
        if (!$this->verificar_pagamento() && $this->router->fetch_class() !== 'login') {
            redirect('login');
        }
    }

    public function verificar_pagamento() {
        $cnpj = "06098636000102";
        $url = "https://minhaarea.com/admin-expedition/clientes/pagamento/".$cnpj;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $cliente = json_decode($response);
      
        $pagamento_valido = ($cliente->success == "PAGO") ? true : false;

        return $pagamento_valido;
    }

    public function render_page($view, $data = null)
    {

        $viewdata = (empty($data)) ? $this->$data : $data;

        $this->load->view('template/header', $data);
        $this->load->view($view, $viewdata);
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');

    }

}
