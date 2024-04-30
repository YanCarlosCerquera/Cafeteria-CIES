<?php

defined('BASEPATH') or exit('No direct script access allowed');

//check user
if (!function_exists('is_user')) {
    function is_user()
    {
        // Get a reference to the controller object
        $ci = &get_instance();
        $ci->load->model('users_model');
        return $ci->users_model->is_user();
    }
}

//remove forbidden characters
if (!function_exists('remove_forbidden_characters')) {
    function remove_forbidden_characters($str)
    {
        $str = str_replace(';', '', $str);
        $str = str_replace(',', '', $str);
        $str = str_replace('"', '', $str);
        $str = str_replace('$', '', $str);
        $str = str_replace('%', '', $str);
        $str = str_replace('&', '', $str);
        $str = str_replace('#', '', $str);
        $str = str_replace('*', '', $str);
        $str = str_replace('/', '', $str);
        $str = str_replace('\'', '', $str);
        $str = str_replace('<', '', $str);
        $str = str_replace('>', '', $str);
        $str = str_replace('=', '', $str);
        $str = str_replace('?', '', $str);
        $str = str_replace('[', '', $str);
        $str = str_replace(']', '', $str);
        $str = str_replace('\\', '', $str);
        $str = str_replace('^', '', $str);
        $str = str_replace('`', '', $str);
        $str = str_replace('{', '', $str);
        $str = str_replace('}', '', $str);
        $str = str_replace('|', '', $str);
        $str = str_replace('~', '', $str);
        return $str;
    }
}

// Generar el username de MQTT usuario uno | usuariouno
if (!function_exists('str_username')) {
    function str_username($str)
    {
        return str_replace(' ', '', $str);
    }
}
//generate unique id
if (!function_exists('generate_unique_id')) {
    function generate_unique_id()
    {
        $id = uniqid("", TRUE);
        $id = str_replace(".", "-", $id);
        return $id . "-" . rand(10000000, 99999999);
    }
}
//generate slug
if (!function_exists('str_slug')) {
    function str_slug($str)
    {
        return url_title(convert_accented_characters($str), "-", true);
    }
}
//print old form data
if (!function_exists('old')) {
    function old($field)
    {
        $ci = &get_instance();
        if (isset($ci->session->flashdata('form_data')[$field])) {
            return html_escape($ci->session->flashdata('form_data')[$field]);
        }
    }
}