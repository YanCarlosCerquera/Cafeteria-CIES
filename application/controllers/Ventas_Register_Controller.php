<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_Register_Controller extends Core_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ventas_Register_Model');
        $this->load->model('Settings_Model');
        $this->load->model('Ventas_model');
        $this->load->model('Users_model');
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

    public function get_current_user_id()
    {
        return $this->session->userdata('user_id');
    }

    public function registerVenta()
    {   
        $vendedor_id = $this->get_current_user_id();

        // Obtener el JSON de productos vendidos
        $productosJson = $this->input->post('productos_vendidos');
        $productosVendidos = array();

        // Verificar si $productosJson no está vacío y es un JSON válido
        if ($productosJson && is_string($productosJson)) {
            $productos = json_decode($productosJson, true); // Decodificar los productos enviados desde el formulario

            // Verificar si $productos es un array y no está vacío
            if (is_array($productos) && !empty($productos)) {
                foreach ($productos as $producto) {
                    // Asegurarse de que los campos necesarios estén presentes
                    if (isset($producto['producto_vendido']) && isset($producto['valor_unitario']) && isset($producto['cantidad'])) {
                        $valorUnitario = (float)$producto['valor_unitario'];
                        $cantidad = (int)$producto['cantidad'];

                        // Calcular el subtotal para cada producto
                        $subtotal = $valorUnitario * $cantidad;

                        // Agregar el producto al array de productos vendidos
                        $productosVendidos[] = array(
                            'producto' => $producto['producto_vendido'],
                            'valor_unitario' => $valorUnitario,
                            'cantidad' => $cantidad,
                            'subtotal' => $subtotal
                        );
                    }
                }
            }
        }


        // Obtener y validar otros datos del formulario
        $descuento = (float)$this->input->post('descuento');
        $valorTotal = (float)$this->input->post('valor_total');
        $valorTotal = max($valorTotal, 0); // Evitar valores negativos
        $nombreCliente = $this->input->post('nombre_cliente');
        $identificacionCliente = $this->input->post('identificacion_cliente');
        $correoCliente = $this->input->post('correo_cliente');

        // Preparar los datos para guardar
        $data = array(
            'productos_vendidos' => json_encode($productosVendidos), // Guardar JSON en la base de datos
            'descuento' => $descuento,
            'valor_total' => $valorTotal,
            'nombre_cliente' => $nombreCliente,
            'identificacion_cliente' => $identificacionCliente,
            'correo_cliente' => $correoCliente,
            'vendedor_id' => $vendedor_id,
            'created' => date('Y-m-d H:i:s')
        );

        // Guardar la venta y mostrar el mensaje correspondiente
        if ($this->Ventas_Register_Model->save($data)) {
            $this->session->set_flashdata('success', "¡Venta registrada exitosamente!");
            redirect($_SERVER['HTTP_REFERER']); // Recarga la página anterior
        } else {
            $this->session->set_flashdata('error', "¡Error al registrar la venta!");
            redirect($_SERVER['HTTP_REFERER']); // Recarga la página anterior
        }
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


    public function delete($id)
    {
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

    public function listar_ventas_filtradas()
    {
        $fechaInicio = $this->input->post('fechaInicio');
        $fechaFinal = $this->input->post('fechaFinal');

        redirect('/admin/ventas?fecha_inicio=' . $fechaInicio . '&fecha_final=' . $fechaFinal);
    }

    public function listar_ventas()
    {
        $fechaInicio = $this->input->get('fecha_inicio');
        $fechaFinal = $this->input->get('fecha_final');

        if ($fechaInicio && $fechaFinal) {
            $data['ventas'] = $this->Ventas_Register_Model->obtener_ventas_filtradas($fechaInicio, $fechaFinal);
        } else {
            $data['ventas'] = $this->Ventas_Register_Model->obtener_ventas();
        }

        $this->cargar_vistas($data);
    }

    public function cargar_vistas($data)
    {
        $data['title'] = "Detalle de venta";
        $data['application_name'] = $this->settings->application_name;
        $data['description'] = $this->settings->site_description;
        $data['keywords'] = $this->settings->keywords;
        $this->load->view("admin/includes/_header", $data);
        $this->load->view("admin/includes/_sidebar", $data);
        $this->load->view('admin/ventas', $data);
    }
}
