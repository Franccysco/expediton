<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Doca extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->verify_login();
        $this->verify_permission();

    }

    public function index()
    {

        // Recupera os docas através do model
        // $docas = $this->doca_model->GetAll('cod_doca');
        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $docas; //$this->doca_model->Formatar($docas);
        // Chama a home enviando um array de dados a serem exibidos

        $dados['titulo'] = 'Docas';

        $this->render_page("docas/docas", $dados);

    }

    public function ajax_list_docas()
    {
        
        $list = $this->doca_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $doca) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $doca->cod_doca;
            $row[] = $doca->status == 1 ? '<span class="label label-success">Disponível</span>': '<span class="label label-danger">Ocupado</span>';
            $row[] = $doca->qnt_vagas;
            $row[] = $doca->tipo == 1 ? '<span class="label label-success">Padrão</span>' : '<span class="label label-warning">Mista</span>';
            $row[] = '
            <a
             href="'.base_url('docas/editar/'.$doca->id).'" class="btn btn-primary btn-xs">
             <i class="fa fa-edit"></i> Editar
            </a>
            <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="'.$doca->id.'" 
             data-rota="'.base_url('exluir-doca/').'" class="btn btn-danger btn-xs">
             <i class="fa fa-trash"></i> Excluir
            </a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->doca_model->count_all(),
                        "recordsFiltered" => $this->doca_model->count_filtered(),
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
        // Recupera os docas através do model
        // $docas = $this->doca_model->GetAll('cod_doca');
        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $docas; //$this->doca_model->Formatar($docas);
        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $doca = $this->input->post();
            // Insere os dados no banco recuperando o status dessa operação
            $status = $this->doca_model->Inserir($doca);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', 'Não foi possível inserir a doca.');
            } else {
                $this->session->set_flashdata('success', 'Doca inserida com sucesso.');
                // Redireciona o usuário para a home
                redirect(base_url('docas'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
        }

        $dados['titulo'] = 'Docas';
        $this->render_page("docas/docas", $dados);

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home docas
        if (is_null($id)) {
            redirect(base_url('docas'));
        }

        // Recupera os dados do registro a ser editado
        $dados['doca_ed'] = $this->doca_model->GetById($id);
        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $this->doca_model->GetAll('cod_doca');
        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'Docas';

        $this->render_page("docas/docas", $dados);
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
            $doca = $this->input->post();
            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->doca_model->Atualizar($doca['id'], $doca);
            //Checa limite da doca
            $this->doca_model->checkLimite($doca['id']);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['doca'] = $this->doca_model->GetById($doca['id']);
                $this->session->set_flashdata('error', 'Não foi possível atualizar a doca.');

            } else {
                $this->session->set_flashdata('success', 'Doca atualizada com sucesso.');
                // Redireciona o usuário para a home docas
                redirect(base_url('docas'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());

        }

        // Passa os docas para o array que será enviado à home
        // $dados['docas'] = $this->doca_model->GetAll('cod_doca');
        // Carrega a view para edição
        $dados['titulo'] = 'Docas';
        $this->render_page("docas/docas", $dados);
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

        // Remove o registro do banco de dados recuperando o status dessa operação
        $status = $this->doca_model->Excluir($id);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            $this->session->set_flashdata('success', '<p>Doca excluída com sucesso.</p>');
        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível excluir a doca.</p>');
        }
        // Redirecionao o usuário para a home
        redirect(base_url('docas'));
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
                $rules['cod_doca'] = array('trim', 'required', 'min_length[3]', 'is_unique[doca.cod_doca]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['tipo'] = array('trim', 'required');
                break;

            case 'update':
                $rules['cod_doca'] = array('trim', 'required', 'min_length[3]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['tipo'] = array('trim', 'required');
                break;

            default:
                $rules['cod_doca'] = array('trim', 'required', 'min_length[3]', 'is_unique[doca.cod_doca]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['tipo'] = array('trim', 'required');
                break;
        }
        $this->form_validation->set_rules('cod_doca', 'Código', $rules['cod_doca']);
        $this->form_validation->set_rules('status', 'Status', $rules['status']);
        $this->form_validation->set_rules('qnt_vagas', 'Limite de Paletes', $rules['qnt_vagas']);
        $this->form_validation->set_rules('tipo', 'Tipo de Doca', $rules['tipo']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }

    /**Metodo vincular um palete com uma doca, adicionar na doca */
    public function addPaleteDoca()
    {
        $post = $this->input->post();
        $data['palete_id'] = $post['idPalete'];
        $data['doca_id'] = $post['idDoca'];

        $status = $this->doca_palete->Inserir($data);

        if (!$status) {
            $response = array(
                "status"=>"error",
                "msg"=>"Não foi possível inserir o palete na doca ou esta cheia."
            );
            echo json_encode($response);
        } else {

            //Verificar o se a doca esta com limite máximo e atualiza seu status
            $this->doca_model->checkLimite($post['idDoca']);

            // $this->session->set_flashdata('success', 'Palete inserido com sucesso.');
            $response = array(
                "status"=>"success",
                "msg"=>"Palete inserido com sucesso."
            );

            echo json_encode($response);

        }

    }


    public function removePaleteDoca()
    {
        $post = $this->input->post();
        $id_palete = $post['idPalete'];
        $id_doca = $post['idDoca'];
        $data['palete_id'] = $id_palete;
        $data['doca_id'] =  $id_doca;


        // Remove o registro do banco de dados recuperando o status dessa operação
        $status = $this->doca_palete->removerPalete($data);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {

            //Tenho que remover os pedidos do palete retirado da doca
            //A lista um array com os id's dos pedidos que estão no palete, coloco no loop e removo
            //de um por um
            $pedidos_no_palete = $this->pedido_model->checkPedidosPalete($id_palete);
            if (!empty($pedidos_no_palete)) {
                for ($i = 0; $i < count($pedidos_no_palete); $i++) {
                    $data = array('palete_id' => $id_palete,
                        'pedido_id' => $pedidos_no_palete[$i]['id']);
                    $this->palete_pedido->removerPedido($data);
                }

                $this->palete_model->updateStatus($id_palete, 1);
                $this->palete_model->updateAtivo($id_palete, 0);

            } else {
                $this->palete_model->updateStatus($id_palete, 1);
                $this->palete_model->updateAtivo($id_palete, 0);

            }

            //Verificar o se a doca esta com limite máximo e atualizar seu status
            $this->doca_model->checkLimite($id_doca);
            
            $response = array(
                "status"=>"success",
                "msg"=>"Palete removido da Doca. Encontra-se disponível ainda pra inserção!."
            );

            echo json_encode($response);
            // $this->session->set_flashdata('success', '<p>Palete removido da Doca. Encontra-se disponível ainda pra inserção! </p>');
        } else {

            $response = array(
                "status"=>"error",
                "msg"=>"Não foi possível excluir o palete da doca."
            );
            echo json_encode($response);
            // $this->session->set_flashdata('error', '<p>Não foi possível excluir o palete da doca.</p>');
        }
        

    }

}
