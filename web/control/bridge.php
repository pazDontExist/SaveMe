<?php

function __autoload($class_name) {
    include_once(SITE_PATH . DS . 'class' . DS . $class_name . '.class.php');
}

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$sec_login = new sec_login();
$sec_login->sec_session_start();