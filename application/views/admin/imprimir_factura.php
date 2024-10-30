<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php $this->load->view("admin/includes/_header"); ?>

<body class="bg-white" onload="printPromot()">
    <div class="nk-block">
        <div class="invoice invoice-print">
            <div class="invoice-wrap">
                <div class="invoice-brand text-center">
                    <img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/logo-dark-small.png" srcset="<?php echo base_url(); ?>assets/images/logo-small2x.png 2x" alt="logo">
                </div>
                <div class="invoice-head">
                    <div class="invoice-contact">
                        <span class="overline-title">Cliente</span>
                        <div class="invoice-contact-info">
                            <h4 class="title"><?php echo $detalle_venta->nombre_cliente; ?></h4>
                            <ul class="list-plain">
                                <li><em class="icon ni ni-map-pin-fill fs-18px"></em><span>Lugar de compra<br> Centro de la empresa, la Industria y los Servicios</span></li>
                                <li><em class="icon ni ni-mail-fill fs-14px"></em><span><?php echo $detalle_venta->correo_cliente; ?></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="invoice-desc">
                        <h3 class="title">Venta</h3>
                        <ul class="list-plain">
                            <li class="invoice-id"><span>Venta ID</span>:<span><?php echo $detalle_venta->id; ?></span></li>
                            <li class="invoice-date"><span>Fecha de venta</span>:<span><?php echo $detalle_venta->created; ?></span></li>
                        </ul>
                    </div>
                </div><!-- .invoice-head -->
                <div class="invoice-bills">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-20">Producto</th>
                                    <th>Valor Unitario</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $productos_vendidos = json_decode($detalle_venta->productos_vendidos, true);
                                foreach ($productos_vendidos as $producto) {
                                ?>
                                    <tr>
                                        <td><?php echo $producto['producto']; ?></td>
                                        <td><?php echo $producto['valor_unitario']; ?></td>
                                        <td><?php echo $producto['cantidad']; ?></td>
                                        <td><?php echo $producto['subtotal']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3">Descuento</td>
                                    <td><?php echo $detalle_venta->descuento; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="3">Valor Total</td>
                                    <td><?php echo $detalle_venta->valor_total; ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div><!-- .invoice-bills -->
            </div><!-- .invoice-wrap -->
        </div><!-- .invoice -->
    </div><!-- .nk-block -->
    <script>
        function printPromot() {
            window.print();
        }
    </script>
</body>
<!-- content @e -->

<!-- app-root @e -->
<!-- JavaScript -->
<?php $this->load->view("admin/includes/_JavaScripts"); ?>
</body>

</html>