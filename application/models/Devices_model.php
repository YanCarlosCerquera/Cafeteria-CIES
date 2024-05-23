<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Devices_model extends CI_Model
{

    // validar numero de serie
    public function get_device_by_serial($serialnumber)
    {
        $this->db->select("*");
        $this->db->where('serialnumber', $serialnumber);
        $this->db->from("mqtt_devices");
        $resp = $this->db->get();
        return $resp->row();
    }
    
    /* Registrar en BD el recurso */
    public function save_resource($data)
    {
        return $this->db->insert("mqtt_resources", $data);
    }

    /* Registrar en BD el dispositivo */
    public function save($data)
    {
        return $this->db->insert("mqtt_devices", $data);
    }

    // Cambiar el estado de la conexión y actualizar la fecha y hora de la ultima conexión o desconexión en BD
    public function change_device_status($serialnumber, $status) // true or false
    {
        $data = array(
            'online' => $status,
            'lastseen' => date('Y-m-d H:i:s')
        );
        $this->db->where('serialnumber', $serialnumber);
        return $this->db->update('mqtt_devices', $data);
    }

    // listar todos los dispositivos de un Cliente
    public function getDevices()
    {
        $this->db->select("d.*, u.username as userid");
        $this->db->from("mqtt_devices d");
        $this->db->join("mqtt_user u", "d.userid = u.id");
        // si no es super usuario pone el filtro
        if ($this->session->userdata("is_superuser") !== "1") {
            $this->db->where('userid', $this->session->userdata("id"));
        }
        $query = $this->db->get();
        return $query->result();
    }

    // buscar un dispositivo por el ID
    public function get_device($device_id)
    {
        $this->db->select("*");
        $this->db->where('id', $device_id);
        if ($this->session->userdata("is_superuser") !== "1") {
            $this->db->where('userid', $this->session->userdata("id"));
        }
        $this->db->from("mqtt_devices");
        $resultado = $this->db->get();
        return $resultado->row();
    }

    //update device 
    public function update_device($id, $data)
    {
        $this->db->where('id', $id);
        if ($this->session->userdata("is_superuser") !== "1") {
            $this->db->where('userid', $this->session->userdata("id"));
        }
        return $this->db->update('mqtt_devices', $data);
    }

    // habilitar/deshabilitar estado
    public function editStatus($id, $value)
    {
        $device = $this->get_device($id);
        if (!empty($device)) {
            $data = array(
                'status' => $value
            );
            $this->db->where('id', $device->id);
            if ($this->session->userdata("is_superuser") !== "1") {
                $this->db->where('userid', $this->session->userdata("id"));
            }
            return $this->db->update('mqtt_devices', $data);
        }
        return false;
    }

    // Eliminar
    public function Delete($id)
    {
        $device = $this->get_device($id);        
        if (!empty($device)) {
            $this->db->where('id', $device->id);
            if ($this->session->userdata("is_superuser") !== "1") {
                $this->db->where('userid', $this->session->userdata("id"));
            }
            return $this->db->delete('mqtt_devices');
        }
        return false;
    }

    // listar todos los dispositivos de un Cliente por el id
    public function get_devices_by_userid($id)
    {
        $this->db->select("serialnumber, rule_status_id, rule_store_id");
        $this->db->from("mqtt_devices");
        $this->db->where('userid', $id);
        $query = $this->db->get();
        return $query->result();
    }

    // habilitar/deshabilitar almacenado
    public function editStoreData($id, $value)
    {
        $device = $this->get_device($id);
        if (!empty($device)) {
            $data = array(
                'store' => $value
            );
            $this->db->where('id', $device->id);
            if ($this->session->userdata("is_superuser") !== "1") {
                $this->db->where('userid', $this->session->userdata("id"));
            }
            return $this->db->update('mqtt_devices', $data);
        }
        return false;
    }

    /* Registrar en BD la data del dispositivo */
    public function device_store_data($data)
    {
        return $this->db->insert("mqtt_data", $data);
    }
    
        // data de los estados para el dashboard
        public function get_status_for_dashboard(){
            $this->db->select("count(d.userid) as total")
                ->select("SUM(CASE WHEN d.online = 1 THEN 1 ELSE 0 END) as online")
                ->select("SUM( IF(d.online = 0 , d.status, 0) ) as offline")
                ->select("SUM(CASE WHEN d.status = 0 THEN 1 ELSE 0 END) as deshabilitados"); 
            $this->db->from("mqtt_devices d");
            $this->db->where('d.userid', $this->session->userdata("id"));
            $query = $this->db->get();
            return $query->row();
        }
    
        // ultimo registrado
        public function  get_last_register(){
            $resp = $this->db->query("SELECT serialnumber, MAX(created) AS created FROM mqtt_devices WHERE userid = ".$this->session->userdata('id')." LIMIT 1");
            return $resp->row(); 
        }
    
        // ultimo online
        public function  get_last_online(){
            $resp = $this->db->query("SELECT serialnumber, MAX(created) AS created FROM mqtt_devices WHERE online = 1 AND STATUS = 1 AND userid = ".$this->session->userdata('id')." LIMIT 1");
            return $resp->row(); 
        }
    
        // ultimo offline
        public function  get_last_offline(){
            $resp = $this->db->query("SELECT serialnumber, MAX(created) AS created FROM mqtt_devices WHERE online = 0 AND STATUS = 1 AND userid = ".$this->session->userdata('id')." LIMIT 1");
            return $resp->row(); 
        }
    
        // ultimo deshabilitado
        public function  get_last_disable(){
            $this->db->select("serialnumber, MAX(created) AS created");
            $this->db->from("mqtt_devices");
            $this->db->where("online", 0);
            $this->db->where("status", 0);
            $this->db->where("userid", $this->session->userdata('id'))->limit(1);
            $query = $this->db->get();
            return $query->row(); 
        }
    
        // Traer dispositivos para el Dashboard
        public function get_devices_for_dashboard()
        {
            $this->db->select('*')
            ->from('mqtt_devices')
            ->where('status', 1);
            $this->db->where('userid', $this->session->userdata("id"));
            $query = $this->db->get();
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

    // selecciona toda la data por el device id con filtro de fecha inicio - final
    public function get_data_by_serial_date($deviceId, $fechainicio, $fechafin)
    {
        $this->db->select("*");
        $this->db->where('deviceId', $deviceId);
        $this->db->where("created >=", $fechainicio . ' 00:00:00');
        $this->db->where("created <=", $fechafin . ' ' . date('H:i:s'));
        $this->db->from("mqtt_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    // selecciona toda la data por el device id de las ultimas 24 horas
    public function get_data_by_serial($deviceId)
    {
        $year = date("Y"); //Sacamos el año actual
        $mes = date("m");  //Sacamos el mes actual
        $dia = date("d");  //Sacamos el día actual
        $this->db->select("*");
        $this->db->where('deviceId', $deviceId);
        $this->db->where("created >=", $year . "-" . $mes . "-" . $dia . ' 00:00:00');
        $this->db->where("created <=", $year . '-' . $mes . '-' . $dia . ' ' . date('H:i:s'));
        $this->db->from("mqtt_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    // selecciona toda la data por el device id fecha ultimas 24h
    public function get_data_for_graph($deviceId, $column)
    {
        $year = date("Y"); //Sacamos el año actual
        $mes = date("m");  //Sacamos el mes actual
        $dia = date("d");  //Sacamos el día actual
        $this->db->select("" . $column . " as datos, created");
        $this->db->where('deviceId', $deviceId);
        $this->db->where("created >=", $year . "-" . $mes . "-" . $dia . ' 00:00:00');
        $this->db->where("created <=", $year . '-' . $mes . '-' . $dia . ' ' . date('H:i:s'));
        $this->db->from("mqtt_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    // selecciona toda la data por el device id segun rango de fechas
    public function get_data_for_graph_by_range($deviceId, $column, $fechainicio, $fechafin)
    {
        $this->db->select("" . $column . " as datos, created");
        $this->db->where('deviceId', $deviceId);
        $this->db->where("created >=", $fechainicio . ' 00:00:00');
        $this->db->where("created <=", $fechafin . ' ' . date('H:i:s'));
        $this->db->from("mqtt_data")->order_by('created', 'desc');
        $resultado = $this->db->get();
        return $resultado->result();
    }

    
    
}