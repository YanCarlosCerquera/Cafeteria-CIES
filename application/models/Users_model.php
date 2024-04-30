<?php defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model{
    //Consulta a la BD del usuario por correo y contraseña.
    public function login($email, $password){
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', "1");
        $res = $this->db->get("mqtt_user");

        if ($res->num_rows() > 0) {
            return $res->row();
        } else {
            return false;
        }
    }
    //update last_seen
    public function update_last_seen($id)
    {
        $data['last_seen'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id);
        return $this->db->update('mqtt_user', $data);
    }
    // nombre completo del usuario BD
    public function get_user_fullname($id)
    {
        $this->db->where('id', $id);
        $user = $this->db->select('fullname')->from('mqtt_user')->get()->row();
        return html_escape($user->fullname);
    }
    // username del usuario logeado sesión
    public function get_user_username()
    {
        return $this->session->userdata('username');
    }
    // id del usuario logeado sesión
    public function get_user_id()
    {
        return $this->session->userdata('id');
    }
    // Es Usuario
    public function is_user()
    {
        // verificar si esta logueado
        if (!$this->is_logged_in()) {
            return false;
        }
        return true;
    }
     //verificar si esta logueado
     public function is_logged_in()
     {
         $user = $this->get_logged_user();
         // verificar si esta logueado
         if ($this->session->userdata('login') == true && !empty($user)) {
             if ($user->status == 0) {
                 $this->logout();
                 return false;
             } else {
                 return true;
             }
         } else {
             $this->logout();
             return false;
         }
     }
     // capturar el usuario de la base de datos con el id del usuario logeado
    public function get_logged_user()
    {
        if ($this->session->userdata('login') == true) {
            $query = $this->db->get_where('mqtt_user', array('id' => $this->get_user_id()));
            return $query->row();
        }
    }
    // Salir limpiar sesión
    public function logout()
    {
        // eliminar la data de sessión
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('mqtt_token');
        $this->session->unset_userdata('user_token');
        $this->session->unset_userdata('fullname');
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('photo');
        $this->session->unset_userdata('is_superuser');
        $this->session->unset_userdata('login');
    }
    //Formulario de registro
    public function input_values()
    {
        $data = array(
            'fullname' => remove_forbidden_characters($this->input->post('fullname', true)),
            'username' => str_username(remove_forbidden_characters($this->input->post('username', true))),
            'email' => remove_forbidden_characters($this->input->post('email', true)),
            'password' => $this->input->post('password', true),
        );
        return $data;
    }
    //check if username is unique
    public function is_unique_username($username, $user_id = 0)
    {
        $user = $this->get_user_by_username($username);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //username taken
                return false;
            } else {
                return true;
            }
        }
    }
    //get user by username
    public function get_user_by_username($username)
    {
        $this->db->select('id, telegram_enable_send, email_enable_send, telegram_ChatId');
        $this->db->where('username', $username);
        $query = $this->db->get('mqtt_user');
        return $query->row();
    }
    //check if email is unique
    public function is_unique_email($email, $user_id = 0)
    {
        $user = $this->get_user_by_email($email);

        //if id doesnt exists
        if ($user_id == 0) {
            if (empty($user)) {
                return true;
            } else {
                return false;
            }
        }

        if ($user_id != 0) {
            if (!empty($user) && $user->id != $user_id) {
                //email taken
                return false;
            } else {
                return true;
            }
        }
    }
    //get user by email
    public function get_user_by_email($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('mqtt_user');
        return $query->row();
    }
    // add user
    public function add_user()
    {
        $data = $this->Users_model->input_values(); // capturado los inputs
        $data['is_superuser'] = $this->input->post('role', true) == NULL ? 0 : $this->input->post('role', true); //cuando se registre un usuario desde el panel de super_usuario
        // Secure password for EMQX
        $data['password'] = hash('sha256', $data['password'], FALSE); // redefinir la contraseña
        $data['token'] = generate_unique_id();
        $data['slug'] = $this->generate_uniqe_slug($data["fullname"]);
        $data['last_seen'] = date('Y-m-d H:i:s');
        $data["created"] = date('Y-m-d H:i:s');

        return $this->db->insert('mqtt_user', $data);
    }
    //generate uniqe slug
    public function generate_uniqe_slug($username)
    {
        $slug = str_slug($username);
        if (!empty($this->get_user_by_slug($slug))) {
            $slug = str_slug($username . "-1");
            if (!empty($this->get_user_by_slug($slug))) {
                $slug = str_slug($username . "-2");
                if (!empty($this->get_user_by_slug($slug))) {
                    $slug = str_slug($username . "-3");
                    if (!empty($this->get_user_by_slug($slug))) {
                        $slug = str_slug($username . "-" . uniqid());
                    }
                }
            }
        }
        return $slug;
    }
    //get user by slug
    public function get_user_by_slug($slug)
    {
        $query = $this->db->get_where('mqtt_user', array('slug' => $slug));
        return $query->row();
    }

}