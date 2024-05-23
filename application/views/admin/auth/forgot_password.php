<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Cargar Vista del Header -->
<?php $this->load->view("admin/auth/includes/_header_auth.php"); ?>

<body class="nk-body ui-rounder npc-default pg-auth">

    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="<?php echo base_url();?>" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url(); ?>assets/images/logo.png" srcset="<?php echo base_url(); ?>assets/images/logo2x.png 2x" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url(); ?>assets/images/logo-dark.png" srcset="<?php echo base_url(); ?>assets/images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>

                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Recuperar contraseña</h5>
                                        <div class="nk-block-des">
                                            <p>Si olvidó su contraseña, se le enviará un correo electrónico con las instrucciones para restablecer su contraseña.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mensajes de error -->
                                <?php $this->load->view('admin/partials/_mesagges') ?>

                                <?php echo form_open('auth_controller/forgot_password_post'); ?>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Correo electrónico</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input autocomplete="off" type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Correo electrónico"
                                            required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-lg btn-outline-primary btn-block">Enviar Link de recuperación</button>
                                    </div>
                                <?php echo form_close(); ?>
                                <div class="form-note-s2 text-center pt-4">
                                    <a href="<?php echo base_url(); ?>"><strong>Regresar al login</strong></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php $this->load->view('admin/auth/includes/_footer_auth.php') ?>