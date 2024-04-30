<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<!-- Cargar Vista del Header -->
<?php $this->load->view("admin/includes/_header.php"); ?>

<body class="nk-body ui-rounder npc-default has-sidebar ">
    <div class="nk-app-root">
        <!-- Cargar Vista del Sidebar -->
        <?php $this->load->view("admin/includes/_sidebar.php"); ?>
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap ">
                <!-- main header @s -->
                <?php $this->load->view("admin/includes/_main-header.php"); ?>
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <p>Dashboard section for edit</p>
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
    <?php $this->load->view("admin/includes/_JavaScripts.php"); ?>
</body>

</html>