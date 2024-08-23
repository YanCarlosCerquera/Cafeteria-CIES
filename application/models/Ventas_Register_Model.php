<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_Register_Model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ventas_Register_Model');
    }

    private $table = 'ventas_registradas';

    public function save($data)
    {
        
        if ($this->db->insert('ventas_registradas', $data)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function actualizar_venta($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->db->update('ventas_registradas', $data, array('id' => $id))) {
            return true; 
        } else {
            return false; 
        }
    }

       //get venta
       public function get_venta()
       {
           $query = $this->db->get('ventas_registradas');
           return $query->result();
       } 

    // Obtener una venta por ID
    public function get_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    public function obtener_ventas()
    {
        $query = $this->db->get('ventas_registradas');
        return $query->result();
    }

    // Eliminar
    public function delete($id)
    {
        $venta = $this->get_by_id($id);
        if (!empty($venta)) {
            $this->db->where('id', $id);
            return $this->db->delete('ventas_registradas');
        } else {
            return false;
        }
    }

    // data de los input de fecha
    public function input_date_values()
    {
        $data = array(
            'fechaInicio' => $this->input->post('fechaInicio', true),
            'fechaFinal' => $this->input->post('fechaFinal', true),
        );
        return $data;
    }
    // selecciona toda la data por el id con filtro de fecha inicio - final
    public function get_data_by_id_date($ventasId, $fechainicio, $fechafin)
    {
        $this->db->select("*");
        $this->db->where('ventasId', $ventasId);
        $this->db->where("created >=", $fechainicio . ' 00:00:00');
        $this->db->where("created <=", $fechafin . ' ' . date('H:i:s'));
        $this->db->from("ventas_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    // selecciona toda la data por el id de las ultimas 24 horas
    public function get_data_by_id($ventasId)
    {
        $year = date("Y"); //Sacamos el año actual
        $mes = date("m");  //Sacamos el mes actual
        $dia = date("d");  //Sacamos el día actual
        $this->db->select("*");
        $this->db->where('ventasId', $ventasId);
        $this->db->where("created >=", $year . "-" . $mes . "-" . $dia . ' 00:00:00');
        $this->db->where("created <=", $year . '-' . $mes . '-' . $dia . ' ' . date('H:i:s'));
        $this->db->from("ventas_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    // selecciona toda la data por el id fecha ultimas 24h
    public function get_data_for_graph($ventasId, $column)
    {
        $year = date("Y"); //Sacamos el año actual
        $mes = date("m");  //Sacamos el mes actual
        $dia = date("d");  //Sacamos el día actual
        $this->db->select("" . $column . " as datos, created");
        $this->db->where('ventasId', $ventasId);
        $this->db->where("created >=", $year . "-" . $mes . "-" . $dia . ' 00:00:00');
        $this->db->where("created <=", $year . '-' . $mes . '-' . $dia . ' ' . date('H:i:s'));
        $this->db->from("ventas_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }
}
