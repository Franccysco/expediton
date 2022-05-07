<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->verify_login();

    }

    public function index()
    {

        // Passa os docas para o array que será enviado à home
        $dados['docas'] = $this->doca_model->GetAll('cod_doca');

        $dados['rotas'] = $this->palete_model->rotas();

        $dados['titulo'] = 'Home';

        $this->render_page("home", $dados);

    }

    public function doca($id)
    {
        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $this->doca_model->GetAll('id');

        $dados['doca_selecionada'] = $this->doca_model->GetById($id);
        // $dados['paletes'] = $this->palete_model->GetAll('id');

        $paletes_nadoca = $this->palete_model->getPaletes(true, $id);
       
        //Adicionar qtd atual de pedidos no palete
        for ($i=0; $i < count($paletes_nadoca) ; $i++) { 
            $paletes_nadoca[$i]['qtdPedidos_atual'] = $this->palete_model->qtdPedidos($paletes_nadoca[$i]['id']);
        }
        
            
        // print_r($paletes_nadoca);die; 
        $dados['paletes_relacionados'] = $paletes_nadoca;
        // $dados['paletes_not_relacionados'] = $this->palete_model->getPaletes(false, $id);

        $dados['stat_doca'] = $this->doca_model->chekckStatus($id);

        $dados['titulo'] = 'Doca-Paletes';
        
        $this->render_page("ver-paletes", $dados);
    }



    //Pagina addPedido no palete mudar parte separada
    public function palete($doca_id, $id_palete, $uso)
    {

        // $rota = $this->uri->segment(3);

        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $this->doca_model->GetAll('cod_doca');

        //$dados['doca-selecionada'] = $this->doca_model->GetById($id);
        // $dados['paletes'] = $this->palete_model->GetAll('cod_palete');

        // $dados['pedidos'] = $this->pedido_model->GetAll('cod_pedido');

        //Lista de Pedidos relacionados com os paletes e não
        $dados['pedidos_relacionados'] = $this->pedido_model->getPedidosPaletes(true, $id_palete);
        // $dados['pedidos_not_relacionados'] = $this->pedido_model->getPedidosPaletes(false, $id_palete);
        $dados['ids'] = $this->pedido_model->checkPedidosPalete($id_palete);

        $dados['stat_doca'] = $this->doca_model->chekckStatus($doca_id);

        //Listas dos Paletes na doca
        // $dados['paletes_relacionados'] = $this->palete_model->getPaletes(true, $doca_id);
        // $dados['paletes_not_relacionados'] = $this->palete_model->getPaletes(false, $doca_id);

        $dados['doca_selecionada'] = $this->doca_model->GetById($doca_id);
        $palete_selecionado = $this->palete_model->GetById($id_palete);
        $dados['palete_selecionado'] = $palete_selecionado;

        if (!$uso == 1 && $palete_selecionado['ativo'] == 1) {
            $dados['stat_palete'] = 1;
        } else {
            $dados['stat_palete'] = $this->palete_model->chekckStatus($id_palete);
        }

        //Verifica os pedidodos relacionados
        // $ped_relacionado = $this->pedido_model->getPedidosPaletes(true, $id_palete);
        //Mudar status do palete selecionado para em uso

        // if ((!$palete_selecionado['status'] == 0 && $this->uri->segment(4) == $palete_selecionado['id']) && ($ped_relacionado == true)) {
        //     $this->palete_model->updateStatus($id_palete, 2);
        // }

        if ((!$palete_selecionado['status'] == 0 || !$palete_selecionado['status'] == 2) && $palete_selecionado['ativo'] == 0) {
            $this->palete_model->updateStatus($id_palete, 2);
            $this->palete_model->updateAtivo($id_palete, 1);
            redirect(base_url("doca/$doca_id/palete/$id_palete/0"));

        }

        //    if ((!$palete_selecionado['status'] == 0 || $palete_selecionado['status'] == 2) &&  $palete_selecionado['ativo'] == 1) {
        //        $this->palete_model->updateStatus($id_palete, 1);
        //     }

        $dados['titulo'] = 'Pedidos';

        $this->render_page("pedidos/adicionar-pedidos-paletes", $dados);

    }

    public function addPedido($id_doca, $id_palete, $id_pedido)
    {
        $data['palete_id'] = $id_palete;
        $data['pedido_id'] = $id_pedido;

        $status = $this->palete_pedido->Inserir($data);
        //Dados para inserir a ocorrencia
        $ocorrencia = array("tipo_ocorrencia" => 1, "palete_id" => $id_palete,
            "pedido_id" => $id_pedido);
        $this->ocorrencia_model->Inserir($ocorrencia);

        if (!$status) {
            $this->session->set_flashdata('error', 'Não foi possível inserir o pedido no palete.');
        } else {
            $this->session->set_flashdata('success', 'Pedido inserido com sucesso.');
            // Redireciona o usuário para a home
            redirect(base_url("doca/$id_doca/palete/$id_palete"));
        }

    }

    public function removePedido($id_doca, $id_palete, $id_pedido, $rota)
    {

        $data['palete_id'] = $id_palete;
        $data['pedido_id'] = $id_pedido;

        // Remove o registro do banco de dados recuperando o status dessa operação
        $status = $this->palete_pedido->removerPedido($data);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            //Mudar status do pedido ao remove-lo do palete e adicionar uma ocorrencia da ação
            // $this->pedido_model->Excluir($id_pedido);
            $pedido_ed = $this->pedido_model->GetById($id_pedido);
            $pedido_ed['status'] = 0;
            $this->pedido_model->Atualizar($id_pedido, $pedido_ed);
            //Dados para inserir a ocorrencia
            $ocorrencia = array("tipo_ocorrencia" => 0, "palete_id" => $id_palete,
                "pedido_id" => $id_pedido);
            $this->ocorrencia_model->Inserir($ocorrencia);

            $this->session->set_flashdata('success', '<p>Pedido despachado do palete com sucesso.</p>');

            $pedidos_no_palete = $this->pedido_model->getPedidosPaletes(true, $id_palete);

            if ($pedidos_no_palete == false) {
                //VERIFICA LIMITE E ATUALIZA OS STATUS DO PALETE
                $this->palete_model->updateStatus($id_palete, 1);
                $this->palete_model->updateAtivo($id_palete, 0);
                if ($rota != 1) {
                    redirect(base_url("ver-pedidos/palete/$id_palete/$rota"));
                } else {
                    redirect(base_url("doca/$id_doca"));
                }

            }

        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível despachar o pedido do palete.</p>');
        }
        if ($rota != 1) {
            redirect(base_url("ver-pedidos/palete/$id_palete/$rota"));
        } else{
        // Redirecionao o usuário para a home
        redirect(base_url("doca/$id_doca/palete/$id_palete/0"));
        }

    }

    public function pesquisar()
    {
        $dados = array();
        $dados['titulo'] = 'Pesquisa';
        $termo = $this->input->get('termo');
        //$id_pedido = $this->pedido_model->pesquisaPedido($termo);

        // $dados['pedido'] = $this->pedido_model->GetById($id_pedido);

        $data['result'] = $this->pedido_model->pesquisaPedido($termo);
       // $docas = array_unique($data['result']['docas'], SORT_REGULAR);

       
         $dados['pedido'] = $data['result']['pedido'];
         $dados['paletes'] = $data['result']['paletes'];

         $dados['docas'] = $data['result']['docas'];


        $dados['data'] = $data['result']['paletes'];

        
        $this->render_page("pesquisa", $dados);


    }

    public function pesquisarRota()
    {
        $dados = array();
        $dados['titulo'] = 'Busca Por rota';
        $busca = $this->input->post('busca');

        $data = $this->palete_model->pesquisaRota($busca);

        $dados['paletes_busca'] = $data;
        $dados['rota'] = $data[0]['rota'];
        //$dados['doca'] = $this->palete_model->docaPalete($data[0]['id']);
        $dados['rotas_all'] = $this->palete_model->rotas();

      
        $this->render_page("buscas_rota", $dados);

    }

    public function verPedidos($id_palete, $rota)
    {

        $dados['titulo'] = 'Busca Por rota';

        $data = $this->palete_model->pesquisaRota($rota);

        $dados['paletes_busca'] = $data;
        $dados['rota'] = $data[0]['rota'];
        $dados['palete_selecionado'] = $this->palete_model->GetById($id_palete);
        $dados['pedidos_relacionados'] = $this->pedido_model->getPedidosPaletes(true, $id_palete);
        $dados['stat_palete'] = $this->palete_model->chekckStatus($id_palete);

        // $dados['doca'] = $this->palete_model->docaPalete($id_palete);
        $dados['rotas_all'] = $this->palete_model->rotas();

        
        $this->render_page("buscas_rota", $dados);

    }

    public function limparPedidos($id_palete, $rota)
    {

        //Pedidos do palete
        $pedidos_palete = $this->pedido_model->getPedidosPaletes(true, $id_palete);

        foreach ($pedidos_palete as $pedido) {

            //Pegar os id para a operação
            $data['palete_id'] = $id_palete;
            $data['pedido_id'] = $pedido['id'];

            // Remove o registro do banco de dados recuperando o status dessa operação
            $status = $this->palete_pedido->removerPedido($data);

            //Mudar status do pedido ao remove-lo do palete e adicionar uma ocorrencia da ação
            $pedido_ed = $this->pedido_model->GetById($pedido['id']);
            $pedido_ed['status'] = 0;
            $this->pedido_model->Atualizar($pedido['id'], $pedido_ed);
            //Dados para inserir a ocorrencia
            $ocorrencia = array("tipo_ocorrencia" => 0, "palete_id" => $id_palete,
                "pedido_id" => $pedido['id']);
            $this->ocorrencia_model->Inserir($ocorrencia);

        }

        // Checa o status da operação gravando a mensagem na seção
        if ($status) {

            $this->session->set_flashdata('success', '<p>Palete limpo com sucesso.</p>');
            //VERIFICA LIMITE E ATUALIZA OS STATUS DO PALETE
            $this->palete_model->updateStatus($id_palete, 1);
            $this->palete_model->updateAtivo($id_palete, 0);

        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível limpar os pedidos do palete.</p>');
        }
         if (strlen($rota) > 2) {
             // Redirecionao o usuário para a pagina
            redirect(base_url("ver-pedidos/palete/$id_palete/$rota"));
         } else{
            redirect(base_url("doca/$rota"));

         }
        

    }

    //Fica atualizando os status do palete ao adicinar pedido e gerar a etiqueta
    public function updatePalete($id_palete, $id_doca)
    {
        $this->palete_model->updateStatus($id_palete, 0);
        // Redireciona o usuário para a home
        redirect(base_url("doca/$id_doca"));
    }

    //Limmpar pedidos por doca
    public function limparPedidosDoca($id_doca)
    {

        //Paletes na doca
        $paletes_nadoca = $this->palete_model->getPaletes(true, $id_doca);

        foreach ($paletes_nadoca as $palete) {
            //Pedidos do palete
            $pedidos_palete = $this->pedido_model->getPedidosPaletes(true, $palete['id']);

            foreach ($pedidos_palete as $pedido) {

                //Pegar os id para a operação
                $data['palete_id'] = $palete['id'];
                $data['pedido_id'] = $pedido['id'];

                // Remove o registro do banco de dados recuperando o status dessa operação
                $status = $this->palete_pedido->removerPedido($data);

                //Mudar status do pedido ao remove-lo do palete e adicionar uma ocorrencia da ação
                $pedido_ed = $this->pedido_model->GetById($pedido['id']);
                $pedido_ed['status'] = 0;
                $this->pedido_model->Atualizar($pedido['id'], $pedido_ed);
                //Dados para inserir a ocorrencia
                $ocorrencia = array("tipo_ocorrencia" => 0, "palete_id" => $palete['id'],
                    "pedido_id" => $pedido['id']);
                $this->ocorrencia_model->Inserir($ocorrencia);

            }

            $this->palete_model->updateStatus($palete['id'], 1);
            $this->palete_model->updateAtivo($palete['id'], 0);

        }
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {

            $this->session->set_flashdata('success', '<p>Doca limpa com sucesso.</p>');
            //VERIFICA LIMITE E ATUALIZA OS STATUS DO PALETE
            //$this->palete_model->updateStatus($id_palete, 1);

        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível limpar os pedidos da doca, ou doca já esta limpa.</p>');
        }
        // Redirecionao o usuário para a pagina
        redirect(base_url("doca/$id_doca"));

    }

    /**
     * Metodo para requisição de paletes relacionados com alguma doca
     */
    public function paletesRelacionados()
    {
        $idDoca = $this->input->post("idDoca");
        $paletes_nadoca = $this->palete_model->getPaletes(true, $idDoca);

       //Adicionar qtd atual de pedidos no palete
       for ($i=0; $i < count($paletes_nadoca) ; $i++) { 
        $paletes_nadoca[$i]['qtdPedidos_atual'] = $this->palete_model->qtdPedidos($paletes_nadoca[$i]['id']);
       }
        // $arrayName = array();
        echo json_encode($paletes_nadoca);
    }

}
