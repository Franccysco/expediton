<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Palete extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->verify_login();
        $this->verify_permission();

    }

    public function index()
    {

        // Recupera os paletes através do model
        // $paletes = $this->palete_model->GetAll('cod_palete');
        // Passa os paletes para o array que será enviado à home
        // $dados['paletes'] = $paletes; //$this->palete_model->Formatar($paletes);
        // Chama a home enviando um array de dados a serem exibidos
        $dados['titulo'] = 'Paletes';

        $this->render_page("paletes/paletes", $dados);

    }

    public function ajax_list_paletes()
    {
        
        $list = $this->palete_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->cod_palete;
            $row[] = $item->rota;
            if($item->status == 1){
                $row[] = '<span class="label label-success">Disponível</span>';
            }elseif($item->status == 0){
                $row[] = '<span class="label label-danger">Fechado</span>';
            }else{
                $row[] = '<span class="label label-warning">Em uso</span>';
            }
           
            $row[] = $item->ativo == 1 ? '<span class="label label-success">Ativo</span>' : '<span class="label label-danger">Inativo</span>';
            $row[] = '
            <a
             href="'.base_url('paletes/editar/'.$item->id).'" class="btn btn-primary btn-xs">
             <i class="fa fa-edit"></i> Editar
            </a>
            <a href="#" data-toggle="modal" data-target="#delete-modal" data-customer="'.$item->id.'" 
             data-rota="'.base_url('exluir-palete/').'" class="btn btn-danger btn-xs">
             <i class="fa fa-trash"></i> Excluir
            </a>';
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->palete_model->count_all(),
                        "recordsFiltered" => $this->palete_model->count_filtered(),
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
        // Recupera os paletes através do model
        // $paletes = $this->palete_model->GetAll('cod_palete');
        // Passa os paletes para o array que será enviado à home
        // $dados['paletes'] = $paletes; //$this->palete_model->Formatar($paletes);
        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $palete = $this->input->post();
            // Insere os dados no banco recuperando o status dessa operação
            $status = $this->palete_model->Inserir($palete);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', 'Não foi possível inserir o palete.');
            } else {
                $this->session->set_flashdata('success', 'Palete inserido com sucesso.');
                // Redireciona o usuário para a home
                redirect(base_url('paletes'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
        }
        // Carrega a home
        $dados['titulo'] = 'paletes';

         $this->render_page("paletes/paletes", $dados);

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home paletes
        if (is_null($id)) {
            redirect(base_url('paletes'));
        }

        // Recupera os dados do registro a ser editado
        $dados['palete_ed'] = $this->palete_model->GetById($id);
        // Passa os paletes para o array que será enviado à home
        // $dados['paletes'] = $this->palete_model->GetAll('cod_palete');
        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'paletes';

         $this->render_page("paletes/paletes", $dados);
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
            $palete = $this->input->post();

            //verfica se o status voltou pra uso e desativa o palete pra o proximo uso
            if ($palete['status'] == 1) {
                $palete['ativo'] = 0;
            }

            if ($palete['status'] == 0) {
                $palete['ativo'] = 1;
            }

            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->palete_model->Atualizar($palete['id'], $palete);

            //Verifica Limite do palete
            //$this->palete_model->checkLimite($palete['id']);

            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['palete'] = $this->palete_model->GetById($palete['id']);
                $this->session->set_flashdata('error', 'Não foi possível atualizar o palete.');

            } else {
                $this->session->set_flashdata('success', 'Palete atualizado com sucesso.');
                // Redireciona o usuário para a home paletes
                redirect(base_url('paletes'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());

        }

        // Passa os paletes para o array que será enviado à home
        // $dados['paletes'] = $this->palete_model->GetAll('cod_palete');
        // Carrega a view para edição
        $dados['titulo'] = 'Paletes';

         $this->render_page("paletes/paletes", $dados);
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
        $status = $this->palete_model->Excluir($id);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            $this->session->set_flashdata('success', '<p>Palete excluído com sucesso.</p>');
        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível excluir o palete.</p>');
        }
        // Redirecionao o usuário para a home
        redirect(base_url('paletes'));
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
                $rules['cod_palete'] = array('trim', 'required', 'min_length[3]', 'is_unique[palete.cod_palete]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['rota'] = array('trim', 'required', 'min_length[3]');

                break;

            case 'update':
                $rules['cod_palete'] = array('trim', 'required', 'min_length[3]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['rota'] = array('trim', 'required', 'min_length[3]');
                break;

            default:
                $rules['cod_palete'] = array('trim', 'required', 'min_length[3]', 'is_unique[palete.cod_palete]');
                $rules['status'] = array('trim', 'required');
                $rules['qnt_vagas'] = array('trim', 'required');
                $rules['rota'] = array('trim', 'required', 'min_length[3]');
                break;
        }
        $this->form_validation->set_rules('cod_palete', 'Código', $rules['cod_palete']);
        $this->form_validation->set_rules('status', 'Status', $rules['status']);
        $this->form_validation->set_rules('qnt_vagas', 'Limite de Pedidos', $rules['qnt_vagas']);
        $this->form_validation->set_rules('rota', 'Rota', $rules['rota']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }

     /**
     * Metodo para botão de ativar status do palete
     */
    public function mudaStatus()
    {
            $post = $this->input->post();
            $id_palete = $post['idPalete'];
            // Recupera o palete pelo o id passado
            $palete = $this->palete_model->GetById($id_palete);


            //verfica se o status em uso e ativa o palete pra o proximo uso
            if ($palete['status'] == 2) {
                $palete['ativo'] = 0;
                $palete['status'] = 1;
            }

            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->palete_model->Atualizar($palete['id'], $palete);


            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $response = array(
                    "status"=>"error",
                    "msg"=>"Não foi possível ativar o palete."
                );
                echo json_encode($response);
                // $this->session->set_flashdata('error', 'Não foi possível ativar o palete.');
            } else {

                $response = array(
                    "status"=>"success",
                    "msg"=>"Palete ativo com sucesso."
                );

                echo json_encode($response);

                //$this->session->set_flashdata('success', 'Palete ativo com sucesso.');
                // Redireciona o usuário para a home paletes
               //redirect(base_url("doca/$id_doca"));
            }
        
       

    }

    /**
     * Metodo para requisição feita para buscar paletes não inseridos/relacionado com alguma doca
     */
    public function paletesNaoRelacionados()
    {
        
        $paletes_not_relacionados = $this->palete_model->getPaletes(false);
        // $arrayName = array();
        echo json_encode($paletes_not_relacionados);
    }

    /*
     Metodo para requisição de paletes relacionados com alguma doca
     
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
    */

}
