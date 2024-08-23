<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!is_user()) {
            redirect(base_url());
        }
        $this->load->model('Ventas_model');
    }

    public function ventas()
    {
        $data['title'] = "Modulo ventas";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;

        // Obtener la lista de productos y categorías
        $data['productos'] = $this->Ventas_model->get_productos();
        $data['categorias'] = $this->Ventas_model->get_categorias();

        // Cargar la vista con los datos
        $this->load->view("admin/ventas", $data);
    }

    public function get_categoria()
    {
        $categoria = $this->input->get('categoria');
        log_message('debug', 'Categoría recibida: ' . $categoria);
        return $categoria;
    }


    public function ventas_add()
    {
        $data['title'] = "Registrar venta";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $data['categorias'] = $this->Ventas_model->get_categorias();
        $data['productos_por_categoria'] = array();

        $this->load->view("admin/ventas_add", $data);
    }

    public function get_productos_por_categoria()
    {
        $categoria = $this->input->get('categoria');
        $productos = $this->Ventas_model->productos_por_categoria($categoria);
        $productos_por_categoria = array();

        foreach ($productos as $producto) {
            $detalles = json_decode($producto->detalles, true);
            $productos_por_categoria = array_merge($productos_por_categoria, $detalles['productos']);
        }

        echo json_encode($productos_por_categoria);
    }

    public function productos_por_categoria($categoria)
    {
        $productos = array();
        foreach ($this->db->get('ventas')->result() as $row) {
            if ($row->categoria == $categoria) {
                $productos[] = array(
                    'producto_vendido' => $row->producto_vendido,
                    'valor_unitario' => $row->valor_unitario
                );
            }
        }
        return $productos;
    }

    public function registerVenta()
    {
        // validate inputs
        $this->form_validation->set_rules('producto_vendido', 'Producto Vendido', 'required|xss_clean');
        $this->form_validation->set_rules('categoria', 'Categoría', 'required|xss_clean');
        $this->form_validation->set_rules('valor_unitario', 'Valor Unitario', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('descuento', 'Descuento', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('cantidad', 'Cantidad', 'required|xss_clean|numeric');
        $this->form_validation->set_rules('valor_total', 'Valor Total', 'required|xss_clean|numeric');
    
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error', '¡Parámetros incorrectos, intente de nuevo!');
            redirect(base_url() . 'admin/ventas-add');
        } else {
            // OK
            // limpiar el serial number
            $producto_vendido = remove_forbidden_characters($this->input->post("producto_vendido"));
            // definir variables para las reglas
            // ...
    
            // data para almacenar en la venta nueva
            $data['producto_vendido'] = $producto_vendido;
            $data['categoria'] = $this->input->post("categoria");
            $data['valor_unitario'] = $this->input->post("valor_unitario");
            $data['descuento'] = $this->input->post("descuento");
            $data['cantidad'] = $this->input->post("cantidad");
            $data['valor_total'] = $this->input->post("valor_total");
            $data['userid'] = $this->session->userdata("id");
            $data['created'] = date('Y-m-d H:i:s');
    
            // almacenar la data
            if ($this->Ventas_model->save($data)) {
                $this->session->set_flashdata("success", "¡Registro de nueva venta exitoso!");
                redirect(base_url() . 'admin/ventas-add');
            } else {
                $this->session->set_flashdata("error", "No se pudo registrar la nueva venta");
                redirect(base_url() . 'admin/ventas-add');
            }
        }
    }

    public function ventasFiltro($id)
    {

        // para la tabla
        $date = $this->Ventas_model->input_date_values();
        $form = $this->input->post("form");
        // dispositivo
        $data['ventas_data'] = $this->Ventas_model->get_by_id($id);

        // data para la tabla
        if ($form == '1') {
            if ($date['fechaInicio'] != NULL && $date['fechaFinal'] != NULL) {
                $this->session->set_flashdata('form_data', $this->Ventas->input_date_values());
                $data['ventas_data'] = $this->Ventas_model->get_data_by_id_date($data['ventas_data']->id, $date['fechaInicio'], $date['fechaFinal']);
            } else {
                $this->session->set_flashdata('form_data', $this->Ventas_model->input_date_values());
                $this->session->set_flashdata('error', "¡Se deben seleccionar la fecha inicio y la final!");
            }
        } else {
            // cargar la data sin filtro de fechas
            $data['ventas_data'] = $this->Ventas_model->get_data_by_id($data['venta']->id);
        }

        $this->load->view("admin/ventas", $data);
    }
}
