<?php
class Doca_model extends MY_Model
{

    public $column_order = array("cod_doca", "status", "qnt_vagas", "tipo");
    public $column_search = array("cod_doca",);
    public $order = array("cod_doca" => "asc");


    public function __construct()
    {
        parent::__construct();
        $this->table = 'doca';
    }

    public function qtdPaletes($id_doca)
    {

        $sql = "
            SELECT 
                COUNT(a.id) AS qtdPlt 
            FROM
                palete a
                    INNER JOIN
                palete_has_doca b ON a.id = b.palete_id
            WHERE
                b.doca_id = {$id_doca} 
        ";

        $query = $this->db->query($sql);
        $array = $query->row_array();
        return $qtdPaltes = $array['qtdPlt'];
    }

    //Atualiza status da doca; Procurar uma solução melhor pra isso na view
    public function updateStatus($id_doca, $status)
    {
        $doca = $this->GetById($id_doca);
        $doca['status'] = $status;
        $this->Atualizar($id_doca, $doca);
    }

    public function chekckStatus($id_doca)
    {
        $doca = $this->GetById($id_doca);
        if ($doca['status'] == 0) {
            return 0;
        } else {
            return 1;
        }
    }

    public function checkLimite($id_doca)
    {
        //Busca a qtd atual de paletes na doca
        $qtdAtual = $this->qtdPaletes($id_doca);
        //Buscar a qtd limite suportada na doca
        $doca = $this->GetById($id_doca);
        $qtdLimite = $doca['qnt_vagas'];

        if ($qtdAtual >= $qtdLimite) {
            $this->updateStatus($doca['id'], 0);
        } else {
            $this->updateStatus($doca['id'], 1);
        }
    }
}
