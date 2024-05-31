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
                                <div class="nk-block-between">
                                    <div class="nk-block-head-content">
                                        <h3 class="nk-block-title page-title">Tablero principal de monitoreo</h3>
                                        <div class="nk-block-des text-soft">
                                          
                                        </div>
                                    </div><!-- .nk-block-head-content -->
                                </div><!-- .nk-block-between -->
                            </div><!-- .nk-block-head -->

                            <!-- bloque de dashboard -->
                            <div class="nk-block">
                                <div class="row g-gs">
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg6">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Cantidad de dispositivos</h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount"><?php echo $status->total == NULL ? '0' : $status->total ?></div>
                                                            <div class="preview-icon-wrap">
                                                                <em class="icon ni bg-blue-dim ni-cpu"></em>
                                                            </div>
                                                        </div>
                                                        <span class="text-blue">SN: <?php echo $last_device->serialnumber ?> - <?php echo $last_device->created ?></span>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div><!-- .nk-ecwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg6">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Dispositivos Online</h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount"><?php echo $status->online == NULL ? '0' : $status->online ?></div>
                                                            <div class="preview-icon-wrap">
                                                                <em class="icon ni bg-primary-dim ni-wifi"></em>
                                                            </div>
                                                        </div>
                                                        <span class="text-primary">SN: <?php echo $last_online->serialnumber ?> - <?php echo $last_online->created ?></span>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div><!-- .nk-ecwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg6">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Dispositivos Offline</h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount"><?php echo $status->offline == NULL ? '0' : $status->offline ?></div>
                                                            <div class="preview-icon-wrap">
                                                                <em class="icon ni bg-danger-dim ni-wifi-off"></em>
                                                            </div>
                                                        </div>
                                                        <span class="text-danger">SN: <?php echo $last_offline->serialnumber ?> - <?php echo $last_offline->created ?></span>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div><!-- .nk-ecwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                    <div class="col-xxl-3 col-sm-6">
                                        <div class="card">
                                            <div class="nk-ecwg nk-ecwg6">
                                                <div class="card-inner">
                                                    <div class="card-title-group">
                                                        <div class="card-title">
                                                            <h6 class="title">Dispositivos Deshabilitados</h6>
                                                        </div>
                                                    </div>
                                                    <div class="data">
                                                        <div class="data-group">
                                                            <div class="amount"><?php echo $status->deshabilitados == NULL ? '0' : $status->deshabilitados ?></div>
                                                            <div class="preview-icon-wrap">
                                                                <em class="icon ni bg-purple-dim ni-na"></em>
                                                            </div>
                                                        </div>
                                                        <span class="text-purple">SN: <?php echo $last_disable->serialnumber ?> - <?php echo $last_disable->created ?></span>
                                                    </div>
                                                </div><!-- .card-inner -->
                                            </div><!-- .nk-ecwg -->
                                        </div><!-- .card -->
                                    </div><!-- .col -->
                                </div><!-- .row -->
                            </div><!-- .nk-block -->

                            <!-- bloque de control -->
                            <div class="nk-block nk-block-lg">
                                <div class="nk-block-head wide-sm">
                                    <div class="nk-block-head-content">
                                        <h5 class="nk-block-title">Control de dispositivos</h5>
                                        <p>Controle los dispositivos registrados</p>
                                    </div>
                                </div>
                                <div class="card card-preview">
                                    <div class="card-inner">
                                        <div class="py-2">
                                            <div class="slider-init" data-slick='{"slidesToShow": 3, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'>
                                                <?php if (!empty($devices)) : ?>
                                                    <?php foreach ($devices as $device) : ?>
                                                        <div class="col">
                                                            <div class="card card-bordered pricing">
                                                                <div class="pricing-head">
                                                                    <div class="pricing-title">
                                                                        <h4 class="card-title title device">
                                                                            <em class="icon ni ni-cpu"></em><a data-original-title="<?php echo $device->name ?>" title="<?php echo $device->name ?>" href="<?php echo base_url() . 'admin/devices/view/' . get_serial64($device->serialnumber); ?>"><span class="text-primary"><?php echo $device->serialnumber ?></span>
                                                                            </a>
                                                                        </h4>
                                                                        <p class="sub-text"><?php echo $device->name ?></p>
                                                                    </div>
                                                                    <div class="card-text">
                                                                        <div class="row">
                                                                            <div class="col-6">
                                                                                <span class="h4 fw-500" id="deviceDS18B20TempCG_<?php echo $device->serialnumber ?>">-</span><span class="h4 fw-500"></span>
                                                                                <select name="variable" required>
                                                                                    <option value="1">Temperatura</option>
                                                                                    <option value="2">Humedad</option>
                                                                                    <option value="3">pH</option>
                                                                                    <option value="4">Presión</option>
                                                                                    <option value="5">Flujo de Agua</option>
                                                                                </select>
                                                                                <style>
                                                                                    select {
                                                                                        max-width: 200px;
                                                                                        width: 100%;
                                                                                        padding: 6px;
                                                                                        margin: 10px 0px 40px;
                                                                                        font-size: 0.9rem;
                                                                                        border: none;
                                                                                        text-align: center;
                                                                                        font-weight: bold;
                                                                                    }
                                                                                </style>
                                                                            </div>
                                                                            <div class="col-6">
                                                                                <span class="h4 fw-500" id="deviceDS18B20TempFG_<?php echo $device->serialnumber ?>">-</span><span class="h4 fw-500"></span>
                                                                                <select name="variable" required>
                                                                                    <option value="1">Temperatura</option>
                                                                                    <option value="2">Humedad</option>
                                                                                    <option value="3">pH</option>
                                                                                    <option value="4">Presión</option>
                                                                                    <option value="5">Flujo de Agua</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="pricing-body">
                                                                    <ul class="pricing-features">
                                                                        <li>
                                                                            <span class="w-50">Estado</span> - <span class="ml-auto">
                                                                                <?php echo $device->online ?
                                                                                    '<span class="tb-odr-status">
                                                                            <span class="badge badge-dot badge-primary">Online</span>
                                                                        </span>'
                                                                                    :
                                                                                    '<span class="tb-odr-status">
                                                                            <span class="badge badge-dot badge-danger">Offline</span>
                                                                        </span>'
                                                                                ?>
                                                                            </span>
                                                                        </li>
                                                                        <li><span class="w-50">Conexión</span> - <span class="ml-auto"><?php echo time_ago($device->lastseen); ?></span></li>
                                                                        <li><span class="w-50">Reinicios</span> - <span class="ml-auto" id="deviceRestartsG_<?php echo $device->serialnumber ?>">-</span></li>
                                                                        <li><span class="w-50">WiFi RSSI</span> - <span class="ml-auto" id="wifiRssiStatusG_<?php echo $device->serialnumber ?>">-</span>dBm</li>
                                                                        <li><span class="w-50">WiFi Signal</span> - <span class="ml-auto" id="wifiQualityG_<?php echo $device->serialnumber ?>">-</span>%</li>
                                                                        <li><span class="w-50">Temp. CPU</span> - <span class="ml-auto" id="deviceCpuTempCG_<?php echo $device->serialnumber ?>">-</span>°C</li>
                                                                        <li><span class="w-50">Act. Time</span> - <span class="ml-auto" id="deviceActiveTimeSecondsG_<?php echo $device->serialnumber ?>">-</span></li>
                                                                        <li><span class="w-50">IPv4</span> - <span class="ml-auto" id="wifiIPv4G_<?php echo $device->serialnumber ?>">-</span></li>
                                                                        <!-- <li>
                                                                            <span class="w-50">Relay 01 <em class="icon ni ni-bulb" id="icondeviceRelay1StatusG_<?php echo $device->serialnumber ?>"></em></span> - <span class="ml-auto">
                                                                                <div class="col-md-3 col-sm-6">
                                                                                    <div class="preview-block">
                                                                                        <div class="custom-control custom-switch">
                                                                                            <input type="checkbox" class="custom-control-input" id="deviceRelay1StatusG_<?php echo $device->serialnumber ?>" name="RELAY1" onchange="controlRelays(this, '<?php echo $device->serialnumber ?>')">
                                                                                            <label class="custom-control-label" for="deviceRelay1StatusG_<?php echo $device->serialnumber ?>">
                                                                                                <span class="ml-auto" id="spandeviceRelay1StatusG_<?php echo $device->serialnumber ?>">OFF</span>
                                                                                            </label>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </span>
                                                                        </li>

                                                                        <li>
                                                                            <span class="w-50">Relay 02 <em class="icon ni ni-bulb" id="icondeviceRelay2StatusG_<?php echo $device->serialnumber ?>"></em></span> - <span class="ml-auto">
                                                                                <div class="col-md-3 col-sm-6">
                                                                                    <div class="preview-block">
                                                                                        <div class="custom-control custom-switch">
                                                                                            <input type="checkbox" class="custom-control-input" id="deviceRelay2StatusG_<?php echo $device->serialnumber ?>" name="RELAY2" onchange="controlRelays(this, '<?php echo $device->serialnumber ?>')">
                                                                                            <label class="custom-control-label" for="deviceRelay2StatusG_<?php echo $device->serialnumber ?>">
                                                                                                <span class="ml-auto" id="spandeviceRelay2StatusG_<?php echo $device->serialnumber ?>">OFF</span>
                                                                                            </label>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </span>
                                                                        </li> -->

                                                                    </ul>

                                                                    <!-- <div class="pricing-action">
                                                                        <li>Dimmer al (<span class="w-50mb-2" id="spandeviceDimmerG_<?php echo $device->serialnumber ?>">0</span>)%</li>
                                                                        <div class="progress progress-lg">
                                                                            <div class="progress-bar progress-bar-striped bg-info" data-progress="0" id="deviceDimmerG_<?php echo $device->serialnumber ?>">0%</div>
                                                                        </div>
                                                                        <div class="form-group mt-3">
                                                                            <label class="form-label">Control del Dimmer %</label>
                                                                            <div class="form-control-wrap">
                                                                                <div class="form-control-slider" data-start="0" id="rangedeviceDimmerG_<?php echo $device->serialnumber ?>" onclick="controlDimmer(this, '<?php echo $device->serialnumber ?>')"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div> -->

                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <div class="col">
                                                        <div class="card card-bordered">
                                                            <div class="card-inner">
                                                                <div class="align-center flex-wrap g-4 text-center">
                                                                    <div class="nk-block-image w-120px flex-shrink-0 mx-auto">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 120 118">
                                                                            <path d="M8.916,94.745C-.318,79.153-2.164,58.569,2.382,40.578,7.155,21.69,19.045,9.451,35.162,4.32,46.609.676,58.716.331,70.456,1.845,84.683,3.68,99.57,8.694,108.892,21.408c10.03,13.679,12.071,34.71,10.747,52.054-1.173,15.359-7.441,27.489-19.231,34.494-10.689,6.351-22.92,8.733-34.715,10.331-16.181,2.192-34.195-.336-47.6-12.281A47.243,47.243,0,0,1,8.916,94.745Z" transform="translate(0 -1)" fill="#f6faff"></path>
                                                                            <rect x="18" y="32" width="84" height="50" rx="4" ry="4" fill="#fff"></rect>
                                                                            <rect x="26" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe"></rect>
                                                                            <rect x="50" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe"></rect>
                                                                            <rect x="74" y="44" width="20" height="12" rx="1" ry="1" fill="#e5effe"></rect>
                                                                            <rect x="38" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe"></rect>
                                                                            <rect x="62" y="60" width="20" height="12" rx="1" ry="1" fill="#e5effe"></rect>
                                                                            <path d="M98,32H22a5.006,5.006,0,0,0-5,5V79a5.006,5.006,0,0,0,5,5H52v8H45a2,2,0,0,0-2,2v4a2,2,0,0,0,2,2H73a2,2,0,0,0,2-2V94a2,2,0,0,0-2-2H66V84H98a5.006,5.006,0,0,0,5-5V37A5.006,5.006,0,0,0,98,32ZM73,94v4H45V94Zm-9-2H54V84H64Zm37-13a3,3,0,0,1-3,3H22a3,3,0,0,1-3-3V37a3,3,0,0,1,3-3H98a3,3,0,0,1,3,3Z" transform="translate(0 -1)" fill="#798bff"></path>
                                                                            <path d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z" transform="translate(0 -1)" fill="#6576ff"></path>
                                                                            <path d="M61.444,41H40.111L33,48.143V19.7A3.632,3.632,0,0,1,36.556,16H61.444A3.632,3.632,0,0,1,65,19.7V37.3A3.632,3.632,0,0,1,61.444,41Z" transform="translate(0 -1)" fill="none" stroke="#6576ff" stroke-miterlimit="10" stroke-width="2"></path>
                                                                            <line x1="40" y1="22" x2="57" y2="22" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                                            <line x1="40" y1="27" x2="57" y2="27" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                                            <line x1="40" y1="32" x2="50" y2="32" fill="none" stroke="#fffffe" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></line>
                                                                            <line x1="30.5" y1="87.5" x2="30.5" y2="91.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round"></line>
                                                                            <line x1="28.5" y1="89.5" x2="32.5" y2="89.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round"></line>
                                                                            <line x1="79.5" y1="22.5" x2="79.5" y2="26.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round"></line>
                                                                            <line x1="77.5" y1="24.5" x2="81.5" y2="24.5" fill="none" stroke="#9cabff" stroke-linecap="round" stroke-linejoin="round"></line>
                                                                            <circle cx="90.5" cy="97.5" r="3" fill="none" stroke="#9cabff" stroke-miterlimit="10"></circle>
                                                                            <circle cx="24" cy="23" r="2.5" fill="none" stroke="#9cabff" stroke-miterlimit="10"></circle>
                                                                        </svg>
                                                                    </div>
                                                                    <div class="nk-block-content">
                                                                        <div class="nk-block-content-head">
                                                                            <h2 class="nk-block-title fw-normal text-azure">¡No existen dispositivos!</h2>
                                                                            <p class="text-soft">Puedes registrar un dispositivo en estos momentos.</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="nk-block-content flex-shrink-0 mt-lg-4 mx-auto">
                                                                        <a href="<?php echo base_url() . 'admin/devices-add' ?>" class="btn btn-lg btn-outline-danger">¡Registra uno!</a>
                                                                    </div>
                                                                </div>
                                                            </div><!-- .card-inner -->
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- .card-preview -->
                            </div><!-- .nk-block -->

                            <!-- Bloque de tabla -->
                            <div class="nk-block">
                                <div class="card card-bordered card-stretch">
                                    <div class="card-inner-group">
                                        <div class="card-inner position-relative card-tools-toggle">
                                            <div class="card-title-group">
                                                <div class="card-tools">
                                                    <div class="form-inline flex-nowrap gx-3">
                                                        <div class="form-wrap w-450px">
                                                            <h6 class="title">Registro de los últimos eventos del sistema</h6>
                                                        </div>
                                                    </div><!-- .form-inline -->
                                                </div><!-- .card-tools -->
                                                <div class="nk-block-head-content">
                                                    <a href="<?php echo base_url() . 'admin/activity-logs?type=all'; ?>" class="btn btn-icon btn-outline-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                    <a href="<?php echo base_url() . 'admin/activity-logs?type=all'; ?>" class="btn btn-outline-primary d-none d-md-inline-flex"><em class="icon ni ni-arrow-up-right"></em><span>Ver más</span></a>
                                                </div><!-- .nk-block-head-content -->
                                            </div><!-- .card-title-group -->

                                        </div><!-- .card-inner -->
                                        <div class="card-inner p-0">
                                            <div class="nk-tb-list nk-tb-ulist">
                                                <div class="nk-tb-item nk-tb-head">
                                                    <div class="nk-tb-col"><span></span></div>
                                                    <div class="nk-tb-col tb-col-mb"><span>Descripción</span></div>
                                                    <div class="nk-tb-col tb-col-lg"><span>Fecha/Hora</span></div>
                                                    <div class="nk-tb-col tb-col-md"><span>Tipo</span></div>
                                                </div><!-- .nk-tb-item -->
                                                <?php if (!empty($activity_logs)) : ?>
                                                    <?php foreach ($activity_logs as $log) : ?>
                                                        <div class="nk-tb-item">
                                                            <!-- ID -->
                                                            <div class="nk-tb-col tb-col-mb">
                                                                <span class="tb-lead-sub"><?php echo $log->id ?></span>
                                                            </div>
                                                            <!-- Descripción -->
                                                            <div class="nk-tb-col">
                                                                <div class="user-card">
                                                                    <div class="user-info">
                                                                        <span class="tb-lead-sub"><?php echo $log->description ?> [<?php echo $log->userFullname ?>]</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-lg">
                                                                <span class="tb-date"><?php echo $log->date ?></span>
                                                            </div>
                                                            <div class="nk-tb-col tb-col-md">
                                                                <?php if ($log->type == "login") : ?>
                                                                    <span class="tb-status text-primary"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php elseif ($log->type == "disable") : ?>
                                                                    <span class="tb-status text-warning"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php elseif ($log->type == "enable") : ?>
                                                                    <span class="tb-status text-success"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php elseif ($log->type == "status") : ?>
                                                                    <span class="tb-status text-info"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php elseif ($log->type == "delete") : ?>
                                                                    <span class="tb-status text-danger"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php elseif ($log->type == "store") : ?>
                                                                    <span class="tb-status text-indigo"><?php echo $log->type ?></span>
                                                                    <span data-toggle="tooltip" title="[ <?php echo time_ago($log->date); ?> ]" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php else : ?>
                                                                    <span class="badge badge-dot badge-gray">unknown</span>
                                                                    <span data-toggle="tooltip" title="¡Evento desconocido!" data-placement="top"><em class="icon ni ni-info"></em></span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div><!-- .nk-tb-item -->
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div><!-- .card-inner -->
                                    </div><!-- .card-inner-group -->
                                </div><!-- .card -->
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

</html>