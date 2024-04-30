<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

class admin_controller extends CI_Controller
{   
    public function __construct()
    {
        parent::__construct();
        if (!is_user()) {
            redirect(base_url());
        }
    }

    public function index(){
        $this->load->view("admin/dashboard");
    }

}