<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rota extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url('login'));
        } elseif (!$this->ion_auth->is_admin()) {
            redirect(base_url('acesso-restrito'));
        }

    }

    public function index()
    {

        // Recupera as rotas através do model
        $rotas = $this->rota_model->GetAll('cod_rota');
        // Passa as rotas para o array que será enviado à home
        $dados['rotas'] = $rotas; //$this->rota_model->Formatar($rotas);
        // Chama a home enviando um array de dados a serem exibidos
        $dados['titulo'] = 'Rotas';

        $this->load->view('template/header', $dados);
        $this->load->view('rotas');
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');

    }

    /**
     * Processa o formulário para salvar os dados
     */
    public function Salvar()
    {
        // Recupera as rotas através do model
        $rotas = $this->rota_model->GetAll('cod_rota');
        // Passa as rotas para o array que será enviado à home
        $dados['rotas'] = $rotas; //$this->rota_model->Formatar($rotas);
        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário
            $rota = $this->input->post();
            // Insere os dados no banco recuperando o status dessa operação
            $status = $this->rota_model->Inserir($rota);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', 'Não foi possível inserir a rota.');
            } else {
                $this->session->set_flashdata('success', 'rota inserida com sucesso.');
                // Redireciona o usuário para a home
                redirect(base_url('rotas'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
        }
        // Carrega a home
        $dados['titulo'] = 'rotas';

        $this->load->view('template/header', $dados);
        $this->load->view('rotas');
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home rotas
        if (is_null($id)) {
            redirect(base_url('rotas'));
        }

        // Recupera os dados do registro a ser editado
        $dados['rota_ed'] = $this->rota_model->GetById($id);
        // Passa as rotas para o array que será enviado à home
        $dados['rotas'] = $this->rota_model->GetAll('cod_rota');
        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'rotas';

        $this->load->view('template/header', $dados);
        $this->load->view('rotas');
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');
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
            $rota = $this->input->post();
            // Atualiza os dados no banco recuperando o status dessa operação
            $status = $this->rota_model->Atualizar($rota['id'], $rota);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['rota'] = $this->rota_model->GetById($rota['id']);
                $this->session->set_flashdata('error', 'Não foi possível atualizar a rota.');

            } else {
                $this->session->set_flashdata('success', 'Rota atualizada com sucesso.');
                // Redireciona o usuário para a home rotas
                redirect(base_url('rotas'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());

        }

        // Passa as rotas para o array que será enviado à home
        $dados['rotas'] = $this->rota_model->GetAll('cod_rota');
        // Carrega a view para edição
        $dados['titulo'] = 'Rotas';

        $this->load->view('template/header', $dados);
        $this->load->view('rotas');
        $this->load->view('template/menu-lateral');
        $this->load->view('template/footer');
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
        $status = $this->rota_model->Excluir($id);
        // Checa o status da operação gravando a mensagem na seção
        if ($status) {
            $this->session->set_flashdata('success', '<p>Rota excluída com sucesso.</p>');
        } else {
            $this->session->set_flashdata('error', '<p>Não foi possível excluir o contato.</p>');
        }
        // Redirecionao o usuário para a home
        redirect(base_url('rotas'));
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
                $rules['cod_rota'] = array('trim', 'required', 'min_length[3]');
                $rules['origem'] = array('trim', 'required');
                $rules['destino'] = array('trim', 'required', 'min_length[3]');

                break;

            case 'update':
                $rules['cod_rota'] = array('trim', 'required', 'min_length[3]');
                $rules['origem'] = array('trim', 'required');
                $rules['destino'] = array('trim', 'required', 'min_length[3]');

                break;

            default:
                $rules['cod_rota'] = array('trim', 'required', 'min_length[3]');
                $rules['origem'] = array('trim', 'required');
                $rules['destino'] = array('trim', 'required', 'min_length[3]');

                break;
        }
        $this->form_validation->set_rules('cod_rota', 'Código', $rules['cod_rota']);
        $this->form_validation->set_rules('origem', 'Origem', $rules['origem']);
        $this->form_validation->set_rules('destino', 'Destino', $rules['destino']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }

}
