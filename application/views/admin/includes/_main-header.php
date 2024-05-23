<?php

defined('BASEPATH') or exit('No direct script access allowed'); ?>


<div class="nk-header nk-header-fixed nk-header-fluid is-light">
    <div class="container-fluid">
        <div class="nk-header-wrap">
            <div class="nk-menu-trigger d-xl-none ml-n1">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
            </div>
            <div class="nk-header-brand d-xl-none">
                <a href="html/index.html" class="logo-link">
                    <img class="logo-light logo-img" src="<?php echo base_url(); ?>assets/images/logo.png" srcset="<?php echo base_url(); ?>assets/images/logo2x.png 2x" alt="logo">
                    <img class="logo-dark logo-img" src="<?php echo base_url(); ?>assets/images/logo-dark.png" srcset="<?php echo base_url(); ?>assets/images/logo-dark2x.png 2x" alt="logo-dark">
                </a>
            </div><!-- .nk-header-brand -->

            <div class="nk-header-tools">
                <ul class="nk-quick-nav">
                    </li><!-- .dropdown -->
                    <li class="dropdown user-dropdown">
                        <a href="#" class="dropdown-toggle mr-n1" data-toggle="dropdown">
                            <div class="user-toggle">
                                <div class="user-avatar sm">
                                    <em class="icon ni ni-user-alt"></em>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                            <div class="dropdown-inner user-card-wrap bg-lighter">
                                <div class="user-card">
                                    <?php 
                                        $re = '/\b(\w)[^\s]*\s*/m';
                                        $str = $this->session->userdata("fullname");
                                        $subst = '$1';
                                        $result = preg_replace($re, $subst, $str);
                                    ?>
                                    <div class="user-avatar">
                                        <span><?php echo $result ?></span>
                                    </div>
                                    <div class="user-info">
                                        <span class="lead-text"><?php echo $this->session->userdata("fullname") ?></span>
                                        <span class="sub-text"><?php echo $this->session->userdata("email") ?></span>
                                        <span class="badge badge-secondary"><?php echo $this->session->userdata("is_superuser") === "1" ? "Administrador" : "Usuario" ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="<?php echo base_url(); ?>admin/user-profile/<?php echo $this->session->userdata("id") ?>"><em class="icon ni ni-user-alt"></em><span>Perfil</span></a></li>
                                </ul>
                            </div>
                            <div class="dropdown-inner">
                                <ul class="link-list">
                                    <li><a href="<?php echo base_url()?>logout"><em class="icon ni ni-signout"></em><span>Salir</span></a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div><!-- .nk-header-wrap -->
    </div><!-- .container-fliud -->
</div>