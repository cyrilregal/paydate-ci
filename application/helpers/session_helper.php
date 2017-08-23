<?php

/**
 * Check if user session is connected
 * @return bool
 */
function testUserSession() {
	$CI = &get_instance();
	return (bool)$CI->session->userdata('isUserConnected');
}

/**
 * Check if admin session is connected
 * @return bool
 */
function testAdminSession() {
	$CI = &get_instance();
	return (bool)$CI->session->userdata('isAdminConnected');
}

function testAllSession() {
	$CI = &get_instance();
	return ((bool)$CI->session->userdata('isAdminConnected') === true OR (bool)$CI->session->userdata('isUserConnected') === true);
}