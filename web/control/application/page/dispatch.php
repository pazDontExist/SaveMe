<?php


// a valid token => e8a1273H7a120e7a
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET');
header('Access-Control-Allow-Headers: Content-Type,Accept, Authorization');
header('Content-type: text/html; charset=utf-8');

$token = new token();

($token->isValidSecret()) ? call_user_func($_REQUEST['method'], @$_REQUEST['data']) : responder::respond(401, array("status"=>"error", "message"=>"Un-Authorized Request"));


/* ===== LOGIN AND USER MANAGEMENT ===== */

function do_login(){
    global $sec_login;
    global $mysqli;

    $user = filter_input(INPUT_GET, 'username', FILTER_SANITIZE_STRING);
    $pass = hash('sha512', $_GET['password']);

    if ($sec_login->login($user, $pass, $mysqli)) {
        echo "ok";
    } else {
        echo "err";
    }
}

function add_user(){
    global $mysqli;

    $fname      = filter_input(INPUT_GET, 'fname', FILTER_SANITIZE_STRING);
    $lname      = filter_input(INPUT_GET, 'lname', FILTER_SANITIZE_STRING);
    $email      = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
    $pass       = hash('sha512', $_GET['pass']);
    $level      = filter_input(INPUT_GET,'u_level', FILTER_SANITIZE_STRING);
    $status     = filter_input(INPUT_GET,'status', FILTER_SANITIZE_STRING);
    $distretto  = filter_input(INPUT_GET,'distretto', FILTER_SANITIZE_STRING);
    $citta      = filter_input(INPUT_GET,'citta', FILTER_SANITIZE_STRING);

    if($mysqli->query("INSERT INTO power_user (nome, cognome, email, passwd, status, distretto, citta) VALUES (
'$fname', '$lname', '$email', '$pass', $status,'$distretto', '$citta'
) ")){
        echo "ok";
    } else {
        echo "err";
    }



}

function check_pass(){
    global $mysqli;
    $my_id = $_SESSION['user_id'];
    $pass = hash('sha512', $_GET['pass']);
    $st = $mysqli->query("SELECT passwd FROM power_user WHERE id = $my_id");
    $db_p = $st->fetch_assoc();

    if ($pass == $db_p['passwd']) {
        echo "ok";
    } else {
        echo "damn";
    }

}

function update_pass(){
    global $mysqli;
    $my_id = $_SESSION['user_id'];
    $pass = hash('sha512', $_GET['new_pass']);

    if($mysqli->query("UPDATE power_user SET passwd = '$pass' WHERE id = $my_id")){
        echo "ok";
    } else {
        echo "damn2";
    }

}

function update_name_surname(){
    global $mysqli;
    $my_id = $_SESSION['user_id'];
    $fname = filter_input(INPUT_GET, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_GET, 'lname', FILTER_SANITIZE_STRING);

    if($mysqli->query("UPDATE power_user SET nome = '$fname', cognome = '$lname' WHERE id = $my_id")){
        echo "ok";
    } else {
        echo "err name-surname update";
    }

}