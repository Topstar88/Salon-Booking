<?php 

class LoginModel extends CI_Model{

    public function addUser($array){
        $query = $this->db->insert('logintbl', $array);
        $userId = $this->db->insert_id();
		return array(
			"return" => $query,
			"userId" => $userId
		);
    }
    public function addUserPhone($id, $phoneNumber){
        $res = $this->db->where('id', $id)->set('phone', $phoneNumber)->update('logintbl');
        return $res;
    }
    public function isValidate($email, $password){
        $query = $this->db->limit(1)->where("`fullName` = '$email' OR `email` = '$email'")->get('logintbl');

        if ($query->num_rows()) {
            if($query->row()->activated == '1' && $query->row()->verifiedEmail == '1'){
                if(password_verify($password, $query->row()->password)){
                    return array(
                        "activation"    => true,
                        "id"            => $query->row()->id
                    );
                }
                else{
                    return array(
                        "activation"    => true,
                        "id"            => false
                    );
                }
                return array(
                    "activation" => true
                );
            }
            else{
                return array(
                    "activation" => false
                );
            }
        }
        return false;
    }

    public function activate($code) {
        $return = array();

        $query = $this->db->get_where('logintbl', array("activationCode" => $code));
        $row = $query->row();
        if(isset($row)) {
            $query = $this->db->update("logintbl", array("activated" => "1", "verifiedEmail" => "1"), array("id" => $row->id));
            return true;
        } else {
            return false;
        }
    }
    
    public function validateSession($loginSession){
        $query = $this->db->get_where('logintbl', array('id'=> $loginSession));
        if($query->num_rows()){
            return $query->row()->id;
        }
        else{
            return FALSE;
        }
    }

    public function get_id_by_email($email) {
        $email = trim(strtolower($email));
        
        $res = $this->db->select('id')->limit(1)->where('email', $email)->get('logintbl');
        if($res->num_rows()) {
            return $res->row_array()['id'];
        }

        return false;
    }

    public function do_social_login($email, $photoURL, $mode = null, $image = '') {
        $id = $this->get_id_by_email($email);
        if($id) {
            $this->db->where('id', $id)->set(array($mode => true, 'activated' => true, 'verifiedEmail' => true, 'photoURL' => $photoURL))->update('logintbl');
            return array(
                'nlg'   => false,
                'userId' => $id
            );
        } else {
            $this->load->helper('string');
            $randomStr =  random_string('alnum',12);
            $hashForUser = password_hash($randomStr, PASSWORD_DEFAULT);
            

            $new_user = array(
                'fullName'      => trim(strtolower(explode('@', $email)[0])),
                'email'         => trim(strtolower($email)),
                'password'      => $hashForUser,
                'verifiedEmail' => true,
                'activated'     => true,
                'image'         => $image,
                'photoURL'      => $photoURL,
                $mode           => true,
            );

            if($this->db->insert('logintbl', $new_user)) { 
                $new_user['userId']     = $this->db->insert_id();
                $new_user['randomStr']  = $randomStr;
                $new_user['nlg']        = true;
                return $new_user;
            }
        }

        return false;
    }

    public function user_info($id){
        $res = $this->db->get_where('logintbl', array('id' => $id));
		if($res->num_rows()) {
            return $res->row_array();
        }
        else{
            return false;
        }
    }

    public function set_new_avatar($filename, $id) {
        $res = $this->db->where('id', $id)->set('image', $filename)->update('logintbl');
        return $res;
    }
    public function set_new_fullname($fullname, $id) {
        $res = $this->db->where('id', $id)->set('fullName', trim(strtolower($fullname)))->update('logintbl');
        return $res;
    }

    public function verify_password($password) {
        $this->load->database();
        $res = $this->db->select('password')->where('id', $this->session->userdata('id'))->get('logintbl');
        if($res->num_rows()) {
            return password_verify($password, $res->row_array()['password']);
        }

        return false;
    }

    public function set_new_password($password) {
        $this->load->database();
        $res = $this->db->where('id', $this->session->userdata('id'))->set('password', password_hash(trim($password), PASSWORD_DEFAULT))->update('logintbl');
        
        return $res;
    }

    public function total_registrations() {
        return $this->db->where('role = 0')->get('logintbl')->num_rows();
    }

    public function recent_registrations($num) {
        return $this->db->order_by('id', 'desc')->where('role', 0)->limit($num)->get('logintbl')->result_array();
    }
    
    public function weekly_registrations() {
        return $this->db->where('YEARWEEK(`register_date`) = YEARWEEK(NOW())')->get('logintbl')->num_rows();
    }
    public function sendActivation($email, $randomStr, $activationcode, $smtpDetails) {
        // Send by Email
        $config = Array(
            'charset' 	=> 'iso-8859-1',
            'wordwrap' 	=> TRUE,
            'mailtype' 	=> 'html',
            'newline' 	=> "\r\n",
        );
        // Send by SMTP Details
        if($smtpDetails['status'] == 1){
            $config['protocol']  = 'smtp';
            $config['smtp_host'] = $smtpDetails['host'];
            $config['smtp_port'] = $smtpDetails['port'];
            $config['smtp_user'] = $smtpDetails['username'];
            $config['smtp_pass'] = $smtpDetails['password'];
        }
        $this->load->library('email', $config);
        $this->email->from($smtpDetails['email'],'Salon Script');
        $this->email->to($email);
        $this->email->subject('Salon Activation');
        $this->email->message('<div style="padding:25px;border-radius:5px;background-color:#fff;max-width:500px;margin:30px auto;border: #343a40 1px solid;"><h1 style="font-size: 40px;text-align: center;line-height: initial;font-weight: 700;margin: 0 0 0;">Activate your Account</h1><p class="loginSignupSubTitle" style="font-size: 15px;line-height: 25px;margin: 10px 0 5px;text-align: center;color: #343a40;font-weight: 400;">Click on Activate Now Button for activation. After activate your account you can login with this PASSWORD: '.$randomStr.'</p><a href="'.base_url('login/activate/'.$activationcode).'" target="_blank" style="text-align:center;font-size:21px;line-height:40px;margin-top:20px;display:block;padding:.375rem 0;border-radius:.25rem;background-color: #343a40;border-color: #343a40;color: #fff;text-decoration: none;">Activate Now</a></div>');
        $sendEmail = $this->email->send();
        return $sendEmail;
    }

    public function isValidEmail($email){
        $res = $this->db->limit(1)->where('email', $email)->get('logintbl');
        if ($res->num_rows()) {
            return true;
        }
        return false;
    }
    public function updatePassword($id, $password){
        $res = $this->db->where('id', $id)->set('password', $password)->update('logintbl');
        return $res;
    }
}

?>