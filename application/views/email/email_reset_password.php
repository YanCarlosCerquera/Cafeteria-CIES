<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Recuperar la contraseña</title>
    <style>
        /* -------------------------------------
        ESTILOS
        ------------------------------------- */
        /*! html Template */
        .nk-content {
            padding: 20px 4px;
        }

        @media (min-width: 576px) {
            .nk-content {
                padding: 24px 22px;
            }

            .nk-content-fluid {
                padding-left: 22px;
                padding-right: 22px;
            }
        }

        @media (min-width: 992px) {
            .nk-content-lg {
                padding-top: 30px;
                padding-bottom: 30px;
            }

            .nk-content-fluid {
                padding-left: 24px;
                padding-right: 24px;
            }
        }

        @media (min-width: 1200px) {
            .nk-content {
                padding: 14px 22px 24px;
            }
        }

        @media (min-width: 1660px) {
            .nk-content-lg {
                padding-top: 45px;
                padding-bottom: 45px;
            }

            .nk-content-fluid {
                padding-left: 44px;
                padding-right: 44px;
            }
        }

        .container,
        .container-fluid,
        .container-sm,
        .container-md,
        .container-lg,
        .container-xl,
        .container-xxl {
            width: 100%;
            padding-right: 14px;
            padding-left: 14px;
            margin-right: auto;
            margin-left: auto;
        }

        @media (min-width: 1280px) {
            .wide-xl {
                max-width: 1240px !important;
            }

            .wide-xl-fix {
                width: 1240px !important;
            }
        }

        .nk-content-body {
            flex-grow: 1;
        }

        .nk-content-body>.nk-block-head:first-child {
            padding-bottom: 1.25rem;
        }

        @media (min-width: 576px) {
            .nk-block-head-lg {
                padding-bottom: 2.5rem;
            }

            .nk-content-body>.nk-block-head:first-child {
                padding-bottom: 1.5rem;
            }

            .nk-block-content+.nk-block-head {
                padding-top: 4rem;
            }

            .nk-block-content+.nk-block-head-sm {
                padding-top: 2.5rem;
            }
        }

        @media (min-width: 768px) {
            .nk-content-body>.nk-block-head:first-child {
                padding-bottom: 2.5rem;
            }

            .nk-content-body>.nk-block-head-sm:first-child {
                padding-bottom: 1.75rem;
            }

            .nav-tabs+.nk-block {
                padding-top: 2.5rem;
            }

            .nav-tabs+.nk-block-sm {
                padding-top: 2rem;
            }

            .nav-tabs+.nk-block-xs {
                padding-top: 1.25rem;
            }

            .nk-block-text h5,
            .nk-block-text h6 {
                font-size: 1rem;
            }
        }

        .col-1,
        .col-2,
        .col-3,
        .col-4,
        .col-5,
        .col-6,
        .col-7,
        .col-8,
        .col-9,
        .col-10,
        .col-11,
        .col-12,
        .col,
        .col-auto,
        .col-sm-1,
        .col-sm-2,
        .col-sm-3,
        .col-sm-4,
        .col-sm-5,
        .col-sm-6,
        .col-sm-7,
        .col-sm-8,
        .col-sm-9,
        .col-sm-10,
        .col-sm-11,
        .col-sm-12,
        .col-sm,
        .col-sm-auto,
        .col-md-1,
        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-7,
        .col-md-8,
        .col-md-9,
        .col-md-10,
        .col-md-11,
        .col-md-12,
        .col-md,
        .col-md-auto,
        .col-lg-1,
        .col-lg-2,
        .col-lg-3,
        .col-lg-4,
        .col-lg-5,
        .col-lg-6,
        .col-lg-7,
        .col-lg-8,
        .col-lg-9,
        .col-lg-10,
        .col-lg-11,
        .col-lg-12,
        .col-lg,
        .col-lg-auto,
        .col-xl-1,
        .col-xl-2,
        .col-xl-3,
        .col-xl-4,
        .col-xl-5,
        .col-xl-6,
        .col-xl-7,
        .col-xl-8,
        .col-xl-9,
        .col-xl-10,
        .col-xl-11,
        .col-xl-12,
        .col-xl,
        .col-xl-auto,
        .col-xxl-1,
        .col-xxl-2,
        .col-xxl-3,
        .col-xxl-4,
        .col-xxl-5,
        .col-xxl-6,
        .col-xxl-7,
        .col-xxl-8,
        .col-xxl-9,
        .col-xxl-10,
        .col-xxl-11,
        .col-xxl-12,
        .col-xxl,
        .col-xxl-auto {
            position: relative;
            width: 100%;
            padding-right: 14px;
            padding-left: 14px;
        }

        .link-block {
            display: flex;
        }

        @media (min-width: 992px) {
            .components-preview .nk-block+.nk-block-lg {
                padding-top: 3.75rem;
            }
        }

        .nk-block+.nk-block,
        .nk-block+.nk-block-head {
            padding-top: 28px;
        }

        .nk-block+.nk-block-lg,
        .nk-block+.nk-block-head-lg {
            padding-top: 2.5rem;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, 0.125);
            border-radius: 4px;
        }

        .card-bordered {
            border: 1px solid #dbdfea;
        }

        .card-bordered.is-dark {
            border-color: #07523d;
        }

        .card-bordered.dashed {
            border-style: dashed;
        }

        .card-inner {
            padding: 1.25rem;
        }

        .card-inner-sm {
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }

        .card-inner-group .card-inner:not(:last-child) {
            border-bottom: 1px solid #dbdfea;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6 {
            margin-bottom: 0.5rem;
            font-family: Nunito, sans-serif;
            font-weight: 700;
            line-height: 1.1;
            color: #364a63;
        }

        h1,
        .h1 {
            font-size: 2rem;
        }

        h2,
        .h2 {
            font-size: 1.75rem;
        }

        h3,
        .h3 {
            font-size: 1.5rem;
        }

        h4,
        .h4 {
            font-size: 1.25rem;
        }

        h5,
        .h5 {
            font-size: 1.15rem;
        }

        h6,
        .h6 {
            font-size: 1rem;
        }

        .text-soft {
            color: #8094ae !important;
        }

        .nk-header .dropdown-menu .sub-text,
        .nk-header .dropdown-menu .overline-title,
        .nk-header .dropdown-menu .overline-title-alt {
            color: #8094ae;
        }

        .overline-title {
            font-size: 11px;
            line-height: 1.2;
            letter-spacing: 0.2em;
            color: #8094ae;
            text-transform: uppercase;
            font-weight: 700;
            font-family: Roboto, sans-serif, "Helvetica Neue", Arial, "Noto Sans",
                sans-serif;
        }

        /*! Email Template */
        .email-wraper {
            background: #f5f6fa;
            font-size: 14px;
            line-height: 22px;
            font-weight: 400;
            color: #8094ae;
            width: 100%;
        }

        .email-wraper a {
            color: #0fac81;
            word-break: break-all;
        }

        .email-wraper .link-block {
            display: block;
        }

        .email-ul {
            margin: 5px 0;
            padding: 0;
        }

        .email-ul:not(:last-child) {
            margin-bottom: 10px;
        }

        .email-ul li {
            list-style: disc;
            list-style-position: inside;
        }

        .email-ul-col2 {
            display: flex;
            flex-wrap: wrap;
        }

        .email-ul-col2 li {
            width: 50%;
            padding-right: 10px;
        }

        .email-body {
            width: 96%;
            max-width: 620px;
            margin: 0 auto;
            background: #ffffff;
        }

        .email-success {
            border-bottom: #1ee0ac;
        }

        .email-warning {
            border-bottom: #f4bd0e;
        }

        .email-btn {
            background: #0fac81;
            border-radius: 4px;
            color: #ffffff !important;
            display: inline-block;
            font-size: 13px;
            font-weight: 600;
            line-height: 44px;
            text-align: center;
            text-decoration: none;
            text-transform: uppercase;
            padding: 0 30px;
        }

        .email-btn-sm {
            line-height: 38px;
        }

        .email-header,
        .email-footer {
            width: 100%;
            max-width: 620px;
            margin: 0 auto;
        }

        .email-logo {
            height: 40px;
        }

        .email-title {
            font-size: 13px;
            color: #0fac81;
            padding-top: 12px;
        }

        .email-heading {
            font-size: 18px;
            color: #0fac81;
            font-weight: 600;
            margin: 0;
            line-height: 1.4;
        }

        .email-heading-sm {
            font-size: 24px;
            line-height: 1.4;
            margin-bottom: 0.75rem;
        }

        .email-heading-s1 {
            font-size: 20px;
            font-weight: 400;
            color: #526484;
        }

        .email-heading-s2 {
            font-size: 16px;
            color: #526484;
            font-weight: 600;
            margin: 0;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        .email-heading-s3 {
            font-size: 18px;
            color: #0fac81;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .email-heading-success {
            color: #1ee0ac;
        }

        .email-heading-warning {
            color: #f4bd0e;
        }

        .email-note {
            margin: 0;
            font-size: 13px;
            line-height: 22px;
            color: #8094ae;
        }

        .email-copyright-text {
            font-size: 13px;
        }

        .email-social li {
            display: inline-block;
            padding: 4px;
        }

        .email-social li a {
            display: inline-block;
            height: 30px;
            width: 30px;
            border-radius: 50%;
            background: #ffffff;
        }

        .email-social li a img {
            width: 30px;
        }

        @media (max-width: 480px) {
            .email-preview-page .card {
                border-radius: 0;
                margin-left: -20px;
                margin-right: -20px;
            }

            .email-ul-col2 li {
                width: 100%;
            }
        }

        .text-center {
            text-align: center !important;
        }

        .text-center .widget-title {
            justify-content: center;
        }

        .mb-4,
        .my-4 {
            margin-bottom: 1.5rem !important;
        }

        .pb-4,
        .py-4 {
            padding-bottom: 1.5rem !important;
        }

        .pt-4,
        .py-4 {
            padding-top: 1.5rem !important;
        }

        .pt-3,
        .py-3 {
            padding-top: 1rem !important;
        }

        .pr-3,
        .px-3 {
            padding-right: 1rem !important;
        }

        .pl-3,
        .px-3 {
            padding-left: 1rem !important;
        }
    </style>
</head>

<body>
    <!-- content @s -->
    <div class="nk-content nk-content-fluid">
        <div class="container-xl wide-xl">
            <div class="nk-content-inner">
                <div class="nk-content-body">
                    <div class="content-page wide-md m-auto">
                        <!-- .nk-block-head -->
                        <div class="nk-block">
                            <div class="card card-bordered">
                                <div class="card-inner">
                                    <table class="email-wraper">
                                        <tr>
                                            <td class="py-5">
                                                <table class="email-header">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center pb-4 pt-3">
                                                                <a href="#"><img class="email-logo" src="<?php echo get_logo($general_settings); ?>" alt="logo" /></a>
                                                                <h2 class="email-heading pt-4">
                                                                    SENA IoT Platform Notification
                                                                </h2>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="email-body text-center">
                                                    <tbody>
                                                        <tr>
                                                            <td class="px-3 px-sm-5 pt-4 pt-sm-5 pb-4">
                                                                <h2 class="email-heading">Cambio de contraseña</h2>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="px-3 px-sm-5 pb-2">
                                                                <p>Hola <?php echo $user ?>,</p>
                                                                <p>
                                                                    Haga clic en el botón para restablecer la contraseña de acceso al sistema.
                                                                </p>
                                                                <a href="<?php echo base_url(); ?>reset-password?token=<?php echo $token; ?>" class="email-btn">Cambiar la contraseña</a>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="px-3 px-sm-5 pt-4 pb-4 pb-sm-5">
                                                                <p>
                                                                    Si usted no hizo esta solicitud, por favor contáctenos o ignore este mensaje.
                                                                </p>
                                                                <p class="email-note">
                                                                    Este es un correo electrónico generado automáticamente <br> Por favor no responder a este email. Si usted enfrenta cualquier problema, por favor contáctenos en <br> <a href="mailto:iottecnoparque@gmail.com">iottecnoparque@gmail.comv</a>
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <table class="email-footer">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center pt-4">
                                                                <p class="email-copyright-text">
                                                                    Copyright © <?php echo Date("Y"); ?> <?php echo $settings->application_name ?>. <?php echo $settings->copyright ?>. <br />
                                                                    Template Made By
                                                                    <a href="#"><?php echo $settings->application_name ?></a>.
                                                                </p>
                                                                <ul class="email-social">
                                                                    <?php if (!empty($settings->facebook_url)) : ?>
                                                                        <li>
																			<a href="<?php echo html_escape($settings->facebook_url); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/socials/facebook.png" alt="facebook"/></a>
																		</li>
                                                                    <?php endif; ?>
                                                                    <?php if (!empty($settings->twitter_url)) : ?>
                                                                        <li>
																			<a href="<?php echo html_escape($settings->twitter_url); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/socials/twitter.png" alt="twitter"/></a>
																		</li>
                                                                    <?php endif; ?>                           
                                                                    <?php if (!empty($settings->youtube_url)) : ?>
                                                                        <li>
																			<a href="<?php echo html_escape($settings->youtube_url); ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/socials/youtube.png" alt="youtube"/></a>
																		</li>
                                                                    <?php endif; ?>				
                                                                </ul>
                                                                <p class="fs-12px pt-4">
                                                                    Este correo electrónico se le envió como usuario registrado y miembro de
                                                                    <a href="<?php echo base_url(); ?>"><?php echo base_url(); ?></a>. Para actualizar sus preferencias de correo electrónico
                                                                    <a href="<?php echo base_url(); ?>">click aquí</a>.
                                                                </p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- .nk-block -->
                    </div>
                    <!-- .content-page -->
                </div>
            </div>
        </div>
    </div>
</body>

</html>