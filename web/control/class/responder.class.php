<?php
/**
 * Created by PhpStorm.
 * User: antonio
 * Date: 15/12/17
 * Time: 01:25
 */


class responder {
    public static function respond($http_code, $a_messages = array('status'=>'success'), $header = 'Content-Type: application/json'){
        //@todo fare controllo di a_message per sapere se è stringa o array
        header($header);
        http_response_code($http_code);
        if($header == 'Content-Type: application/json'){
            echo json_encode(utility::array_utf8_encode($a_messages));
        } else {
            echo $a_messages;
        }

    }
}