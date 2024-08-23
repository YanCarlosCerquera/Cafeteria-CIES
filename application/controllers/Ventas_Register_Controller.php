<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_Register_Controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ventas_Register_Model');
        $this->load->model('Settings_Model');

    }
    public function detalle_venta($id)
    {
        $data['title'] = "Detalle de venta";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['detalle_venta'] = $this->Ventas_Register_Model->get_by_id($id);
        $this->load->view('admin/detalle_venta', $data);
    }

    public function registerVenta()
{
    $productosVendidos = array();
    $productos = $this->input->post('productos_vendidos');
    foreach ($productos as $producto) {
        $productosVendidos[] = array(
            'producto' => $producto['producto'],
            'valor_unitario' => $producto['valor_unitario'],
            'cantidad' => $producto['cantidad']
        );
    }

    $data = array(
        'productos_vendidos' => json_encode($productosVendidos),
        'descuento' => $this->input->post('descuento'),
        'nombre_cliente' => $this->input->post('nombre_cliente'),
        'identificacion_cliente' => $this->input->post('identificacion_cliente'),
        'correo_cliente' => $this->input->post('correo_cliente'),
        'created' => date('Y-m-d H:i:s')
    );

    if ($this->Ventas_Register_Model->save($data)) {
        $this->session->set_flashdata('success', "¡Registro de venta exitoso!");
    } else {
        $this->session->set_flashdata('error', "¡Error, no se pudo registrar la venta!");
    }
    redirect($this->agent->referrer());
}

    public function listar_ventas()
    {
        $data['title'] = "Registro de ventas";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['ventas'] = $this->Ventas_Register_Model->obtener_ventas();
        $this->load->view('admin/ventas', $data);
    }

    public function change_venta_post()
    {
        //check if admin
        if (!is_admin()) {
            redirect(base_url());
        }

        $data = array(
            'producto_vendido' => $this->input->post('producto_vendido'),
            'categoria' => $this->input->post('categoria'),
            'valor_unitario' => $this->input->post('valor_unitario'),
            'descuento' => $this->input->post('descuento'),
            'cantidad' => $this->input->post('cantidad'),
            'valor_total' => $this->input->post('valor_total'),
        );

        $id = $this->input->post('venta_id', true);

        $venta = $this->Ventas_Register_Model->get_venta($id);

        //check if exists
        if (empty($venta)) {
            redirect($this->agent->referrer());
        } else {

            if ($this->Ventas_Register_Model->actualizar_venta($id, $data)) {
                $this->session->set_flashdata('success', "Venta actualizada correctamente!");
                redirect($this->agent->referrer());
            } else {
                $this->session->set_flashdata('error', "¡Error, ocurrió un problema!");
                redirect($this->agent->referrer());
            }
        }
    }


    public function ventasFiltro($id)
    {

        // para la tabla
        $date = $this->Ventas_Register_Model->input_date_values();
        $form = $this->input->post("form");
        // dispositivo
        $data['ventas_data'] = $this->Ventas_Register_Model->get_by_id($id);

        // data para la tabla
        if ($form == '1') {
            if ($date['fechaInicio'] != NULL && $date['fechaFinal'] != NULL) {
                $this->session->set_flashdata('form_data', $this->Ventas->input_date_values());
                $data['ventas_data'] = $this->Ventas_Register_Model->get_data_by_id_date($data['ventas_data']->id, $date['fechaInicio'], $date['fechaFinal']);
            } else {
                $this->session->set_flashdata('form_data', $this->Ventas_Register_Model->input_date_values());
                $this->session->set_flashdata('error', "¡Se deben seleccionar la fecha inicio y la final!");
            }
        } else {
            // cargar la data sin filtro de fechas
            $data['ventas_data'] = $this->Ventas_Register_Model->get_data_by_id($data['venta']->id);
        }

        $this->load->view("admin/ventas", $data);
    }

    public function delete($id) {
        // Verificar si se recibió un ID válido
        if ($id) {
            // Llamar al método delete del modelo
            $result = $this->Ventas_Register_Model->delete($id);
    
            // Enviar una respuesta JSON según el resultado de la eliminación
            if ($result) {
                echo json_encode(['status' => true, 'message' => 'Venta eliminado correctamente.']);
            } else {
                echo json_encode(['status' => false, 'message' => 'No se pudo eliminar la venta.']);
            }
        } else {
            echo json_encode(['status' => false, 'message' => 'ID no proporcionado.']);
        }
    }


}
