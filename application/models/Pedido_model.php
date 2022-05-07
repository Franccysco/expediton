<?php
class Pedido_model extends MY_Model
{

    public $column_order = array("pedido.horario_entrada","pedido.cod_pedido", "pedido.status",  "palete.cod_palete", "palete.rota", "doca.cod_doca");
    public $column_search = array("pedido.cod_pedido",);
    public $order = array("pedido.cod_pedido" => "desc");


    public $column_order_expedidos = array("ocorrencia.horario_ocorrencia", "pedido.cod_pedido", "ocorrencia.tipo_ocorrencia","palete.cod_palete", "palete.rota");
    public $column_search_expedidos = array("ocorrencia.horario_ocorrencia",);
    public $order_expedidos = array("ocorrencia.horario_ocorrencia" => "desc");


    public function __construct()
    {
        parent::__construct();
        $this->table = 'pedido';
    }

    /**
     * Insere um registro na tabela
     *
     * @param array $data Dados a serem inseridos
     *
     * @return boolean
     */
    public function Inserir_id($data)
    {
        if (!isset($data)) {
            return false;
        }

        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    public function getPedidosJoin($id = null)
    {

        $this->db->select('pedido.id, pedido.cod_pedido, pedido.status, pedido.horario_entrada, palete.cod_palete, palete.rota, doca.cod_doca');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        // $this->db->join('ocorrencia', 'palete_has_pedido.pedido_id = ocorrencia.pedido_id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');

        if (is_null($id)) {
            $this->db->order_by('pedido.id', 'ASC');
            return $this->db->get()->result_array();
        } else {
            $this->db->where('pedido.id', $id);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->row_array();
            } else {
                return null;
            }

        }

    }

