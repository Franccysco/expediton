<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error404 extends CI_Controller
{

    public function index()
    {

        //Dados a serem enviados para o cabeçalho
        $dados['titulo'] = 'Erro';
       

        $this->load->view('template/header', $dados);
		$this->load->view('erro404');
		$this->load->view('template/menu-lateral');
		$this->load->view('template/footer');

    }

}
