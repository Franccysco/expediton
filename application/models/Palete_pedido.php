<?php
class Palete_pedido extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = 'palete_has_pedido';
    }

    //Deletar dados da tabela juntos
    public function removerPedido($data)
    {
        if (!isset($data)) {
            return false;
        }
        $this->db->where('palete_id',$data['palete_id']);
        $this->db->where('pedido_id', $data['pedido_id']);
        return $this->db->delete($this->table);
    }

}
