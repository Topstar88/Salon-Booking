<?php defined('BASEPATH') OR exit('No direct script access allowed');

function esc($str, $html = false) {
    if($html) return html_entity_decode($str);
    return htmlentities($str);
}

function echo_if($condition, $if, $else = '') {
    echo ($condition) ? $if : $else;
}

function admin_url($path) {
    return base_url(ADMIN_ROUTE.'/'.$path);
}

function printArray($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

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

function currentPage() {
$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
return basename($path);
}

function getStringBetween($string, $start, $end) {
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function webProtocol() {
	return ((isset($_SERVER["HTTPS"]) && ($_SERVER["HTTPS"] === "on")) ? "https" : "http") . "://";
}

function installPath() {
	return webProtocol() . $_SERVER["HTTP_HOST"] . preg_replace('{/$}', '', dirname($_SERVER['SCRIPT_NAME'])) . "/";
}

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

function generatePermalink($permalink) {
	$permalink=preg_replace('/[^A-Za-z0-9-]+/', '-', $permalink);
	return strtolower($permalink);
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

function anchor_to($path = '') {
	echo base_url($path);
	return true;
}

function admin_assets($path) {
	echo base_url('application/views/admin/assets/'.$path);
	return true;
}

function public_assets($path) {
	echo base_url('public/'.$path);
	return true;
}

function uploads($path) {
	echo base_url('application/uploads/'.$path);
	return true;
}
?>
