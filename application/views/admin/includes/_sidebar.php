<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<input type="hidden" id="base_url" value="<?php echo base_url() ?>">

<input type="hidden" id="username" value="<?php echo $this->session->userdata("username") ?>">
<input type="hidden" id="mqtt_token" value="<?php echo $this->session->userdata("mqtt_token") ?>">

<input type="hidden" id="mqtt_host" value="<?php echo $this->general_settings->mqtt_host ?>">
<input type="hidden" id="mqtt_port" value="<?php echo $this->general_settings->mqtt_port ?>">
<input type="hidden" id="mqtt_protocol" value="<?php echo $this->general_settings->mqtt_protocol ?>">


<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-bar">
        <div class="nk-apps-brand">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/logo-small.png" srcset="<?php echo base_url(); ?>assets/images/logo-small2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="<?php echo base_url(); ?>assets/images/logo-dark-small.png" srcset="<?php echo base_url(); ?>assets/images/logo-dark-small2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body">
                <div class="nk-sidebar-content" data-simplebar>
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu apps-menu">
                            <li class="nk-menu-item active ">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navDashboard" data-original-title="Dashboard" title="Dashboard">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard-fill"></em></span>
                                </a>
                            </li>

                            <li class="nk-menu-hr"></li>
                            <?php if ($this->session->userdata("is_superuser") === "1") : ?>
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-switch" data-target="navComponents" data-original-title="Configuraciones" title="Configuraciones">
                                        <span class="nk-menu-icon"><em class="icon ni ni-setting-fill"></em></span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nk-sidebar-main is-light">
        <div class="nk-sidebar-inner" data-simplebar>
            <div class="nk-menu-content" data-content="navDashboard">
                <h5 class="title">IoT Tecnoparque</h5>
                <ul class="nk-menu">
                    <li class="nk-menu-item active current-page">
                        <a href="<?php echo base_url() ?>admin/dashboard" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                            <span class="nk-menu-text">Dashboard</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                    <!-- .nk-menu-item -->
                    <li class="nk-menu-item has-sub">
                        <a href="#" class="nk-menu-link nk-menu-toggle">
                            <span class="nk-menu-icon"><em class="icon ni ni-meter"></em></span>
                            <span class="nk-menu-text">Dispositivos</span>
                        </a>
                        <ul class="nk-menu-sub">
                            <li class="nk-menu-item">
                                <a href="<?php echo base_url() ?>admin/devices-add" class="nk-menu-link"><span class="nk-menu-text">Agregar</span></a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="<?php echo base_url() ?>admin/devices-list" class="nk-menu-link"><span class="nk-menu-text">Tabla</span></a>
                            </li>
                            <?php 
                             $devices = get_all_devices();
                            ?>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-toggle" data-original-title="" title=""><span class="nk-menu-text">Lista</span></a>
                                <ul class="nk-menu-sub" style="display: block;">
                                <?php if (!empty($devices)) : ?>
                                    <?php foreach ($devices as $device) : ?>
                                    <li class="nk-menu-item">
                                        <a  class="nk-menu-link" data-original-title="<?php echo $device->name ?>" title="<?php echo $device->name ?>"
                                            href="<?php echo base_url().'admin/devices/view/'.get_serial64($device->serialnumber); ?>">
                                        <span class="nk-menu-text"><?php echo $device->serialnumber ?></span>
                                        </a>
                                    </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                                </ul><!-- .nk-menu-sub -->
                            </li>
                        </ul><!-- .nk-menu-sub -->
                    </li>

                    
                    <li class="nk-menu-item has-sub">
                    <li class="nk-menu-item">
                        <a href="<?php echo base_url(); ?>admin/user-profile/<?php echo $this->session->userdata("id") ?>" class="nk-menu-link">
                            <span class="nk-menu-icon"><em class="icon ni ni-user-fill"></em></span>
                            <span class="nk-menu-text">Perfil</span>
                        </a>
                    </li><!-- .nk-menu-item -->
                    <li class="nk-menu-item">
                        <a href="<?php echo base_url(); ?>admin/activity-logs" class="nk-menu-link" data-original-title="Ver logs" title="Ver logs">
                            <span class="nk-menu-icon"><em class="icon ni ni-notes-alt"></em></span>
                            <span class="nk-menu-text">Logs</span>
                        </a>
                    </li><!-- .nk-menu-item -->

                </ul><!-- .nk-menu -->
            </div>
            <?php if ($this->session->userdata("is_superuser") === "1") : ?>
                <div class="nk-menu-content" data-content="navComponents">
                    <h5 class="title">Configuraciones</h5>
                    <ul class="nk-menu">

                        <li class="nk-menu-item">
                            <a href="<?php echo base_url() . 'admin/settings' ?>" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-opt-dot"></em></span>
                                <span class="nk-menu-text">Generales</span>
                            </a>
                        </li><!-- .nk-menu-item -->
                        <li class="nk-menu-item has-sub">
                            <a href="#" class="nk-menu-link nk-menu-toggle">
                                <span class="nk-menu-icon"><em class="icon ni ni-users-fill"></em></span>
                                <span class="nk-menu-text">Usuarios</span>
                            </a>
                            <ul class="nk-menu-sub">
                                <li class="nk-menu-item">
                                    <a href="<?php echo base_url() . 'admin/user-add' ?>" class="nk-menu-link"><span class="nk-menu-text">Agregar</span></a>
                                </li>
                                <li class="nk-menu-item">
                                    <a href="<?php echo base_url() . 'admin/users' ?>" class="nk-menu-link"><span class="nk-menu-text">Lista de Usuarios</span></a>
                                </li>
                            </ul>
                        </li>

                        <li class="nk-menu-item">
                            <a href="<?php echo base_url() . 'admin/email-settings' ?>" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-mail-fill"></em></span>
                                <span class="nk-menu-text">Correo Electronico</span>
                            </a>
                        </li>
                        <li class="nk-menu-item">
                            <a href="<?php echo base_url() . 'admin/mqtt-settings' ?>" class="nk-menu-link">
                                <span class="nk-menu-icon"><em class="icon ni ni-cloud-fill"></em></span>
                                <span class="nk-menu-text">Broker MQTT</span>
                            </a>
                        </li>
                    </ul><!-- .nk-menu -->
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>