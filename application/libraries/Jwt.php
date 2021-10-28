<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Jwt {

    public function __construct()
    {
    }

    public function encode($data = null)
    {
        if (empty($data))
        {
            return false;
        }

        is_array($data) AND $data = json_encode($data);
        return urlencode(base64_encode($data));
    }

    public function decode($str = '')
    {
        if (empty($str) || ! is_string($str)) {
            return false;
        }
        return json_decode(urldecode(base64_decode(urldecode($str))), true);
    }
}

/* End of file Jwt.php */
/* Location: /application/libraries/Jwt.php */