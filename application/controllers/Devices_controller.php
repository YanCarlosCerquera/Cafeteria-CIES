<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Devices_controller extends Core_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!is_user()) {
            redirect(base_url());
        }
        $this->load->model('Devices_model');
        $this->load->model('Users_model');
    }
    // cargar la vista de agregar dispositivo
    public function deviceAdd()
    {
        $data['title'] = "Agregar dispositivo";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;

        $this->load->view("admin/devices/device_add", $data);
    }
    // validar numero de serie
    public function check_serial_id()
    {
        // Capturar POST con formato json
        $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")), TRUE);
        $serialnumber = $this->input->post("serialnumber", TRUE);

        if ($this->Devices_model->get_device_by_serial($serialnumber)) {
            echo json_encode(['status' => true]);
        } else {
            echo json_encode(['status' => false]);
        }
    }
    // registrar un dispositivo ( inicio de la API de EMQX)
    public function deviceStore()
    {
        //validate inputs
        $this->form_validation->set_rules('name', 'Name', 'required|xss_clean|min_length[4]|max_length[100]');
        $this->form_validation->set_rules('serialnumber', 'Serialnumber', 'required|xss_clean|min_length[4]|max_length[100]|is_unique[mqtt_devices.serialnumber]');
        $this->form_validation->set_rules('type', 'Type', 'required|xss_clean');
        $this->form_validation->set_rules('address', 'Address', 'xss_clean');

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', '¡Parámetros incorrectos, intente de nuevo!');
            redirect(base_url() . 'admin/devices-add');
        } else {
            // OK
            // limpiar el serial number
            $DeviceID = remove_forbidden_characters($this->input->post("serialnumber"));
            // definir variables para las reglas
            $rule_status_id = ""; // regla almacena los estados de la conexión
            $rule_store_id = ""; // regla de almacenar en la BD
            // Traigo todos los recursos registrados
            $resources = list_web_hook_resource();
            // pasar a array el JSON            
            $data_resources = json_decode($resources, true);
            // traer respuesta recurso web-hook-status | web-hook-store
            $web_hook_status = $this->get_resource($data_resources, "web-hook-status");
            $web_hook_store  = $this->get_resource($data_resources, "web-hook-store");
            // var_dump($resources);
            // die();
            // si no hay recursos y si no existe el recurso web-hook-status | web-hook-store
            if (!$data_resources["data"] && !$web_hook_status && !$web_hook_store) {
                // si no esta el recurso lo creo
                $resp = add_web_hook_resource(base_url() . 'api/v1/devices/status', 'web-hook-status');
                // pasar a array el json de la respuesta
                $resourceCreated = json_decode($resp, true);
                // guardar el recurso en BD
                $data_resource = array(
                    'resource_id' => $resourceCreated["data"]["id"],
                    'resource_description' => $resourceCreated["data"]["description"],
                    'resource_type' => $resourceCreated["data"]["type"],
                );
                $save = $this->Devices_model->save_resource($data_resource);
                // si se salva el recurso
                if ($save) {
                    // creo la regla de salvar los estados
                    $resp_rule = add_web_hook_rule("status", $this->Users_model->get_user_username(), $DeviceID, $resourceCreated["data"]["id"]);
                    // pasar a array el json de la respuesta
                    $ruleCreated = json_decode($resp_rule, true);
                    // poner el id en la variable global
                    $rule_status_id = $ruleCreated["data"]["id"];

                    // recurso de salvar la data
                    // si no esta el recurso lo creo
                    $resp = add_web_hook_resource(base_url() . 'api/v1/devices/store', 'web-hook-store');
                    // pasar a array el json de la respuesta
                    $resourceCreated = json_decode($resp, true);
                    //var_dump($resourceCreated["data"]["id"]);
                    $data_resource = array(
                        'resource_id' => $resourceCreated["data"]["id"],
                        'resource_description' => $resourceCreated["data"]["description"],
                        'resource_type' => $resourceCreated["data"]["type"],
                    );
                    $save = $this->Devices_model->save_resource($data_resource);
                    // si se salva el recurso
                    if ($save) {
                        // creo la regla de salvar los datos
                        $resp_rule = add_web_hook_rule("store", $this->Users_model->get_user_username(), $DeviceID, $resourceCreated["data"]["id"]);
                        // pasar a array el json de la respuesta
                        $ruleCreated = json_decode($resp_rule, true);
                        // poner el id en la variable global
                        $rule_store_id = $ruleCreated["data"]["id"];
                    } else {
                        $this->session->set_flashdata("error", "No se pudo registrar el dispositivo");
                        redirect(base_url() . 'admin/devices-add');
                    }
                } else {
                    $this->session->set_flashdata("error", "No se pudo registrar el dispositivo");
                    redirect(base_url() . 'admin/devices-add');
                }
            } else {
                // si existen los recursos
                // creo la regla de salvar los estados
                $resp_rule = add_web_hook_rule("status", $this->Users_model->get_user_username(), $DeviceID, $web_hook_status);
                // pasar a array el json de la respuesta
                $ruleCreated = json_decode($resp_rule, true);
                // poner el id en la variable global
                $rule_status_id = $ruleCreated["data"]["id"];
                // creo la regla de salvar los datos
                $resp_rule = add_web_hook_rule("store", $this->Users_model->get_user_username(), $DeviceID, $web_hook_store);
                // pasar a array el json de la respuesta
                $ruleCreated = json_decode($resp_rule, true);
                // poner el id en la variable global
                $rule_store_id = $ruleCreated["data"]["id"];
            }

            // data para almacenar en el dispositivo nuevo
            $data['name'] = remove_forbidden_characters($this->input->post("name"));
            $data['serialnumber'] = $DeviceID;
            $data['type'] = $this->input->post("type");
            $data['address'] = remove_forbidden_characters($this->input->post("address"));
            $data['userid'] = $this->session->userdata("id");
            $data['rule_status_id'] = $rule_status_id;
            $data['rule_store_id']  = $rule_store_id;
            $data['lastseen'] = date('Y-m-d H:i:s');
            $data['created'] = date('Y-m-d H:i:s');

            // almacenar la data
            if ($this->Devices_model->save($data)) {
                // Quitar de la lista negra el id del dispositivo
                remove_ban_deviceID($DeviceID);
                $this->session->set_flashdata("success", "¡Registro de nuevo dispositivo exitoso!");
                redirect(base_url() . 'admin/devices-add');
            } else {
                $this->session->set_flashdata("error", "No se pudo registrar el nuevo dispositivo");
                redirect(base_url() . 'admin/devices-add');
            }
         }
    }

    // devuelve false si no existe el recurso segun parámetro, si existe devuelve el ID ;)
    public function get_resource($data, $compare)
    {
        for ($i = 0; $i < sizeof($data["data"]); $i++) {
            if ($data["data"][$i]["description"] == $compare) {
                return $data["data"][$i]["id"];
            }
        }
        return false;
    }

    // vista de tabla dispositivos
    public function deviceList()
    {
        $data['title'] = "Dispositivos registrados";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['devices'] = $this->Devices_model->getDevices();

        $this->load->view("admin/devices/devices_list", $data);
    }

    // editar dispositivo POST
    public function change_device_post()
    {
        $data = array(
            'name' => remove_forbidden_characters($this->input->post("name")),
            'address' => remove_forbidden_characters($this->input->post("address")),
        );
        $id = $this->input->post('device_id', true);
        // dispositivo por el id
        $device = $this->Devices_model->get_device($id);
        //check if exists
        if (empty($device)) {
            $this->session->set_flashdata('error', "¡Error, ocurrió un problema!");
            redirect($this->agent->referrer());
        } else {
            if ($this->Devices_model->update_device($id, $data)) {
                $this->session->set_flashdata('success', "¡Dispositivo actualizado correctamente!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', "¡Error, ocurrió un problema!");
                redirect($this->agent->referrer());
            }
        }
    }

    // habilitar | deshabilitar 
    public function deviceEditStatus()
    {
        $id = $this->input->post("id", TRUE);
        $value = $this->input->post("value", TRUE);
        $device = $this->Devices_model->get_device($id);
        $resp = $this->Devices_model->editStatus($id, $value);
        // habilitado
        if ($resp && $value == 1) {
            // quitar de la lista negra
            remove_ban_deviceID($device->serialnumber);
            // habilitar la regla de los estados
            action_web_hook_rule($device->rule_status_id, true, 'PUT');
            // habilitar la regla de salvar los datos
            action_web_hook_rule($device->rule_store_id, true, 'PUT');
            // Salvar el log en la base de datos
            log_activity('Dispositivo habilitado [Device Id: ' . $device->serialnumber . ', By user: ' .  $this->Users_model->get_user_username() . ', Is super_user: ' . ($this->Users_model->is_admin() == true ? 'Yes' : 'No') . ']', 'enable', $device->serialnumber);
            // retornar
            $this->session->set_flashdata('success', "¡Dispositivo, habilitado corectamante!");
            redirect($this->agent->referrer());
        } elseif ($resp && $value == 0) { // deshabilitado
            // agregar a la lista de ban el dispositivo
            add_ban_deviceID($device->serialnumber);
            // deshabilitar la regla de los estados
            action_web_hook_rule($device->rule_status_id, false, 'PUT');
            // deshabilitar la regla de salvar los datos
            action_web_hook_rule($device->rule_store_id, false, 'PUT');
            // Salvar el log en la base de datos
            log_activity('Dispositivo deshabilitado [Device Id: ' . $device->serialnumber . ', By user: ' .  $this->Users_model->get_user_username() . ', Is super_user: ' . ($this->Users_model->is_admin() == true ? 'Yes' : 'No') . ']', 'disable', $device->serialnumber);
            // retornar
            $this->session->set_flashdata('warning', "¡Dispositivo, deshabilitado corectamante!");
            redirect($this->agent->referrer());
        } else { // error
            $this->session->set_flashdata('error', "¡Error, ocurrió un problema!");
            redirect($this->agent->referrer());
        }
    }

    // eliminar dispositivo
    public function deviceDelete()
    {
        // Capturar POST con formato json
        $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")), TRUE);
        $id = $this->input->post("id", TRUE);
        // dispositivo
        $device = $this->Devices_model->get_device($id);
        // modelo
        $resp = $this->Devices_model->Delete($id);
        if ($resp) {
            // agregar a la lista de ban el dispositivo
            add_ban_deviceID($device->serialnumber);
            // eliminar la regla de los estados
            action_web_hook_rule($device->rule_status_id, '', 'DELETE');
            // deshabilitar la regla de salvar los datos
            action_web_hook_rule($device->rule_store_id, '', 'DELETE');
            // Salvar el log en la base de datos
            log_activity('Dispositivo eliminado [Device Id: ' . $device->serialnumber . ', By user: ' .  $this->Users_model->get_user_username() . ', Is super_user: ' . ($this->Users_model->is_admin() == true ? 'Yes' : 'No') . ']', 'delete', $device->serialnumber);
        }
        echo json_encode(['status' => $resp]);
    }
    
    
    // habilitar o deshabilitar el alamacenado en BD
    public function deviceEditStoreData()
    {
        // Capturar POST con formato json
        $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")), TRUE);
        $id = $this->input->post("id", TRUE);
        $value = $this->input->post("value", TRUE);
        // capturo los datos del dispositivo por el id
        $device = $this->Devices_model->get_device($id);
        // habilitar la regla de salvar los datos
        action_web_hook_rule($device->rule_store_id, $value, 'PUT');
        $resp = $this->Devices_model->editStoreData($id, $value);
        if($resp && $value == '1'){
            log_activity('Almacenamiento habilitado [Device Id: ' . $device->serialnumber . ', By user: ' .  $this->Users_model->get_user_username() . ', Is super_user: ' . ($this->Users_model->is_admin() == true ? 'Yes' : 'No') . ']', 'store', $device->serialnumber);
        }else{
            log_activity('Almacenamiento deshabilitado [Device Id: ' . $device->serialnumber . ', By user: ' .  $this->Users_model->get_user_username() . ', Is super_user: ' . ($this->Users_model->is_admin() == true ? 'Yes' : 'No') . ']', 'store', $device->serialnumber);
        }
        echo json_encode(['status' => $resp, 'value' => $value]);
    }

    // vista de dispositivo
    public function deviceView($serialnumber){        
        $decodificado = base64_decode($serialnumber);
        $data['title'] = "Dispositivo - ".$decodificado;
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;

        // para la tabla
        $date = $this->Devices_model->input_date_values();
		$form = $this->input->post("form");
        // dispositivo
        $data['device'] = $this->Devices_model->get_device_by_serial($decodificado);
        //var_dump($data['device']);
        //exit;
        // log de dispositivos
        $data['device_log'] = get_device_activity_logs($decodificado, 5);

        // data para la tabla
        if($form == '1'){
            if ($date['fechaInicio'] != NULL && $date['fechaFinal'] != NULL) {
                $this->session->set_flashdata('form_data', $this->Devices_model->input_date_values());
                $data['device_data'] = $this->Devices_model->get_data_by_serial_date($data['device']->id,$date['fechaInicio'] , $date['fechaFinal']);
            } else {
                $this->session->set_flashdata('form_data', $this->Devices_model->input_date_values());
                $this->session->set_flashdata('error', "¡Se deben seleccionar la fecha inicio y la final!");
            }            
        }else{
           // cargar la data sin filtro de fechas
           $data['device_data'] = $this->Devices_model->get_data_by_serial($data['device']->id); 
        }

        $this->load->view("admin/devices/device_generic_view", $data);

    }

    
    // traer datos para la grafica
    public function get_data_for_graph(){
        if (!is_user()) {
            echo json_encode(['status' => false]);
        }
        // Capturar POST con formato json
        $_POST = json_decode($this->security->xss_clean(file_get_contents("php://input")), TRUE);
        $column = $this->input->post("column", TRUE);
        $fechainicio = $this->input->post("fechainicio", TRUE);
        $fechafin = $this->input->post("fechafin", TRUE);
        $id = $this->input->post("id", TRUE); // id del dispositivo

        if($fechainicio != NULL && $fechafin != NULL){
            echo json_encode($this->Devices_model->get_data_for_graph_by_range($id, $column, $fechainicio, $fechafin));
        }else{
            echo json_encode($this->Devices_model->get_data_for_graph($id, $column));
        }

    }
}
