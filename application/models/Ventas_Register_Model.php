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


    public function obtener_ventas_con_productos()
    {
        $query = $this->db->get('ventas_registradas');
        $ventas = $query->result();

        foreach ($ventas as $venta) {
            $productos_vendidos_json = $venta->productos_vendidos;

            // Depuración: Verifica el contenido del JSON
            log_message('debug', 'productos_vendidos_json: ' . $productos_vendidos_json);

            // Verifica si $productos_vendidos_json es una cadena válida JSON
            if (is_string($productos_vendidos_json) && !empty($productos_vendidos_json)) {
                $productos_decoded = json_decode($productos_vendidos_json, true);

                // Verifica si json_decode devolvió un array o un objeto
                if (json_last_error() === JSON_ERROR_NONE) {
                    $venta->productos_vendidos = $productos_decoded;
                    // Depuración adicional
                    log_message('debug', 'productos_decoded: ' . print_r($productos_decoded, true));
                } else {
                    // Maneja el error de decodificación JSON
                    $venta->productos_vendidos = [];
                    log_message('error', 'Error de decodificación JSON: ' . json_last_error_msg());
                }
            } else {
                $venta->productos_vendidos = [];
            }
        }

        return $ventas;
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

    public function obtener_ventas_filtradas($fechaInicio, $fechaFinal)
    {
        $this->db->where('created >=', $fechaInicio);
        $this->db->where('created <=', $fechaFinal);
        $query = $this->db->get('ventas_registradas');
        return $query->result();
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

    public function get_data_by_date_range($fechaInicio, $fechaFinal)
    {
        $this->db->select("*");
        $this->db->where("created >=", $fechaInicio . ' 00:00:00');
        $this->db->where("created <=", $fechaFinal . ' ' . date('H:i:s'));
        $this->db->from("ventas_registradas")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }
}
