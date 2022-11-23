<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class AdminModel extends CI_Model {
    
    public function login($identifier, $password, $remember = null) {
        $identifier = trim(strtolower($identifier));
        $password = trim($password);

        $res = $this->db->limit(1)->where("`fullName` = '$identifier' OR `email` = '$identifier'")->get('logintbl');

        if($res->num_rows()) {
            $user = $res->row_array();
            if($user['role'] == 1){
                if(password_verify($password, $user['password'])) {
                    if($remember) {
                        $this->config->set_item('sess_expiration', (604800 * 4));
                    }
    
                    $this->session->set_userdata(array(
                        'admin_id' => $user['id'],
                        'admin_fullName' => $user['fullName'],
                        'admin_email' => $user['email'],
                        'admin_role' => $user['role']
                    ));
                    return $user;
                }
            }
        }

        return false;
    }

    public function verifyPassword($id, $pass) {
        $this->load->database();
        $user = $this->db->select('password')->where('id', $id)->get('logintbl')->row_array();
        if($user) {
            if(password_verify($pass, $user['password']))
                return true;
        }
    
        return false;
    }

    public function updateAccount($id, $fields) {
        $this->load->database();
        if($this->db->where('id', $id)
        ->set($fields)
        ->update('logintbl'))
            return true;

        return false;
    }

    public function recreateSession() {
        if($id = $this->session->userdata('admin_id')) {
            $this->load->database();
            $user = $this->db->limit(1)->where('id', $id)->get('logintbl')->row_array();
            $this->session->set_userdata(array(
                'admin_id' => $user['id'],
                'admin_fullName' => $user['fullName'],
                'admin_email' => $user['email'],
                'admin_role' => $user['role']
            ));
            $user['disabled'] = DEMO_MODE;
            return $user;
        }

        return false;
    }

    public function adminDetails() {
        if($this->session->userdata('admin_id')) {
            return array(
                'id' => $this->session->userdata('admin_id'),
                'fullName' => $this->session->userdata('admin_fullName'),
                'email' => $this->session->userdata('admin_email'),
                'role' => $this->session->userdata('admin_role'),
                'disabled' => DEMO_MODE,
            );
        }

        return null;
    }

    public function logout() {
        $this->session->unset_userdata(array(
            'admin_id',
            'admin_fullName',
            'admin_email',
            'admin_role'
        ));

        return true;
    }
}