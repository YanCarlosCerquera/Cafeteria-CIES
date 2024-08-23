<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Cargar Vista de Header -->
<?php $this->load->view("admin/includes/_header"); ?>
<div class="nk-app-root">
    <!-- Cargar Vista de Sidebar -->
    <?php $this->load->view("admin/includes/_sidebar"); ?>
    <!-- main @s -->
    <div class="nk-main">
        <!-- wrap @s -->
        <div class="nk-wrap">
            <!-- main header @s -->
            <?php $this->load->view("admin/includes/_main-header"); ?>
            <!-- main header @e -->
            <!-- content @s -->
            <div class="nk-content">
                <div class="container-fluid">
                    <div class="nk-content-inner">
                        <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                <div class="nk-block-between g-3">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Inventario de productos | <strong class="text-primary small">SENACoffe</strong></h3>
                                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                            <ul class="breadcrumb breadcrumb-pipe">
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/inicio">Inicio</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/inventario">Inventario</a></li>
                                                <li class="breadcrumb-item active">Registro y administración de inventario</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <button type="button" class="btn btn-primary" onclick="addProduct()">Agregar Producto</button>
                                        <a href="<?php echo base_url() ?>admin/dashboard" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Regresar</span></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <?php $this->load->view('admin/partials/_mesagges'); ?>
                            <!-- form start -->
                            <?php echo form_open_multipart(current_url()); ?>
                            <input type="hidden" name="form" value="1">
                            <div class="row mt-3">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="fechaInicio">Fecha de inicio</label>
                                        <div class="form-control-wrap focused">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input type="text" id="fechaInicio" name="fechaInicio" class="form-control date-picker" data-date-format="yyyy-mm-dd" value="<?php echo old('fechaInicio') ?>">
                                        </div>
                                        <div class="form-note">Formato de fecha <code>yyyy-mm-dd</code></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label" for="fechaFinal">Fecha de fin</label>
                                        <div class="form-control-wrap focused">
                                            <div class="form-icon form-icon-left">
                                                <em class="icon ni ni-calendar"></em>
                                            </div>
                                            <input type="text" id="fechaFinal" name="fechaFinal" class="form-control date-picker" data-date-format="yyyy-mm-dd" value="<?php echo old('fechaFinal') ?>">
                                        </div>
                                        <div class="form-note">Formato de fecha <code>yyyy-mm-dd</code></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="form-label">Acciones</label>
                                        <li class="">
                                            <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?><!-- form end -->
                        </div>
                        <!-- Modal Form -->
                        <div class="modal fade" id="modalProductForm" tabindex="-1" role="dialog" aria-labelledby="modalProductFormTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalProductFormTitle">Agregar/Editar Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- form start -->
                                        <?php echo form_open_multipart('inventario_controller/registerProduct'); ?>

                                        <input type="hidden" name="product_id" id="product_id">

                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3 offset-0">
                                                <div class="form-group">
                                                    <label class="form-label">Nombre del producto</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 mb-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <input type="text" autocomplete="off" class="form-control form-control-lg" id="nombre" name="nombre" placeholder="Nombre del producto" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-3 align-center">
                                            <div class="col-lg-3 offset-0">
                                                <div class="form-group">
                                                    <label class="form-label">Presentación</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 mb-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" data-placeholder="Seleccione la presentación" id="presentacion" name="presentacion" required="">
                                                            <option value="Unidad">Unidad</option>
                                                            <option value="Mililitros">Mililitros</option>
                                                            <option value="Rollo">Rollo</option>
                                                            <option value="Paquete">Paquete</option>
                                                            <option value="Sobre">Sobre</option>
                                                            <option value="Gramos">Gramos</option>
                                                            <option value="Libras">Libras</option>
                                                        </select>
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
                                                    <label class="form-label">Categoría</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-7 mb-3">
                                                <div class="form-group">
                                                    <div class="form-control-wrap">
                                                        <select class="form-select" data-placeholder="Seleccione la categoría" id="categoria" name="categoria" required="">
                                                            <option value="Panaderia">Panadería</option>
                                                            <option value="Agroindustria">Agroindustria</option>
                                                            <option value="Materia prima">Materia prima</option>
                                                            <option value="Insumos desechables y aseo">Insumos desechables y aseo</option>
                                                            <option value="Otros">Otros</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-gs">
                                            <div class="col-md-12 mt-3">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-lg btn-outline-primary" id="submit-button">Agregar producto</button>
                                                </div>
                                            </div>
                                        </div>

                                        <?php echo form_close(); ?><!-- form end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Form end -->

                    </div>
                    <div class="nk-block nk-block-lg">
                        <div class="card card-bordered">
                            <div class="card-inner">
                                <!-- Tabla -->
                                <table class="datatable-init-export nowrap table" data-export-title="Export">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nombre del producto</th>
                                            <th>Presentación</th>
                                            <th>Cantidad</th>
                                            <th>Categoría</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($productos)) : ?>
                                            <?php foreach ($productos as $producto) : ?>
                                                <tr>
                                                    <td><?php echo $producto->id; ?></td>
                                                    <td><?php echo $producto->nombre; ?></td>
                                                    <td><?php echo $producto->presentacion; ?></td>
                                                    <td><?php echo $producto->cantidad; ?></td>
                                                    <td><?php echo $producto->categoria; ?></td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-primary" id="edit" onclick="editProduct(
                                                                                        '<?php echo $producto->id; ?>', 
                                                                                        '<?php echo $producto->nombre; ?>',
                                                                                        '<?php echo $producto->presentacion; ?>',
                                                                                        '<?php echo $producto->cantidad; ?>',
                                                                                        '<?php echo $producto->categoria; ?>',                                              
                                                                                    )">
                                                            Editar
                                                        </a>

                                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="delete_item(
                                                                '<?php echo base_url(); ?>admin/inventario/delete/<?php echo html_escape($producto->id); ?>',
                                                                '<?php echo html_escape($producto->id); ?>',
                                                                'Producto eliminado correctamente!'
                                                            );">Eliminar</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="6">No hay productos en el inventario.</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- .card-preview -->
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
</body>
<script>
    // Inicializa el modal
    var modalProductForm = new bootstrap.Modal(document.getElementById('modalProductForm'));

    // Función para abrir el modal en modo de edición
    function editProduct(id, nombre, presentacion, cantidad, categoria) {
        modalProductForm.show();
        document.getElementById('product_id').value = id;
        document.getElementById('nombre').value = nombre;
        document.getElementById('cantidad').value = cantidad;

        // Establecer la opción seleccionada en el campo de presentación
        const presentacionSelect = document.getElementById('presentacion');
        presentacionSelect.value = presentacion;
        // Si el valor no coincide, puedes forzar el valor seleccionado de la siguiente manera
        if (!presentacionSelect.value) {
            console.error('Valor de presentación no encontrado:', presentacion);
        }

        // Establecer la opción seleccionada en el campo de categoría
        const categoriaSelect = document.getElementById('categoria');
        categoriaSelect.value = categoria;
        // Si el valor no coincide, puedes forzar el valor seleccionado de la siguiente manera
        if (!categoriaSelect.value) {
            console.error('Valor de categoría no encontrado:', categoria);
        }

        document.getElementById('modalProductFormTitle').innerText = 'Editar Producto';
        document.getElementById('submit-button').innerText = 'Actualizar Producto';
    }

    // Función para abrir el modal en modo de agregar nuevo producto
    function addProduct() {
        modalProductForm.show();

        // Limpiar los campos del formulario para agregar un nuevo producto
        document.getElementById('product_id').value = '';
        document.getElementById('nombre').value = '';
        document.getElementById('presentacion').value = '';
        document.getElementById('cantidad').value = '';
        document.getElementById('categoria').value = '';

        // Cambiar el título y el texto del botón del modal para indicar que es una adición
        document.getElementById('modalProductFormTitle').innerText = 'Agregar Nuevo Producto';
        document.getElementById('submit-button').innerText = 'Agregar producto';
    }
</script>


</html>