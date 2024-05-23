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
                                        <h3 class="nk-block-title page-title">Dispositivos | <strong class="text-primary small">Registro</strong></h3>
                                        <div class="nk-block-des text-soft d-none d-md-inline-flex">
                                            <ul class="breadcrumb breadcrumb-pipe">
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/dashboard">Inicio</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>admin/devices-list">Dispositivos</a></li>
                                                <li class="breadcrumb-item active">Registrar un nuevo dispositivo</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="nk-block-head-content">
                                        <a href="<?php echo base_url() ?>" class="btn btn-outline-light bg-white d-none d-sm-inline-flex"><em class="icon ni ni-arrow-left"></em><span>Regresar</span></a>
                                        <a href="<?php echo base_url() ?>" class="btn btn-icon btn-outline-light bg-white d-inline-flex d-sm-none"><em class="icon ni ni-arrow-left"></em></a>
                                    </div>
                                </div>
                            </div><!-- .nk-block-head -->

                            <div class="nk-block">

                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Información del nuevo dispositivo</h4>
                                        <div class="nk-block-des">
                                            <strong class="text-dark">Nota:</strong> Agregue información común como nombre, número de serie, etc.
                                        </div>
                                    </div>
                                </div>

                                <div class="card card-bordered">
                                    <div class="card-inner-group">
                                        <div class="card-inner">

                                            <!-- include message block -->
                                            <?php $this->load->view('admin/partials/_mesagges'); ?>

                                            <div class="nk-block">
                                                <form action="<?php echo base_url(); ?>admin/devices-store" method="post">

                                                    <div class="row g-3 align-center">
                                                        <div class="col-lg-3 offset-0">
                                                            <div class="form-group">
                                                                <label class="form-label">Nombre identificativo</label>
                                                                <span class="form-note">Nombre identificativo para el dispositivo</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input type="text" autocomplete="off" class="form-control" id="name" name="name" placeholder="Nombre identificativo" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 align-center">
                                                        <div class="col-lg-3 offset-0">
                                                            <div class="form-group">
                                                                <label class="form-label" id="serialLabel">Número de Serie</label>
                                                                <span class="form-note">Número de serie único del dispositivo E.g. (000000001)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap"> <!-- focus OK | error Error -->
                                                                    <input type="text" autocomplete="off" class="form-control" id="serialnumber" name="serialnumber" placeholder="Número de Serie" onblur="isValidSerialId(this)" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 align-center">
                                                        <div class="col-lg-3 offset-0">
                                                            <div class="form-group">
                                                                <label class="form-label">Tipo de dispositivo</label>
                                                                <span class="form-note">Seleccione el tipo de dispositivo</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <select class="form-select" data-placeholder="Seleccione el tipo de dispositivo" id="type" name="type">
                                                                        <option value="">-</option>
                                                                        <option value="0">Genérico</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row g-3 align-center">
                                                        <div class="col-lg-3 offset-0">
                                                            <div class="form-group">
                                                                <label class="form-label">Dirección de instalación</label>
                                                                <span class="form-note">Dirección referencial de la instalación (Opcional)</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-7">
                                                            <div class="form-group">
                                                                <div class="form-control-wrap">
                                                                    <input type="text" autocomplete="off" class="form-control" id="address" name="address" placeholder="Dirección de instalación">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row gy-4">
                                                        <!--col-->
                                                        <div class="col-12 mt-3">
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-outline-primary" id="button">Registra el dispositivo</button>
                                                            </div>
                                                        </div>
                                                        <!--col-->
                                                    </div>
                                                    <!--row-->
                                                    
                                                </form>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div>
                                </div><!-- .card -->
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