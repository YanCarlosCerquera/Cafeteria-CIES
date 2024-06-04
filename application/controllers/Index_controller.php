<?php defined('BASEPATH') or exit('No direct script access allowed');

class Index_controller extends Core_controller
{    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->model('Email_model');
    }

    /***
     *  Cargar la vista del index
     * */
    public function index()
	{
		$this->load->view('admin/index.php');
	}
}