<?php

// a valid token => e8a1273H7a120e7a
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST,GET');
header('Access-Control-Allow-Headers: Content-Type,Accept,Authorization');
header('Content-type: text/html; charset=utf-8');


$token = new token();
$logger = new logger(LOG_PATH . DS . 'api' . DS . "segnalazioni.log", true);


($token->isValidSecret()) ? call_user_func($_REQUEST['method'], @$_REQUEST['data']) : responder::respond(401, array("status"=>"error", "status_code"=> 888, "message"=>"Un-Authorized Request"));


function echo_test($test){
    responder::respond(200, $test);
}

/**
 * Ritorna user_id partendo dal token ricevuto
 *
 * @param $token
 * @return int
 */
function get_user_id($token){
    global $mysqli;

    $st = $mysqli->query("SELECT user_id FROM users WHERE token = '$token' LIMIT 1");
    $user = $st->fetch_assoc();

    if( empty($user) ){
        return 0;
    } else {
        return $user['user_id'];
    }
}

/**
 * Inserimento Nuova Segnalazione
 *
 * @param $json_data
 * @return json
 */
function nuova($json_data){
    global $mysqli;
    global $logger;

    $user_id = get_user_id($_REQUEST['token']);

    if( $user_id == 0 ) {
        $logger->log_action("-- Exiting, invalid user token. Hack attempt ?");
        responder::respond(400, array("status"=>"error","status_code"=>555, "message"=>"User not found"));
        exit;
    }

    $logger->log_action("[SEGNALAZIONI - NUOVA]");

    if( !utility::is_json($json_data) ) {
        $logger->log_action("-- Exiting, invalid json data");
        responder::respond(400, array("status"=>"error","status_code"=>777, "message"=>"data received is not a valid json"));
        exit;
    }


    // trasforma in array il json e Codifica in utf8
    $recv = utility::array_utf8_encode(json_decode($json_data, TRUE));

    $st = $mysqli->prepare("INSERT INTO segnalazioni (user_id, lat, lon, direzione, dettaglio, main_photo) VALUES (?, ?, ?, ?, ?, ?)");
    $st->bind_param("iddsss", $user_id, $recv['lat'], $recv['lon'], $recv['direzione'], $recv['dettaglio'], $recv['encoded_pic']);

    if ( $st->execute() ){
        $response = array(
            "method"=>"nuova_segnalazione",
            "status"=>"success",
            "id_segnalazione"=> str_pad($st->insert_id, 10, 0),
            "user_id" => $user_id,
            "message"=>"Segnalazione Inviata con Successo."
        );

        $logger->log_action("[ SUCCESS ] - Segnalazione insertia");
        responder::respond(200, $response);
    } else {
        responder::respond(500, array("status"=>"error", "message"=>"Errore #9655 - Perfavore, invia segnalazione") );
    }

}


function dettaglio($json_data){
    global $mysqli;

    $user_id = get_user_id($_REQUEST['token']);

    // Controlla che l'utente possa fare questa richiesta
    if( $user_id == 0 ) {
        responder::respond(400, array("status"=>"error","status_code"=>555, "message"=>"User not found"));
        exit;
    }

    // Coontrolla bontà del jsonb
    if( !utility::is_json($json_data) ) {
        responder::respond(400, array("status"=>"error","status_code"=>777, "message"=>"data received is not a valid json"));
        exit;
    }

    // trasforma in array il json e Codifica in utf8
    $recv = utility::array_utf8_encode(json_decode($json_data, TRUE));

    $st = $mysqli->prepare("SELECT * FROM segnalazioni WHERE user_id = $user_id AND segnalazione_id = ? LIMIT 1");
    $st->bind_param("i", $recv['segnalazione_id']);

    if( $st->execute() ) {

        // Prendi i dati
        $data = $st->fetch();

        // Se la segnalazione non esiste nel db
        if ( empty($data) ) {
            $response = array(
                "method"=>"dettaglio",
                "status"=>"success",
                "message"=> 'none'
            );

            responder::respond(200, $response);
            exit;
        // Se la segnalazione esiste
        }

        $response = array(
            "method"=>"dettaglio",
            "status"=>"success",
            "message"=> $data
        );

        responder::respond(200, $response);
    }
    // La query è andata a male
    else {
        $response = array(
            "method"=>"dettaglio",
            "status"=>"error",
            "message"=> 'none'
        );

        responder::respond(200, $response);
        exit;
    }
}


function aggiorna($json_data){}