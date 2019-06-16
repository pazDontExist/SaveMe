<?php

require_once(SITE_PATH . DS . 'bridge.php');
$hero = new hero();
$request = $_SERVER['QUERY_STRING'];
$parsed = explode('&', $request);
$page = array_shift($parsed);
($page == "") ? $page = "Home" : $page = $page;
$getVars = array();

foreach ($parsed as $argument) {
    list($variable, $value) = explode('=', $argument);
    $getVars[$variable] = $value;
}

$target = SITE . DS . 'page' . DS . $page . '.php';
$target_api = SITE . DS . 'api' . DS . $page . '.php';
$GLOBALS['page'] = $page;

/**
 * Pagine per il quale NON si deve caricare header e footer
 */
$exclude = array("dispatch",  "Login", "Logout");
$api = array("segnalazioni", "accounting", "bartop", "ag_external", "mercury");

$act = "";

if (isset($getVars['action'])) {
    $act = @$getVars['action'];
}

if (isset($filename)) {
    echo $filename;
}

if(in_array($page, $api)){
    if (file_exists($target_api)) {
        //$hero->checkModule($page);
        include_once($target_api);
    }
} else {
    if (!in_array($page, $exclude) && $act != 'dispatch') {
        include_once(SITE . DS . 'include' . DS . 'header.php');
        if (file_exists($target)) {
            $hero->checkModule($page);
            include_once($target);
        } else {
            include_once(SITE . DS . 'page' . DS . 'Home.php');
        }
        include_once(SITE . DS . 'include' . DS . 'footer.php');
    } else {
        if (file_exists($target)) {
            $hero->checkModule($page);
            include_once($target);
        }
    }
}
