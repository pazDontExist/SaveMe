<?php
/**
 * SEC_LOGIN
 * Classe per la gestione del login sicuro e supporta anche protocollo HTTPS
 * @Versione 1.0 rev 12
 * @Data 2014-06-27
 * @author Antonio D'Angelo <dangeloantonio179@gmail.com>
 * @license http://creativecommons.org/licenses/by-nc-sa/4.0/ Licenza CC
 * @copyright (c) 2014, Antonio D'Angelo
 */
class sec_login {

    var $_is_pds;

    /**
     * To know for WHO am i doing the login
     * sec_login constructor.
     * @param bool $is_pds
     */
    function __construct($is_pds = false){
        if($is_pds){
            $this->_is_pds = true;
        }

        return $this;
    }

    /**
     * Crea Sessione sicura
     * effettua ovverride parametri esistenti per le sessioni
     */
    function sec_session_start() {
        $session_name = 'saveme_session'; // Imposta un nome di sessione
        $secure = false; // Imposta il parametro a true se vuoi usare il protocollo 'https'.
        $httponly = true; // Questo impedirà ad un javascript di essere in grado di accedere all'id di sessione.
        ini_set('session.use_only_cookies', 1); // Forza la sessione ad utilizzare solo i cookie.
        $cookieParams = session_get_cookie_params(); // Legge i parametri correnti relativi ai cookie.
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name); // Imposta il nome di sessione con quello prescelto all'inizio della funzione.
        session_start(); // Avvia la sessione php.
        session_regenerate_id(); // Rigenera la sessione e cancella quella creata in precedenza.
    }

    /**
     * Funzione per controllo login
     *
     * @param string E-Mail utente
     * @param string Password Utente
     * @param object Oggetto Connessione al db
     * @return boolean True se tutto ok FALSE se qualcosa va storto
     */
    function login($email, $password, $mysqli) {

        // Using prepared statements means that SQL injection is not possible.
        if ($stmt = $mysqli->prepare("SELECT id, nome, cognome, email, passwd, ts, status, distretto, citta FROM saveme.power_user WHERE email = ? AND status = 'ACTIVE' LIMIT 1")) {
            $stmt->bind_param('s', $email);  // Bind "$email" to parameter.
            $stmt->execute();    // Execute the prepared query.
            $stmt->store_result();

            // get variables from result.
            $stmt->bind_result($user_id, $user_fname, $user_lname, $db_password, $tipo_user,$u_mail, $g_create, $pds_id);
            $stmt->fetch();

            if ($stmt->num_rows == 1) {
                // If the user exists we check if the account is locked
                // from too many login attempts

                if ($this->checkbrute($user_id, $mysqli) == true) {
                    // Account is locked
                    // Send an email to user saying their account is locked
                    echo "BLOCKED";
                    return false;
                } else {

                    // Check if the password in the database matches
                    // the password the user submitted. We are using
                    // the password_verify function to avoid timing attacks.
                    //  if (password_verify($password, $db_password)) {
                    if ($password == $db_password) {
                        // Password is correct!
                        $ip = "";
                        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                            $ip = $_SERVER['HTTP_CLIENT_IP'];
                        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                        } else {
                            $ip = $_SERVER['REMOTE_ADDR'];
                        }
                        /* $logger = new logger();
                         $logger->add_log('0', 'login - uID => ' . $user_id . ' Email => ' . $email, $ip);
 */
                        $mysqli->query("INSERT INTO access_log (user_id, indirizzo_ip) VALUES ('$user_id', '$ip')");
                        // Get the user-agent string of the user.
                        $user_browser = $_SERVER['HTTP_USER_AGENT'];
                        // XSS protection as we might print this value
                        $user_id = preg_replace("/[^0-9]+/", "", $user_id);

                        $_SESSION['user_id'] = $user_id;
                        // XSS protection as we might print this value
                        $compose = $user_fname + " " + $user_lname;
                        $username = preg_replace("/[^a-zA-Z0-9_\-]+/", " ", $user_fname);

                        $_SESSION['username'] = $username;
                        $_SESSION['login_string'] = hash('sha512', $db_password . $user_browser);
                        $_SESSION['tipo_user'] = $tipo_user;
                        $_SESSION['user_mail'] = $u_mail;
                        $_SESSION['user_fname'] = $user_fname;
                        $_SESSION['user_lname'] = $user_lname;
                        $_SESSION['account_creation'] = $g_create;
                        $_SESSION['pds_id'] = $pds_id;


                        // Login successful.
                        //header('location: index.php?Home');
                        echo "logged";
                        return true;
                    } else {
                        // Password is not correct
                        // We record this attempt in the database
                        $now = time();
                        $mysqli->query("INSERT INTO login_attempts(user_id, time)
                                    VALUES ('$user_id', '$now')");
                        header('location: index.php?Login&error=' . $password);
                        exit();
                    }
                }
            } else {
                // No user exists.
                echo 'no user';
                return false;
            }
        }
    }

    /**
     * Controlla se è sotto bruteforce
     *
     * @param int ID Utente
     * @param object Oggetto Connessione al db
     * @return boolean TRUE se sotto bruteforce FALSE se ok
     */
    function checkbrute($user_id, $mysqli)
    {
        // Get timestamp of current time
        $now = time();

        // All login attempts are counted from the past 2 hours.
        $valid_attempts = $now - (2 * 60 * 60);

        if ($stmt = $mysqli->prepare("SELECT time 
                             FROM login_attempts 
                             WHERE user_id = ? 
                            AND time > '$valid_attempts'")) {
            $stmt->bind_param('i', $user_id);

            // Execute the prepared query.
            $stmt->execute();
            $stmt->store_result();

            // If there have been more than 5 failed logins
            if ($stmt->num_rows > 5) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * Funzione per controllare accesso alle pagine
     * limitandolo soloa gli utenti che hanno effettuato il login
     *
     * @param type $mysqli Connessione al db
     * @return boolean
     */
    function login_check($mysqli) {
        // Check if all session variables are set
        if (isset($_SESSION['user_id'],
            $_SESSION['username'],
            $_SESSION['login_string'])) {

            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];

            // Get the user-agent string of the user.
            $user_browser = $_SERVER['HTTP_USER_AGENT'];

            if ($stmt = $mysqli->prepare("SELECT passwd
                                      FROM power_user
                                      WHERE id = ? LIMIT 1")) {
                // Bind "$user_id" to parameter.
                $stmt->bind_param('i', $user_id);
                $stmt->execute();   // Execute the prepared query.
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    // If the user exists get variables from result.
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $login_check = hash('sha512', $password . $user_browser);

                    // if (hash_equals($login_check, $login_string) ){
                    if ($login_check == $login_string) {
                        // Logged In!!!!
                        return true;
                    } else {
                        // Not logged in
                        die("hash fail");
                        // return false;
                    }
                } else {
                    // Not logged in
                    die("not found");
                    //return false;
                }
            } else {
                // Not logged in
                die("non ti trovo");
                //return false;
            }
        } else {
            // Not logged in
            //die("no session");//return false;
            header("Location: index.php?Login");
            exit();
            //echo "WSHIIIIIIIIIIIIIIIIIIIIIIIII";
        }
    }

}
