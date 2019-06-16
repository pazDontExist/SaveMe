<?php

/**
 * TOKEN
 * Classe per la generazione e controllo di token
 * @Versione 0.1
 * @Data 2014-06-27
 * @update 2019-02-14
 * @author Antonio D'Angelo <dangeloantonio179@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ Licenza CC
 * @copyright (c) 2014, Antonio D'Angelo
 */
class token {

    /**
     * @param int $length
     * @return string
     */
    function make_token($length = 16)
    {
        if ($length < 8 || $length > 44) {
            die();
        }
        //echo "a<br>";
        $length_odd = (($length % 2) != 0);
        //echo "b - LENT => $length LENT ODD -> $length_odd<br>";
        $length_has_root = (strpos(sqrt($length), '.') === false);
        $keys = [];
        $offset = $length_odd ? 1 : 0;
        $key_str = '';

        $key_str .= $keys[($offset + 0)] = $this->rand_alphanumeric();
        $key_str .= $keys[(($length / 4) - 1 + $offset)] = $this->rand_alphanumeric();
        $key_str .= $keys[(($length / 2) - 1 + $offset)] = $this->rand_alphanumeric();
        $key_str .= $keys[(($length - 2) + $offset)] = $this->rand_alphanumeric();
        // echo "c - $key_str<br>";
        $hashed_keys = $length_has_root ? sha1(md5($key_str)) : sha1(sha1($key_str));
        // echo "d - $hashed_keys<br>";

        $hash_enum = 0;
        for ($i = 0; $i < $length; $i++) {
            if ($keys[$i] == '') { // Undefined offset
                $keys[$i] = $hashed_keys[$hash_enum];
                $hash_enum++;
            }
        }
        ksort($keys);
        return implode($keys, '');
    }

    /**
     * Funzione generazione caratteri random
     *
     * @return chr Caratteri random
     */
    function rand_alphanumeric()
    {
        $subsets[0] = array('min' => 48, 'max' => 57); // ascii digits
        $subsets[1] = array('min' => 65, 'max' => 90); // ascii lowercase English letters
        $subsets[2] = array('min' => 97, 'max' => 122); // ascii uppercase English letters
        $s = rand(0, 2);
        $ascii_code = rand($subsets[$s]['min'], $subsets[$s]['max']);
        return chr($ascii_code);
    }

    function isValidSecret()
    {
        $de = json_decode($_REQUEST['data'], true);
        if ($this->getBearerToken()  || $this->verify_token($de['token']) || $this->verify_token($_REQUEST['token'] )) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * get access token from header
     * */
    function getBearerToken()
    {

        $headers = $this->getAuthorizationHeader();
        // HEADER: Get the access token from the header
        if (!empty($headers)) {
            if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                return $this->verify_token($matches[1]);
            }
        }
        return null;
    }

    /**
     * Get header Authorization
     * */
    function getAuthorizationHeader()
    {
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        } else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }

    /**
     * @param $str
     * @return bool
     */
    function verify_token($str)
    {
        $length = strlen($str);
        $keys = str_split($str);
        $length_odd = (($length % 2) != 0);
        $length_has_root = (strpos(sqrt($length), '.') === false);
        $offset = $length_odd ? 1 : 0;
        $key_str = '';
        $key_str .= $keys[$pos1 = (int)(0 + $offset)];
        $key_str .= $keys[$pos2 = (int)(($length / 4) - 1 + $offset)];
        $key_str .= $keys[$pos3 = (int)(($length / 2) - 1 + $offset)];
        $key_str .= $keys[$pos4 = (int)(($length - 2) + $offset)];
        $hashed_keys = $length_has_root ? sha1(md5($key_str)) : sha1(sha1($key_str));
        $hash_string = '';
        for ($i = 0; $i < $length; $i++) {
            if ($i != $pos1 &&
                $i != $pos2 &&
                $i != $pos3 &&
                $i != $pos4) {
                $hash_string .= $keys[$i];
            }
        }
        $hash_length = $length - 4;
        return ($hash_string == substr($hashed_keys, 0, $hash_length));
    }

}
