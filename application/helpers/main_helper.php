<?php

defined('BASEPATH') || exit('Direct script access is prohibited.');

// Escape the String, Set 2nd Argument to True for Decoding.
function esc($str, $html = false) {
    if($html) return html_entity_decode($str);
    return htmlentities($str);
}

// Echo if, Substitute to Ternary Operator. However doesn't work if the Variable doesn't exist.
function echo_if($condition, $if, $else = '') {
    echo ($condition) ? $if : $else;
}

// Prints formatted arrays.
function printArray($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

// Custom show404 helper.
function show404() {
	redirect(base_url(ROUTE_404),'location', 301);
	exit;
}
function filterKeyword($keyword) {
	$keyword = strtolower($keyword);
	$keyword = str_replace('www.','',$keyword); 
	$keyword = preg_replace("/[^A-Za-z0-9.-]/", "", $keyword);
	$keyword = preg_replace("~-{2,}~", "-", $keyword);
	$keyword = preg_replace("/\.{2,}/", ".", $keyword);
	$keyword = trim($keyword,".-");
    return $keyword;
}

// Used to get the page name from current url.
function currentPage() {
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
return basename($path);
}

function currentURL() {
	return webProtocol() . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

// Used to get the content between 2 Points inside a String.
function getStringBetween($string, $start, $end) {
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

// Used to get the protocol;
function webProtocol() {
	return ((isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] === "on")) ? "https" : "http") . "://";
}

// Used to get the installation path;
function installPath() {
	return webProtocol() . $_SERVER["HTTP_HOST"] . preg_replace('{/$}', '', dirname($_SERVER['SCRIPT_NAME'])) . "/";
}

// Used to get contents of a remote url using CURL.
function getRemoteContents($url) {
	$result = false;
	$USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, $USER_AGENT);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	unset($ch);
	return $result;
}


// Used to generate a permalink from a String;
function generatePermalink($permalink) {
	$permalink=preg_replace('/[^A-Za-z0-9-]+/', '-', $permalink);
	return strtolower($permalink);
}

function securePermalink($text) {
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}

function truncate($string,$length)  {
	$string = trim(strip_tags($string));
	if (strlen($string) > $length) {
		$string = substr($string,0,$length);
	}
	return $string;
}

function getDomain($url) {
	if(preg_match("#https?://#", $url) === 0) {
		$url = webProtocol() . $url;
	}
	return strtolower(str_ireplace('www.', '', parse_url($url, PHP_URL_HOST)));
}

// Quicker alternative to echo base_url();
function anchor_to($path = '') {
	echo base_url($path);
	return true;
}

// Used to echo the urls of files inside root/application/views/admin/assets/ directory.
function admin_assets($path) {
	echo base_url('application/views/admin/assets/'.$path);
	return true;
}

// Used to echo the urls of files inside root/public/ directory.
function public_assets($path) {
	echo base_url('public/'.$path);
	return true;
}

// Used to echo the urls of files inside root/application/uploads/ directory.
function uploads($path) {
	echo base_url('application/uploads/'.$path);
	return true;
}
function date_to_ago($datetime, $full = false) {
	$now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
function compile_template($keys, $str) {
    foreach($keys as $key => $val) {
        $str = str_replace('{{'.$key.'}}', $val, $str);
    }

    return $str;
}
?>
