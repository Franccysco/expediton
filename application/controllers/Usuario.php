<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->verify_login();
        $this->verify_permission();

    }

    public function index()
    {
        // Chama a home enviando um array de dados a serem exibidos
        $dados['titulo'] = 'Usuários';
        // Recupera os usuarios através do model
        $dados['users'] = $this->ion_auth->users()->result(); //$this->usuario_model->GetAll('nome');

        foreach ($dados['users'] as $key => $user) {

            $dados['users'][$key]->groups = $this->ion_auth->get_users_groups($user->id)->result();

        }

        $dados['grupos'] = $this->ion_auth->groups()->result();
        // Passa os usuarios para o array que será enviado à home
        //$dados['usuarios'] = $usuarios; //$this->usuario_model->Formatar($usuarios);

        $this->render_page("usuarios/users", $dados);

    }

    /**
     * Processa o formulário para salvar os dados
     */
    public function Salvar()
    {
        // Recupera os usuarios através do model
        // $usuarios = $this->usuario_model->GetAll('nome');
        // Passa os usuarios para o array que será enviado à home
        //$dados['usuarios'] = $usuarios; //$this->usuario_model->Formatar($usuarios);

        $dados['users'] = $this->ion_auth->users()->result(); //$this->usuario_model->GetAll('nome');

        foreach ($dados['users'] as $key => $user) {

            $dados['users'][$key]->groups = $this->ion_auth->get_users_groups($user->id)->result();

        }

        // Executa o processo de validação do formulário
        $validacao = self::Validar();
        // Verifica o status da validação do formulário
        // Se não houverem erros, então insere no banco e informa ao usuário
        // caso contrário informa ao usuários os erros de validação
        if ($validacao) {
            // Recupera os dados do formulário

            //$sobrenome = $this->input->post('sobrenome');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $grupo_id = $this->input->post('grupo_id');
            $email = $username . '@riopiranhas.com';

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            );

            // Insere os dados no banco recuperando o status dessa operação
            $status = $this->ion_auth->register($username, $password, $email, $additional_data, $grupo_id);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
            } else {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                // Redireciona o usuário para a home
                redirect(base_url('usuarios'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors('<p>', '</p>'));
            redirect(base_url('usuarios/cadastro'));

        }
        // Carrega a home
        $dados['titulo'] = 'Usuários';

        $this->render_page("usuarios/users", $dados);

    }

    /**
     * Carrega a view para edição dos dados
     */
    public function Editar()
    {
        // Recupera o ID do registro - através da URL - a ser editado
        $id = $this->uri->segment(3);
        // Se não foi passado um ID, então redireciona para a home usuarios
        if (is_null($id)) {
            redirect(base_url('usuarios'));
        }

        // Recupera os dados do registro a ser editado
        $dados['usuario_ed'] = $this->ion_auth->user((int) $id)->row();
        // Passa os usuarios para o array que será enviado à home
        //$dados['usuarios'] = $this->usuario_model->GetAll('nome');

        $dados['users'] = $this->ion_auth->users()->result(); //$this->usuario_model->GetAll('nome');

        foreach ($dados['users'] as $key => $user) {

            $dados['users'][$key]->groups = $this->ion_auth->get_users_groups($user->id)->result();

        }

        $dados['groups'] = $this->ion_auth->groups()->result_array();
        $dados['currentGroups'] = $this->ion_auth->get_users_groups($id)->result();

        // Carrega a view passando os dados do registro
        $dados['titulo'] = 'usuarios';

        $this->render_page("usuarios/users", $dados);
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
            // Atualiza os dados no banco recuperando o status dessa operação
            $usuario_id = $this->input->post('id');

            $new_data = array(
                'username' => $this->input->post('username'),
                'email' => $this->input->post('username') . '@riopiranhas.com',
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
            );
            if (strlen($this->input->post('password')) >= 6) {
                $new_data['password'] = $this->input->post('password');
            }

            //Update the groups user belongs to
            $groups = $this->input->post('groups');
            if (isset($groups) && !empty($groups)) {
                $this->ion_auth->remove_from_group('', $usuario_id);
                foreach ($groups as $group) {
                    $this->ion_auth->add_to_group($group, $usuario_id);
                }
            }

            $status = $this->ion_auth->update($usuario_id, $new_data);
            // Checa o status da operação gravando a mensagem na seção
            if (!$status) {
                $dados['usuario_ed'] = $this->ion_auth->user((int) $id)->row();
                $this->session->set_flashdata('error', $this->ion_auth->errors());

            } else {
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                // Redireciona o usuário para a home usuarios
                redirect(base_url('usuarios'));
            }
        } else {
            $this->session->set_flashdata('error', validation_errors());
            redirect(base_url('usuarios/editar/' . $this->input->post('id')));

        }

        // Passa os usuarios para o array que será enviado à home
        $dados['users'] = $this->ion_auth->users()->result();
        foreach ($dados['users'] as $key => $user) {

            $dados['users'][$key]->groups = $this->ion_auth->get_users_groups($user->id)->result();

        }

        // Carrega a view para edição
        $dados['titulo'] = 'Usuários';

        $this->render_page("usuarios/users", $dados);
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
                $rules['first_name'] = array('trim', 'required', 'min_length[3]');
                $rules['last_name'] = array('trim', 'required', 'min_length[3]');
                $rules['username'] = array('trim', 'required', 'min_length[3]', 'is_unique[users.username]');
                $rules['password'] = array('trim', 'required', 'min_length[6]');
                $rules['password_confirm'] = array('trim', 'required', 'matches[password]');
                break;

            case 'update':
                $rules['first_name'] = array('trim', 'required', 'min_length[3]');
                $rules['last_name'] = array('trim', 'required', 'min_length[3]');
                $rules['username'] = array('trim', 'required', 'min_length[3]');
                $rules['password'] = array('trim', 'min_length[6]');
                $rules['password_confirm'] = array('trim', 'matches[password]');

                break;

            default:
                $rules['first_name'] = array('trim', 'required', 'min_length[3]');
                $rules['last_name'] = array('trim', 'required', 'min_length[3]');
                $rules['username'] = array('trim', 'required', 'min_length[3]', 'is_unique[users.username]');
                $rules['password'] = array('trim', 'required', 'min_length[6]');
                $rules['password_confirm'] = array('trim', 'required', 'matches[password]');
                break;
        }
        $this->form_validation->set_rules('first_name', 'Nome', $rules['first_name']);
        $this->form_validation->set_rules('last_name', 'Sobrenome', $rules['last_name']);
        $this->form_validation->set_rules('username', 'Login', $rules['username']);
        $this->form_validation->set_rules('password', 'Senha', $rules['password']);
        $this->form_validation->set_rules('password_confirm', 'Confirmar Senha', $rules['password_confirm']);

        // Executa a validação e retorna o status
        return $this->form_validation->run();
    }

    /**
     * Realiza o processo de exclusão dos dados
     */
    public function delete($user_id = null)
    {

        if (is_null($user_id)) {
            $this->session->set_flashdata('error', 'Não foi possível excluir o usuário.');
        } else {
            $this->ion_auth->delete_user($user_id);
            $this->session->set_flashdata('success', $this->ion_auth->messages());
        }
        redirect(base_url('usuarios'));
    }

   

    public function ativarUsuario($id = null)
    {

        if ($id == null) {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect(base_url('usuarios'));
        } else {
            $this->ion_auth->activate($id);
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect(base_url('usuarios'));
        }

    }

    public function desativarUsuario($id = null)
    {

        if ($id == null) {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect(base_url('usuarios'));
        } else {
            $this->ion_auth->deactivate($id);
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect(base_url('usuarios'));
        }

    }

}
