<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pedido extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->verify_login();

    }

    public function index()
    {

        // Recupera os pedidos através do model
        // $pedidos = $this->pedido_model->getPedidosJoin();
        // Passa os pedidos para o array que será enviado à home
        // $dados['pedidos'] = $pedidos; //$this->pedido_model->Formatar($pedidos);
        // $dados['clientes'] = $this->cliente_model->GetAll('cod_cliente');
        // $dados['paletes'] = $this->palete_model->GetAll('cod_palete');
        // $dados['rotas'] = $this->rota_model->GetAll('cod_rota');

        // Chama a home enviando um array de dados a serem exibidos
        $dados['titulo'] = 'Pedidos';
        
        $this->render_page("pedidos/pedidos", $dados);

    }

    public function ajax_list_pedido()
    {
        
        $list = $this->pedido_model->get_datatables_pedidos();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->cod_pedido;
            $row[] = data($item->horario_entrada);
            $row[] = $item->status == 1 ? '<span class="label label-success">Recebido</span>': '<span class="label label-danger">Despachado</span>';
            $row[] = $item->cod_palete;
            $row[] = $item->rota;
            $row[] = $item->cod_doca;
            if ($this->ion_auth->is_admin()){
                $row[] = '
                <a
                href="'.base_url('pedidos/editar/'.$item->id).'" class="btn btn-primary btn-xs">
                <i class="fa fa-edit"></i> Editar
                </a>
                <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="'.$item->id.'" 
                data-rota="'.base_url('exluir-pedido/').'" class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i> Excluir
                </a>';
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pedido_model->count_all_pedidos(),
                        "recordsFiltered" => $this->pedido_model->count_filtered_pedidos(),
                        "data" => $data,
                );
        //output to json format
        // print_r($output); die;
        echo json_encode($output);
    }

    public function ajax_list_pedido_expedido()
    {
        
        $list = $this->pedido_model->get_datatables_pedidos_expedidos();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->cod_pedido;
            $row[] = data($item->horario_ocorrencia);
            $row[] = $item->tipo_ocorrencia == 1 ? '<span class="label label-success">Recebido</span>': '<span class="label label-danger">Expedido</span>';
            $row[] = $item->cod_palete;
            $row[] = $item->rota;
            if ($this->ion_auth->is_admin()){
                $row[] = '
                <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="'.$item->id.'" 
                data-rota="'.base_url('exluir-pedido/').'" class="btn btn-danger btn-xs">
                <i class="fa fa-trash"></i> Excluir
                </a>';
            }
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->pedido_model->count_all_pedidos_expedidos(),
                        "recordsFiltered" => $this->pedido_model->count_filtered_pedidos_expedidos(),
                        "data" => $data,
                );
        //output to json format
        // print_r($output); die;
        echo json_encode($output);
    }

    /**
     * Processa o formulário para salvar os dados
     */
    public function Salvar()
    {
        // Recupera os pedidos através do model
        //$pedidos = $this->pedido_model->getPedidosJoin();
        // Passa os pedidos para o array que será enviado à home
        //$dados['pedidos'] = $pedidos; //$this->pedido_model->Formatar($pedidos);
        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        $id_doca = $this->input->post('id_doca');
        $id_palete = $this->input->post('id_palete');

        if ($validacao) {
            // Recupera os dados do formulário

            $pedido = array(
                'cod_pedido' => $this->input->post('cod_pedido'),
                'status' => $this->input->post('status'),
            );

            // Insere os dados no banco recuperando o status dessa operação
            $id_pedido = $this->pedido_model->Inserir_id($pedido);

            $data = array(
                'pedido_id' => $id_pedido,
                'palete_id' => $id_palete,
            );

            //Pedidos relacionados com palete verficado
            $pedidos_rela = $this->pedido_model->getPedidosPaletes(true, $id_palete);

            $existe = 0;

            if (!$pedidos_rela == false) {

                foreach ($pedidos_rela as $ped) {
                    if ($ped['cod_pedido'] == $pedido['cod_pedido']) {
                        $this->session->set_flashdata('error', 'Pedido já inserido. Gere a etiqueta e coloque o mesmo código em outro palete.');
                        $existe = 1;
                        // Redireciona o usuário para a home
                        redirect(base_url('doca/' . $id_doca . '/' . 'palete/' . $id_palete . '/0'));

                    }

                }
            }

            if (!$existe == 1) {
                //Insere o pedido relacionado com o palete
                $this->palete_pedido->Inserir($data);
                //Dados para inserir a ocorrencia
                $ocorrencia = array("tipo_ocorrencia" => 1, "palete_id" => $id_palete,
                    "pedido_id" => $id_pedido);
                $this->ocorrencia_model->Inserir($ocorrencia);

                // Checa o status da operação gravando a mensagem na seção
                if (is_null($id_pedido)) {
                    $this->session->set_flashdata('error', 'Não foi possível inserir o pedido.');
                } else {
                    $this->session->set_flashdata('success', 'Pedido inserido com sucesso.');
                    //$this->palete_model->updateStatus($id_palete, 1);

                    // Redireciona o usuário para a home
                    redirect(base_url('doca/' . $id_doca . '/' . 'palete/' . $id_palete . '/0'));
                }

            }

        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            //$this->palete_model->updateStatus($id_palete, 1);
            redirect(base_url('doca/' . $id_doca . '/' . 'palete/' . $id_palete . '/0'));

        }

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home pedidos
        if (is_null($id)) {
            redirect(base_url('pedidos'));
        }

        // Recupera os dados do registro a ser editado
        $dados['pedido_ed'] = $this->pedido_model->GetById($id);
        // Passa os pedidos para o array que será enviado à home
        //$dados['pedidos'] = $this->pedido_model->getPedidosJoin();
        // $dados['pedidos_input'] = $this->pedido_model->getPedidosJoin($id);

        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'Pedidos';

        $this->render_page("pedidos/pedidos", $dados);
    }

    /**
     * Processa o formulário para atualizar os dados
     */
    public function Atualizar()
    {
        // Realiza o processo de validação dos dados
        $validacao = self::Validar('update');
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $pedido = $this->input->post();
            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->pedido_model->Atualizar($pedido['id'], $pedido);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['pedido'] = $this->pedido_model->GetById($pedido['id']);
                $this->session->set_flashdata('error', 'Não foi possível atualizar o pedido.');

            } else {
                $this->session->set_flashdata('success', 'Pedido atualizado com sucesso.');
                // Redireciona o usuário para a home pedidos
                redirect(base_url('pedidos'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());

        }

        // Passa os pedidos para o array que será enviado à home
        //$dados['pedidos'] = $this->pedido_model->GetAll('cod_pedido');

        // Carrega a view para edição
        $dados['titulo'] = 'Pedidos';

        $this->render_page("pedidos/pedidos", $dados);
    }

    /**
     * Realiza o processo de exclusão dos dados
     */
    public function Excluir()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(2);
        // Se não foi passado um ID, então redireciona para a home
        if (is_null($id)) {
            redirect();
        }

        $data['palete_id'] = $this->pedido_model->paletePedido($id);
        $data['pedido_id'] = $id;

        $this->palete_pedido->removerPedido($data);

        // Remove o registro do banco de dados recuperando o status dessa operação
        $status = $this->pedido_model->Excluir($id);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            $this->session->set_flashdata('success', '<p>Pedido excluído com sucesso.</p>');
        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível excluir o pedido.</p>');
        }
        // Redirecionao o usuário para a home
        redirect(base_url('pedidos'));
    }

    public function expedidos()
    {

        // Recupera os pedidos através do model
        // $pedidos = $this->pedido_model->pedidosExpedidos();
        // Passa os pedidos para o array que será enviado à home
        // $dados['pedidos'] = $pedidos;

        // Chama a home enviando um array de dados a serem exibidos
        $dados['titulo'] = 'Pedidos Expedidos';

        $this->render_page("pedidos/pedidos", $dados);

    }

    /**
     * Valida os dados do formulário
     *
     * @param string $operacao Operação realizada no formulário: insert ou update
     *
     * @return boolean
     */
    private function Validar($operacao = 'insert')
    {
        // Com base no parâmetro passado
        // determina as regras de validação
        switch ($operacao) {
            case 'insert':
                $rules['cod_pedido'] = array('trim', 'required', 'min_length[3]');
                // $rules['rota_id'] = array('trim', 'required');
                // $rules['palete_id'] = array('trim', 'required');
                // $rules['cliente_id'] = array('trim', 'required');
                break;

            case 'update':
                $rules['cod_pedido'] = array('trim', 'required', 'min_length[3]');
                //$rules['rota_id'] = array('trim', 'required');
                // $rules['palete_id'] = array('trim', 'required');
                //$rules['cliente_id'] = array('trim', 'required');
                break;

            default:
                $rules['cod_pedido'] = array('trim', 'required', 'min_length[3]');
                //$rules['rota_id'] = array('trim', 'required');
                // $rules['palete_id'] = array('trim', 'required');
                //$rules['cliente_id'] = array('trim', 'required');
                break;
        }
        $this->form_validation->set_rules('cod_pedido', 'Código', $rules['cod_pedido']);
        //$this->form_validation->set_rules('rota_id', 'Rota', $rules['rota_id']);
        // $this->form_validation->set_rules('palete_id', 'Palete', $rules['palete_id']);
        //$this->form_validation->set_rules('cliente_id', 'Cliente', $rules['cliente_id']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }

}
