<?php
class Palete_model extends MY_Model
{
   
    public $column_order = array("cod_palete", "status", "qnt_vagas", "rota", "ativo");
    public $column_search = array("cod_palete",);
    public $order = array("cod_palete" => "asc");
   
    public function __construct()
    {
        parent::__construct();
        $this->table = 'palete';
    }

    /**
     * Verifica os paletes relacionados com a doca onde estão inseridos e os não relacionados
     *
     * @param boolean $related Dados relacionados são true
     *
     * @return array relacionados ou não com as docas
     */

    public function getPaletes($related = true, $id = false)
    {

        if ($related) {

            $sql = "SELECT * FROM palete WHERE id IN(
					SELECT a.id
					FROM palete a
					INNER JOIN palete_has_doca b ON a.id = b.palete_id
                    WHERE b.doca_id = $id)
					 ORDER BY CONVERT(SUBSTRING(palete.cod_palete, POSITION('-' IN palete.cod_palete) + 1), SIGNED);";
				
			
            $query = $this->db->query($sql);
            return $query->result_array();

        } else {	

            $sql = "SELECT * FROM palete WHERE id NOT IN(
					SELECT a.id
					FROM palete a
					INNER JOIN palete_has_doca b ON a.id = b.palete_id
                    );";

            $query = $this->db->query($sql);
            return $query->result_array();

        }

    }

    public function qtdPedidos($id_palete)
    {

        $sql = "
            SELECT 
                COUNT(a.id) AS qtdPed
            FROM 
                pedido a
                    INNER JOIN 
                palete_has_pedido b ON a.id = b.pedido_id
            WHERE b.palete_id = {$id_palete}
        ";

        $query = $this->db->query($sql);
        $array = $query->row_array();
        return $qtdPedidos = $array['qtdPed'];

    }

    //Atualiza status da doca; Procurar uma solução melhor pra isso na view
    public function updateStatus($id_palete, $status)
    {
        $palete = $this->GetById($id_palete);
        $palete['status'] = $status;
        $this->Atualizar($id_palete, $palete);

    }

     public function updateAtivo($id_palete, $status)
    {
        $palete = $this->GetById($id_palete);
        $palete['ativo'] = $status;
        $this->Atualizar($id_palete, $palete);

    }

    public function chekckStatus($id_palete)
    {
        $palete = $this->GetById($id_palete);
        if ($palete['status'] == 0) {
            return 0;
        } elseif($palete['status'] == 1) {
            return 1;
        } else{
            return 2;
        }
    }

    public function checkLimite($id_palete)
    {
        //Busca a qtd atual de paletes na doca
        $qtdAtual = $this->qtdPedidos($id_palete);
        //Buscar a qtd limite suportada na doca
        $palete = $this->GetById($id_palete);
        $qtdLimite = $palete['qnt_vagas'];

        if ($qtdAtual >= $qtdLimite) {
            $this->updateStatus($palete['id'], 0);

        } else {
            $this->updateStatus($palete['id'], 1);

        }

    }

    //Verificar se a rota veio nula
    public function rotas()
    {
        $this->db->select('palete.rota as rota');
        $this->db->from('palete_has_doca');
        $this->db->join('palete', 'palete_has_doca.palete_id = palete.id');


        $this->db->order_by('palete.rota', 'ASC');
        $this->db->distinct();
        return $this->db->get()->result_array();

    }

    public function pesquisaRota($busca)
    {
        if ($busca == "") {
            return false;
        }
        $this->db->select('palete.id, palete.cod_palete, palete.rota, palete.status, palete.qnt_vagas, doca.cod_doca');
        $this->db->from('palete_has_doca');
        $this->db->join('palete', 'palete_has_doca.palete_id = palete.id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');

        $this->db->where('rota', $busca);
        $this->db->order_by('cod_palete', 'ASC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }

    }

    //Retornar a doca que o palte se encontra
    public function docaPalete($id_palete = null)
    {
        if ($id_palete == null) {
            return false;
        }
        $this->db->select('doca.id as doca_id');
        $this->db->from('palete_has_doca');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');
        $this->db->join('palete', 'palete_has_doca.palete_id = palete.id');

        $this->db->where('palete.id', $id_palete);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $array = $query->row_array();
            return $id_doca = $array['doca_id'];

        } else {
            return null;
        }

    }

}
