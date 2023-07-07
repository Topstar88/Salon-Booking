<?php defined('BASEPATH') OR exit('No direct script access allowed');

class REST_Controller extends CI_Controller
{
    protected $get      = [];
    protected $post     = [];
    protected $put      = [];
    protected $delete   = [];
    protected $patch    = [];

    public function __construct()
    {
        parent::__construct();

        if ($this->_check_route() === false)
        {
            $resp = [
                'result'    => RESULT_FAIL,
                'data'      => ['message' => 'The api you requested was not found.']
            ];
            return_json($resp, 404);
            return;
        }

        $http_verb = $this->_detect_http_verb();
        $this->_assign_arg($http_verb);
    }

    protected function _check_route()
    {
        $route = null;

        $routes = array_reverse($this->router->routes);

        foreach ($routes as $key => $val)
        {
            $route  = $key;
            $key    = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

            if (preg_match('#^'.$key.'$#', $this->uri->uri_string(), $matches))
            {
                break;
            }
        }

        if ( ! $route)
        {
            $route = $routes['default_route'];
        }

        $http_verb = $this->_detect_http_verb(true);

        if (is_string($routes[$route]) && $http_verb !== HTTP_VERB_GET)
        {
            return false;
        }

        $match_flag = false;

        if (is_array($routes[$route]))
        {
            foreach ($routes[$route] AS $key => $val)
            {
                $key === $http_verb AND $match_flag = true;
            }
        }

        return $match_flag;
    }

    protected function _detect_http_verb($upper = false)
    {
        $method = $this->input->method($upper);
        return $method ? $method : ($upper? strtoupper(HTTP_VERB_GET): strtolower(HTTP_VERB_GET));
    }

    protected function _assign_arg($http_verb = '')
    {
        if (empty($http_verb))
        {
            return false;
        }

        switch(strtoupper($http_verb))
        {
            case HTTP_VERB_GET:
                $this->get = $this->uri->ruri_to_assoc();
                break;

            case HTTP_VERB_POST:
                $this->post = $this->input->post();
                break;

            case HTTP_VERB_PUT:
            case HTTP_VERB_PATCH:
            case HTTP_VERB_DELETE:
                $this->{$http_verb} = $this->input->input_stream();
                break;

            default:
                break;
        }
        return true;
    }
}

class MY_Controller extends REST_Controller
{
    public $token = '';
    public $payload = [];

    public function __construct()
    {
        parent::__construct();

        $this->load->library(['jwt']);

        $this->load->helper(['security']);

        $this->split_jwt();
    }

    public function split_jwt()
    {
        $this->token = '';
        $this->payload = [];

        $http_verb  = $this->_detect_http_verb();
        $jwt        = $this->{$http_verb};

        if (empty($jwt['data']) || ! is_string($jwt['data'])) {
            return false;
        }

        $explode = explode('.', $jwt['data']);

        $this->token    = $explode[0];
        $this->payload  = empty($explode[1]) ? [] : $this->jwt->decode($explode[1]);

        return true;
    }

    public function __destruct()
    {
    }
}
/* End of file MY_Controller.php */
/* Location: /application/core/MY_Controller.php */