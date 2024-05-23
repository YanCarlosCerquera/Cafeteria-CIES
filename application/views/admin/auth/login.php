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
                                        <h4 class="nk-block-title">Inicio de sesión</h4>
                                        <div class="nk-block-des">
                                            <p>Inicia sesión para acceder al dashboard.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mensajes de error -->
                                <?php $this->load->view('admin/partials/_mesagges') ?>
                                
                                <form action="<?php echo base_url() ?>login" method="POST">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="email">Correo electrónico</label>
                                        </div>
                                        <div class="form-control-wrap">
                                            <input autocomplete="off" type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Ingresa tu Correo electrónico"
                                            required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="password">Contraseña</label>
                                            <a class="link link-primary link-sm" href="<?php echo base_url(); ?>forgot-password" tabindex="-1">¿Olvidó la contraseña?</a>
                                        </div>
                                        <div class="form-control-wrap">
                                            <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password"
                                            tabindex="-1">
                                                <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                                <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                            </a>
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña"
                                            required="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Ingresar</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Nuevo en la plataforma? <a href="<?php echo base_url()?>register">Crea tu cuenta</a>
                                </div>
                                <div class="text-center pt-4 pb-3">
                                    <h6 class="overline-title overline-title-sap"><span>O</span></h6>
                                </div>
                                <ul class="nav justify-center gx-4">
                                    <li class="nav-item"><a class="nav-link" href="#">Facebook</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#">Google</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php $this->load->view('admin/auth/includes/_footer_auth.php') ?>