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
                            <div class="nk-block-head">
                                <div class="nk-block-between g-3">
                                    <div class="nk-block-head-content">
                                    <h3 class="nk-block-title page-title">Detalle de venta <strong class="text-primary small">Venta #<?php echo $detalle_venta->id; ?></strong></h3>
                                        <div class="nk-block-des text-soft">
                                            <ul class="list-inline">
                                                <li>Fecha de venta: <span class="text-base"><?php echo $detalle_venta->created; ?></span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="html/invoice-list.html" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Back</span></a>
                                        <a href="html/invoice-list.html" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->

                            <div class="nk-block">
                                <div class="invoice">
                                    <div class="invoice-action">
                                        <a class="btn btn-icon btn-lg btn-white btn-dim btn-outline-primary" href="html/invoice-print.html" target="_blank"><em class="icon ni ni-printer-fill"></em></a>
                                    </div><!-- .invoice-actions -->
                                    <div class="invoice-wrap">
                                        <div class="invoice-brand text-center">
                                            <img src="./images/logo-dark.png" srcset="./images/logo-dark2x.png 2x" alt="">
                                        </div>
                                        <div class="invoice-head">
                                            <div class="invoice-contact">
                                                <span class="overline-title">Cliente</span>
                                                <div class="invoice-contact-info">
                                                    <h4 class="title"><?php echo $detalle_venta->nombre_cliente; ?></h4>
                                                    <ul class="list-plain">
                                                        <li><em class="icon ni ni-map-pin-fill"></em><span>Lugar de compra<br> Centro de la empresa, la Industria y los Servicios</span></li>
                                                        <li><em class="icon ni ni-mail-fill"></em><span><?php echo $detalle_venta->correo_cliente; ?></span></li>
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
                                                            <th class="w-20">Categoria</th>
                                                            <th>Producto vendido</th>
                                                            <th>Valor Unitario</th>
                                                            <th>Cantidad</th>
                                                            <th>Descuento</th>
                                                            <th>Valor Total</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>24108054</td>
                                                            <td>Dashlite - Conceptual App Dashboard - Regular License</td>
                                                            <td>$40.00</td>
                                                            <td>5</td>
                                                            <td>$200.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>24108054</td>
                                                            <td>6 months premium support</td>
                                                            <td>$25.00</td>
                                                            <td>1</td>
                                                            <td>$25.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td>23604094</td>
                                                            <td>Invest Management Dashboard - Regular License</td>
                                                            <td>$131.25</td>
                                                            <td>1</td>
                                                            <td>$131.25</td>
                                                        </tr>
                                                        <tr>
                                                            <td>23604094</td>
                                                            <td>6 months premium support</td>
                                                            <td>$78.75</td>
                                                            <td>1</td>
                                                            <td>$78.75</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td colspan="2">Subtotal</td>
                                                            <td>$435.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td colspan="2">Processing fee</td>
                                                            <td>$10.00</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td colspan="2">TAX</td>
                                                            <td>$43.50</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"></td>
                                                            <td colspan="2">Grand Total</td>
                                                            <td>$478.50</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div><!-- .invoice-bills -->
                                    </div><!-- .invoice-wrap -->
                                </div><!-- .invoice -->
                            </div><!-- .nk-block -->
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

</html>