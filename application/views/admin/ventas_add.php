<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Cargar Vista de Header -->
<?php $this->load->view("admin/includes/_header"); ?>
<div class="nk-app-root">
    <!-- Cargar Vista de Sidebar -->
    <?php $this->load->view("admin/includes/_sidebar"); ?>
    <!-- main @s -->
    <div class="nk-main ">
        <!-- wrap @s -->
        <div class="nk-wrap ">
            <!-- main header @s -->
            <?php $this->load->view("admin/includes/_main-header"); ?>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content ">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between g-3">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Usuarios | <strong class="text-primary small">Registro de venta</strong></h3>
                                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                            <ul class="breadcrumb breadcrumb-pipe">
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Inicio</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/ventas">Ventas</a></li>
                                                <li class="breadcrumb-item active">Registrar una nueva venta</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="<?php echo base_url(); ?>admin/clientes-add" class="btn btn-outline-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Nuevo Cliente</span></a>
                                        <a href="<?php echo base_url() ?>admin/inicio" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Regresar</span></a>
                                        <a href="<?php echo base_url() ?>admin/dashboard" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->

                            <div class="nk-block">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Registro de venta</h4>
                                    </div>
                                </div>
                                <!-- include message block -->
                                <?php $this->load->view('admin/partials/_mesagges'); ?>

                                <div class="nk-block nk-block-lg">
                                    <div class="card card-preview">
                                        <div class="card-inner">
                                            <div class="nk-block">
                                                <?php echo form_open_multipart('ventas_register_controller/registerVenta'); ?>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Identificación del cliente</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="identificacion_cliente" name="identificacion_cliente" placeholder="Numero de identificación del cliente">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Nombre del cliente</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control form-control-lg" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre del cliente" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Correo del Cliente</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="text" class="form-control form-control-lg" id="correo_cliente" name="correo_cliente" placeholder="Correo electronico del cliente" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Categoria</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <select class="form-select" data-placeholder="Seleccione la categoría" id="categoria" name="categoria" required="">
                                                                    <?php foreach ($categorias as $categoria) { ?>
                                                                        <option value="<?php echo $categoria->categoria; ?>"><?php echo $categoria->categoria; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Producto vendido</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <select class="form-select" data-placeholder="Seleccione el producto vendido" id="producto_vendido" name="producto_vendido" required="">
                                                                    <?php foreach ($productos as $producto) { ?>
                                                                        <option value="<?php echo $producto->producto; ?>"><?php echo $producto->producto; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Valor unitario</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="valor_unitario" name="valor_unitario" placeholder="Valor unitario del producto" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Descuento</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="descuento" name="descuento" placeholder="Valor total del descuento (Si aplica)" value="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Cantidad</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="cantidad" name="cantidad" placeholder="Ingrese la cantidad" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Valor Total</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="valor_total" name="valor_total" placeholder="Valor total del producto" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Cantidad recibida del cliente</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="cantidad_pago" name="cantidad_pago" placeholder="Cantidad recibida del cliente" required="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row g-3 align-center">
                                                    <div class="col-lg-3 offset-0">
                                                        <div class="form-group">
                                                            <label class="form-label">Cantidad a devolver al cliente</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 mb-3">
                                                        <div class="form-group">
                                                            <div class="form-control-wrap">
                                                                <input type="number" autocomplete="off" class="form-control form-control-lg" id="cantidad_devolver" name="cantidad_devolver" placeholder="Cantidad a devolver al cliente" required="" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row gy-4">
                                                    <!--col-->
                                                    <div class="col-12 mt-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-outline-primary justify-content-center" id="button">Registrar venta</button>
                                                        </div>
                                                    </div>
                                                    <!--col-->
                                                </div>

                                                </form>
                                            </div>
                                        </div><!-- .card-preview -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
            </div>
            <!-- wrap @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <?php $this->load->view("admin/includes/_JavaScripts"); ?>

    <script>
        $(document).ready(function() {
            $('#identificacion_cliente').on('change', function() {
                console.log('Evento change disparado');
                var identificacion = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo base_url(); ?>clientes_controller/buscar_cliente',
                    data: {
                        identificacion: identificacion
                    },
                    success: function(response) {
                        console.log(response);
                        var partes = response.split('}');
                        var data1 = JSON.parse(partes[0] + '}');
                        var data2 = JSON.parse(partes[1].trim() + '}');
                        var data = Object.assign({}, data1, data2);
                        if (data.nombre_cliente) {
                            $('#nombre_cliente').val(data.nombre_cliente);
                            $('#correo_cliente').val(data.correo_electronico);
                        } else {
                            $('#nombre_cliente').val('');
                        }
                    }
                });
            });
        });
        $(document).ready(function() {
            $('#categoria').change(function() {
                var categoria = $(this).val();
                console.log('Categoría seleccionada: ' + categoria);

                $.ajax({
                    url: '<?php echo base_url('/admin/ventas-add/get_productos_por_categoria'); ?>',
                    type: 'GET',
                    data: {
                        categoria: categoria
                    },
                    success: function(response) {
                        console.log(response);
                        var productos = JSON.parse(response);
                        console.log(productos);
                        var productoVendidoSelect = $('#producto_vendido');
                        productoVendidoSelect.empty();

                        if (productos && productos.length > 0) {
                            $.each(productos, function(index, producto) {
                                productoVendidoSelect.append('<option value="' + producto.producto_vendido + '">' + producto.producto_vendido + '</option>');
                            });
                        } else {
                            productoVendidoSelect.append('<option value="">No hay productos en esta categoría.</option>');
                        }

                        // Agregar evento change al selector de productos
                        productoVendidoSelect.change(function() {
                            var producto_seleccionado = $(this).val();
                            var valor_unitario = 0;

                            $.each(productos, function(index, producto) {
                                if (producto.producto_vendido === producto_seleccionado) {
                                    valor_unitario = producto.valor_unitario;
                                }
                            });

                            $('#valor_unitario').val(valor_unitario);
                        });
                    }
                });
            });
        });

        $('#cantidad, #descuento').change(function() {
            var cantidad = $('#cantidad').val();
            var descuento = $('#descuento').val();
            var valor_unitario = $('#valor_unitario').val();

            if (cantidad && valor_unitario) {
                var valor_total = (valor_unitario * cantidad) - descuento;
                $('#valor_total').val(valor_total);
            }
        });

        $('#cantidad_pago, #valor_total').change(function() {
            var valor_total = $('#valor_total').val();
            var cantidad_pago = $('#cantidad_pago').val();

            if (valor_total && cantidad_pago) {
                var cantidad_devolver = (cantidad_pago - valor_total);
                $('#cantidad_devolver').val(cantidad_devolver);
            }
        });
    </script>
</div>

</body>

</html>