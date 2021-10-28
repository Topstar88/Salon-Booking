<?php

defined('BASEPATH') || exit('Access Denied.');


function is_uploaded($img, $tmp = false) {
	return ($tmp) ? file_exists($img) : file_exists($_FILES[$img]['tmp_name']);
}

function is_image($img, $mime = false) {
	$mimes = array(
		'image/png',
		'image/svg+xml',
		'image/svg',
		'image/webp',
		'image/jpeg',
		'image/gif'
	);

	return ($mime) ? in_array($img, $mimes) : in_array(mime_content_type($_FILES[$img]['tmp_name']), $mimes);
}

function generate_slug_id() {
    return strtoupper(uniqid(random_string('alpha', 3)));
}