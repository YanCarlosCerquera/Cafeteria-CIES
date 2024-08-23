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
                                        <h3 class="nk-block-title page-title">Modulo de ventas | <strong class="text-primary small">SENACoffe</strong></h3>
                                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                            <ul class="breadcrumb breadcrumb-pipe">
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/inicio">Inicio</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/ventas">ventas</a></li>
                                                <li class="breadcrumb-item active">Registro y administración ventas</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">

                                        <a href="<?php echo base_url() ?>admin/inicio" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Regresar</span></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->
                            <!-- form start -->
                            <!-- include message block -->
                            <?php $this->load->view('admin/partials/_mesagges'); ?>

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
                        <div class="nk-block nk-block-lg">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <!-- Tabla -->
                                    <table class="datatable-init-export nowrap table" data-export-title="Export">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Categoria</th>
                                                <th>Producto Vendido</th>
                                                <th>Valor Unitario</th>
                                                <th>Cantidad</th>
                                                <th>Descuento</th>
                                                <th>Valor Total</th>
                                                <th>Fecha de venta</th>
                                                <th>Acciones</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($ventas)) : ?>
                                                <?php foreach ($ventas as $venta) : ?>
                                                    <tr>
                                                        <td> <?php echo $venta->id ?> </td>
                                                        <td>
                                                            <?php echo $venta->categoria; ?>
                                                        </td>
                                                        <td><?php echo $venta->producto_vendido; ?></td>
                                                        <td><?php echo $venta->valor_unitario; ?></td>
                                                        <td><?php echo $venta->cantidad; ?></td>
                                                        <td><?php echo $venta->descuento; ?></td>
                                                        <td><?php echo $venta->valor_total; ?></td>
                                                        <td><?php echo $venta->created; ?></td>
                                                        <td>
                                                            <div class="dropdown">
                                                                <a href="#" class="btn btn-outline-primary" data-toggle="dropdown" aria-expanded="false"><span>Seleccione</span><em class="icon ni ni-chevron-down"></em></a>
                                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-auto mt-1">
                                                                    <ul class="link-list-plain">
                                                                        <li><a onclick="editVenta(
                                                                                    '<?php echo $venta->id; ?>', 
                                                                                    '<?php echo $venta->categoria; ?>',
                                                                                    '<?php echo $venta->producto_vendido; ?>',
                                                                                    '<?php echo $venta->valor_unitario; ?>',
                                                                                    '<?php echo $venta->cantidad; ?>',
                                                                                    '<?php echo $venta->descuento; ?>',
                                                                                    '<?php echo $venta->valor_total; ?>',

                                                                                )"><em class="icon ni ni-user-alt-fill text-blue"></em> Editar</a></li>
                                                                        <li>
                                                                            <a href="javascript:void(0)" class="disabled text-danger" onclick="delete_item(
                                                                                    '<?php echo base_url(); ?>admin/ventas/delete/<?php echo html_escape($venta->id); ?>',
                                                                                    '<?php echo html_escape($venta->id); ?>',
                                                                                    'Cliente eliminado correctamente!'
                                                                                );"><em class="icon ni ni-trash-empty-fill text-danger"></em>Eliminar</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo base_url(); ?>admin/ventas-detalles/<?php echo $venta->id?>"><em class="icon ni ni-printer-fill"></em>Imprimir</a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
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
<!-- Modal Form -->
<div class="modal fade" id="modalForm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Información de venta registrada</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">

                <?php echo form_open('ventas_register_controller/change_venta_post'); ?> <!-- form -->

                <input type="hidden" name="venta_id" id="venta_id">

                <div class="form-group">
                    <label class="form-label">Categoria</label>
                    <div class="form-control-wrap">
                        <input type="text" autocomplete="off" class="form-control form-control-lg" id="categoria" name="categoria" placeholder="Categoria del producto vendido" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Producto Vendido</label>
                    <div class="form-control-wrap">
                        <input type="text" autocomplete="off" class="form-control form-control-lg" id="producto_vendido" name="producto_vendido" placeholder="Producto vendido" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Valor Unitario</label>
                    <div class="form-control-wrap">
                        <input type="number" autocomplete="off" class="form-control form-control-lg" id="valor_unitario" name="valor_unitario" placeholder="Valor unitario del producto" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Cantidad</label>
                    <div class="form-control-wrap">
                        <input type="number" autocomplete="off" class="form-control form-control-lg" id="cantidad" name="cantidad" placeholder="Cantidad" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Descuento</label>
                    <div class="form-control-wrap">
                        <input type="number" autocomplete="off" class="form-control form-control-lg" id="descuento" name="descuento" placeholder="Descuento (Si aplica)" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Valor Total</label>
                    <div class="form-control-wrap">
                        <input type="number" autocomplete="off" class="form-control form-control-lg" id="valor_total" name="valor_total" placeholder="Valor total" required readonly>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-lg btn-outline-primary">Guardar los cambios</button>
                </div>

                <?php echo form_close(); ?><!-- form end -->
            </div>
        </div>
    </div>
</div>
<!-- Modal Form end -->

<script>
    function editVenta(id, categoria, producto_vendido, valor_unitario, cantidad, descuento) {
        const modalEdit = new bootstrap.Modal(document.getElementById('modalForm'), {});
        modalEdit.show();
        document.getElementById('venta_id').value = id;
        document.getElementById('categoria').value = categoria;
        document.getElementById('producto_vendido').value = producto_vendido;
        document.getElementById('valor_unitario').value = valor_unitario;
        document.getElementById('cantidad').value = cantidad;
        document.getElementById('descuento').value = descuento;

        // Calcula el valor total automáticamente
        var valor_total = (valor_unitario * cantidad) - descuento;
        document.getElementById('valor_total').value = valor_total;

        // Agrega el evento change para calcular el valor total automáticamente
        $('#cantidad, #descuento').change(function() {
            var cantidad = $('#cantidad').val();
            var descuento = $('#descuento').val();
            var valor_unitario = $('#valor_unitario').val();

            if (cantidad && valor_unitario) {
                var valor_total = (valor_unitario * cantidad) - descuento;
                $('#valor_total').val(valor_total);
            }
        });
    }
</script>

</html>