<?php defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CI_Model
{
    //get general settings
    public function get_general_settings()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('general_settings');
        return $query->row();
    }
    //get settings
    public function get_settings()
    {
        $this->db->where('id', 1);
        $query = $this->db->get('settings');
        return $query->row();
    }
    
}

