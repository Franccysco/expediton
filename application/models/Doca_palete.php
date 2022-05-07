<?php
class Doca_palete extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'palete_has_doca';
    }

    //Deletar dados da tabela juntos
    public function removerPalete($data)
    {
        if (!isset($data)) {
            return false;
        }
        $this->db->where('palete_id',$data['palete_id']);
        $this->db->where('doca_id', $data['doca_id']);
        return $this->db->delete($this->table);
    }

}