    private function _get_datatables_pedido_query()
    {
        $this->db->select('pedido.id, pedido.cod_pedido, pedido.status, pedido.horario_entrada, palete.cod_palete, palete.rota, doca.cod_doca');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');
  
        $i = 0;
  
        foreach ($this->column_search as $item) { //Loop column
            if ($_POST['search']['value']) { //if datatable send Post for search
  
                if ($i == 0) { //first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
  
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
  
            }
  
            $i++;
        }
  
  
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    private function _get_datatables_pedido_expedidos_query()
    {
        $this->db->select('pedido.id, pedido.cod_pedido, ocorrencia.tipo_ocorrencia, ocorrencia.horario_ocorrencia,palete.cod_palete, palete.rota');
        $this->db->from('ocorrencia');
        $this->db->join('pedido', 'ocorrencia.pedido_id = pedido.id');
        $this->db->join('palete', 'ocorrencia.palete_id = palete.id');
        $this->db->where('ocorrencia.tipo_ocorrencia', 0);
  
        $i = 0;
  
        foreach ($this->column_search_expedidos as $item) { //Loop column
            if ($_POST['search']['value']) { //if datatable send Post for search
  
                if ($i == 0) { //first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
  
                if (count($this->column_search_expedidos) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
  
            }
  
            $i++;
        }
  
  
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_expedidos[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_expedidos)) {
            $order = $this->order_expedidos;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
  
    public function get_datatables_pedidos()
    {
        $this->_get_datatables_pedido_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // print $this->db->last_query(); die;
        return $query->result();
    }

    public function  get_datatables_pedidos_expedidos()
    {
        $this->_get_datatables_pedido_expedidos_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // print $this->db->last_query(); die;
        return $query->result();
    }

   
  
    public function count_filtered_pedidos()
    {
        $this->_get_datatables_pedido_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_filtered_pedidos_expedidos()
    {
        $this->_get_datatables_pedido_expedidos_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
  
  
    public function count_all_pedidos()
    {
        $this->db->select('pedido.id, pedido.cod_pedido, pedido.status, pedido.horario_entrada, palete.cod_palete, palete.rota, doca.cod_doca');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');
        return $this->db->count_all_results();
    }

    public function count_all_pedidos_expedidos()
    {
        $this->db->select('pedido.id, pedido.cod_pedido, ocorrencia.tipo_ocorrencia, ocorrencia.horario_ocorrencia,palete.cod_palete, palete.rota');
        $this->db->from('ocorrencia');
        $this->db->join('pedido', 'ocorrencia.pedido_id = pedido.id');
        $this->db->join('palete', 'ocorrencia.palete_id = palete.id');
        $this->db->where('ocorrencia.tipo_ocorrencia', 0);
        return $this->db->count_all_results();
    }

    /**
     * Verifica os pedidos relacionados com o palete onde estão inseridos e os não relacionados
     *
     * @param boolean $related Dados relacionados são true
     *
     * @return array relacionados ou não com os paletes
     */
    public function getPedidosPaletes($related = true, $id)
    {
        if ($related) {

            $sql = "SELECT * FROM pedido WHERE id IN(
					SELECT a.id
					FROM pedido a
					INNER JOIN palete_has_pedido b ON a.id = b.pedido_id
                    WHERE b.palete_id = $id);";

            $query = $this->db->query($sql);
            return $query->result_array();

        } else {

            $status = $this->palete_pedido->GetAll('pedido_id');
            if ($status != null) {

                $sql = "SELECT * FROM pedido WHERE id NOT IN(
					SELECT a.id
					FROM pedido a
					INNER JOIN palete_has_pedido b ON a.id = b.pedido_id
                    OR a.status = 0);";

                $query = $this->db->query($sql);
                return $query->result_array();

            } else {

                $sql = "SELECT * FROM pedido WHERE id NOT IN(
					SELECT id
					FROM pedido
					WHERE status = 0);";

                $query = $this->db->query($sql);
                return $query->result_array();
            }

        }

    }

    public function checkPedidosPalete($id_palete)
    {
        $sql = "SELECT id FROM pedido WHERE id IN(
					SELECT a.id
					FROM pedido a
					INNER JOIN palete_has_pedido b ON a.id = b.pedido_id
                    WHERE b.palete_id = $id_palete);";

        $query = $this->db->query($sql);
        return $query->result_array();

    }

    public function pesquisaPedido($termo)
    {
        if ($termo == "") {
            return false;
        }
        $this->db->select('pedido.id as pedido_id,  palete.id as palete_id, doca.id as doca_id');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');
        $this->db->where('cod_pedido', $termo);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            $result = $query->result_array();
            $data = array();

            
            foreach ($result as $key => $value) {
               $data['pedido'] = $this->pedido_model->GetById($value['pedido_id']);
            

               $paletes[$key]= $this->palete_model->GetById($value['palete_id']);
               $docas[$key] = $this->doca_model->GetById($value['doca_id']);

                


            }
             
            $data['paletes'] = $paletes;
            $data['docas'] =  array_unique($docas, SORT_REGULAR);

            
            return $data;
        } else {
            return null;
        }

    }

    // public function todosPedidosRelatorio()
    // {
    //     $this->db->select('pedido.cod_pedido, pedido.horario_entrada', 'palete.rota');
    //     $this->db->from('palete_has_pedido');
    //     $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
    //     $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');

    //     $this->db->order_by('pedido.id', 'ASC');
    //     return $this->db->get()->result_array();

    // }

    public function pedidosRelatorio($tipo_doca = null)
    {
        $this->db->select('pedido.id, pedido.cod_pedido, pedido.horario_entrada, palete.cod_palete, palete.rota, doca.cod_doca');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');

        if (is_null($tipo_doca)) {

            $this->db->order_by('pedido.id', 'ASC');

            return $this->db->get()->result_array();

        } else {

            $this->db->where('doca.tipo = ', $tipo_doca);

            return $this->db->get()->result_array();

        }

    }

    // public function pedidoClienteRelatorio($cliente_id)
    // {

    //     $this->db->select('pedido.cod_pedido, pedido.horario_entrada, cliente.cod_cliente, cliente.nome_empresa');
    //     $this->db->from('pedido');
    //     $this->db->join('cliente', 'pedido.cliente_id = cliente.id');
    //     $this->db->where('cliente.id =' . $cliente_id);

    //     return $this->db->get()->result_array();

    // }

    public function pedidoRotaRelatorio($rota)
    {

        $this->db->select('pedido.cod_pedido, pedido.horario_entrada, palete.cod_palete, palete.rota, doca.cod_doca');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');
        $this->db->join('palete_has_doca', 'palete_has_pedido.palete_id = palete_has_doca.palete_id');
        $this->db->join('doca', 'palete_has_doca.doca_id = doca.id');

        $this->db->where('palete.rota', $rota);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return null;
        }

        // return $this->db->get()->result_array();

    }

    public function paletePedido($id_pedido = null)
    {
        if ($id_pedido == null) {
            return false;
        }
        $this->db->select('palete.id as palete_id');
        $this->db->from('palete_has_pedido');
        $this->db->join('palete', 'palete_has_pedido.palete_id = palete.id');
        $this->db->join('pedido', 'palete_has_pedido.pedido_id = pedido.id');

        $this->db->where('pedido.id', $id_pedido);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            $array = $query->row_array();
            return $id_palete = $array['palete_id'];
        } else {
            return null;
        }

    }

    public function pedidosExpedidos()
    {
        $this->db->select('pedido.id, pedido.cod_pedido, ocorrencia.tipo_ocorrencia, ocorrencia.horario_ocorrencia,palete.cod_palete, palete.rota');
        $this->db->from('ocorrencia');
        $this->db->join('pedido', 'ocorrencia.pedido_id = pedido.id');
        $this->db->join('palete', 'ocorrencia.palete_id = palete.id');

        $this->db->where('ocorrencia.tipo_ocorrencia', 0);
        $this->db->order_by('pedido.id', 'ASC');



        return $this->db->get()->result_array();
    }

}
