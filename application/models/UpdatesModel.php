<?php defined('BASEPATH') || exit('Direct script access is prohibited.');

class UpdatesModel extends CI_Model {
	public function __construct() {
        parent::__construct();
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->cache_var = 'updates-info';
    }

    public function fetch_info() {
		return json_decode(getRemoteContents(DOWNLOADS_URL . '/' . PRODUCT_ID . '.json'), true);;
    }

    public function is_uploaded() {
		if(!$uploaded = $this->cache->get('is-update-uploaded')) {
            if(is_dir(APPPATH.'third_party/update')) {
                if(file_exists(APPPATH.'third_party/update/upload.zip') && file_exists(APPPATH.'third_party/update/update.json')) {
                    $uploaded = true;
                    $this->cache->save('is-update-uploaded', $uploaded);
                }
            }
        }

        return $uploaded;
    }

    public function update_info() {
        $return = array(
            'uploaded'  => false,
            'status'    => 'available'
        );
        
        if(!$info = $this->cache->get($this->cache_var)) {
            $info = $this->fetch_info();
            $this->cache->save($this->cache_var, $info);
        }

        if($info['version'] == PRODUCT_VERSION) {
            $return['status'] = 'latest';
        }

        $return['uploaded'] = $this->is_uploaded();

        return $return;
    }

    public function SplitSQL($file,$delimiter = ';') {
		$this->load->database();
		$templine = "";
		$lines = file($file);
		foreach ($lines as $line) {
			if (substr($line, 0, 2) == '--' || $line == '') {
				continue;
			}
			$templine .= $line;
			if(substr(trim($line), -1, 1) == ';') {		
				$this->db->simple_query($templine);
				$templine = '';
			}
		}
	}
	
	public function hostName() {
		$url = webProtocol().$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
		$components = parse_url($url);
		return str_replace("www.","",$components["host"]);
	}
	
	public function update_db_details($host,$username,$password,$database) {
		$sampleFile = file_get_contents(APPPATH."config/database.php");
		$sampleFile = str_replace("{{server}}",$host,$sampleFile);
		$sampleFile = str_replace("{{username}}",$username,$sampleFile);
		$sampleFile = str_replace("{{password}}",$password,$sampleFile);
		$sampleFile = str_replace("{{database}}",$database,$sampleFile);
		file_put_contents(APPPATH."config/database.php",$sampleFile);
	}
	
	public function paste_config_details($base_url) {
		$sampleFile = file_get_contents(APPPATH."config/config.php");
		$sampleFile = str_replace("{{base_url}}",$base_url,$sampleFile);
		file_put_contents(APPPATH."config/config.php",$sampleFile);
	}
	
	public function paste_db_details() {
		if(file_exists(APPPATH."views/install/includes/sql/update.sql")) {
		$this->SplitSQL(APPPATH."views/install/includes/sql/update.sql");
			return true;
		} else {
			return false;
		}
	}
}