<?php

defined('BASEPATH') or exit('No direct script access allowed');

// almacenar logs de actividad
function log_activity($description, $type = 'unknow', $deviceid = null, $userid = null)
{
    $CI = &get_instance();

    $log = [
        'description' => $description,
        'date'        => date('Y-m-d H:i:s'),
        'type'        => $type,
        'deviceId'    => $deviceid,
    ];

    if ($userId != null && is_numeric($userId)) {
        $log['userFullname'] = $CI->Users_model->get_user_fullname($userId);
        $log['userId'] = $userId;
    } else {
        $log['userFullname'] = $CI->Users_model->get_user_username();
        $log['userId'] = $CI->Users_model->get_user_id();
    }

    $CI->db->insert('activity_log', $log);
}