<?php
class InstallModel extends CI_Model {
	
	public function decode_array() {
		$data = file_get_contents(APPPATH . "config/setup.php");
		$data = getStringBetween($data,'<?php $setup ="','";?>');
		return str_rot13(base64_decode($data));
	}

	public function encode_array($data) {
		$data = '<?php $setup ="' . base64_encode(str_rot13(json_encode($data))) . '";?>';
		file_put_contents(APPPATH . "config/setup.php",$data);
		return true;
	}
	
	public function calculate_checksum() {
		$data = file_get_contents(APPPATH . "config/setup.php");
		return sha1($data);
	}
	
	public function hostName() {
		$url = webProtocol().$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		$components = parse_url($url);
		return str_replace("www.","",$components["host"]);
	}
	
	public function SplitSQL($host,$username,$password,$database,$file,$delimiter = ';') {
		$mysqli = @new mysqli($host, $username, $password, $database);
		$templine = "";
		$lines = file($file);
		foreach ($lines as $line) {
			if (substr($line, 0, 2) == '--' || $line == '') {
				continue;
			}
			$templine .= $line;
			if(substr(trim($line), -1, 1) == ';')	{		
				$mysqli->query($templine) or die($mysqli->error);
				$templine = '';
			}
		}
	}
	public function verify_db_details($host,$username,$password,$database) {
		$mysqli = @new mysqli($host, $username, $password, $database);
		if($mysqli->connect_error) {
			return false;
		} else {
			return true;
		}
	}
	
	public function baseUrlGen($base_url) {
	return rtrim(strtolower($base_url),"/")."/";
	}
	
	public function paste_config_details($base_url,$title,$email,$username,$password) {
		$version = json_decode(file_get_contents(APPPATH."views/install/includes/version.php"),true)['version'];
		$sampleFile = file_get_contents(APPPATH."views/install/includes/config.php");
		$sampleFile = str_replace("{{base_url}}",$this->baseUrlGen($base_url),$sampleFile);
		$sampleFile = str_replace("{{encryption_key}}",md5(uniqid()),$sampleFile);
		file_put_contents(APPPATH."config/config.php",$sampleFile);
		$this->load->database();
		
		$this->db->insert("logintbl", array(
			'fullName' => $username,
			'email'	   => $email,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role'	   => 1,
		));
		
		// Update Title and General Settings
		$this->db->where("id",1);
		$this->db->set("title",$title);
		$this->db->update("general-settings");
		
		// Update SMTP E-mail
		$this->db->where("id",1);
		$this->db->set("email",$email);
		$this->db->update("smtp-settings");
	}
	
	
	public function paste_db_details($host,$username,$password,$database) {
		if(file_exists(APPPATH."views/install/includes/sql/latest.sql")) {
		$sampleFile = file_get_contents(APPPATH."views/install/includes/database.php");
		$sampleFile = str_replace("{{server}}",$host,$sampleFile);
		$sampleFile = str_replace("{{username}}",$username,$sampleFile);
		$sampleFile = str_replace("{{password}}",$password,$sampleFile);
		$sampleFile = str_replace("{{database}}",$database,$sampleFile);
		file_put_contents(APPPATH."config/database.php",$sampleFile);
		$this->SplitSQL($host,$username,$password,$database,APPPATH."views/install/includes/sql/latest.sql",$delimiter = ';');
		return true;
		} else {
		return false;
		}
	}
}
?>