<?php

/*** DEVELOPING OPTION ***/
define('DEBUG', true);
/************************/

/*** !!! ATTENZIONE !!! NON TOCCARMI ***/
define('SITE_PATH', getcwd());
define('DS', DIRECTORY_SEPARATOR);
define('SITE', SITE_PATH . DS . 'application');
define('MODULE_PATH', SITE_PATH . DS . 'module');
define('GAME_PATH', SITE_PATH . DS . 'data' . DS . 'games');
define('JS_PATH', SITE_PATH . DS . 'dist' . DS . 'js' . DS . 'pages');
define('CUSTOM_AS_PATH', SITE_PATH . DS . 'data' . DS . 'custom_as');
define('SCRIPT', SITE_PATH . DS . 'script');
define('LOG_PATH', SITE_PATH . DS . 'logs');
define('UPLOAD_MEDIA', SITE_PATH . DS . 'data' . DS . 'media');
/*** END DI COSE CHE NON PUOI TOCCARE ***/


/*** PARAMETRI DATABASE - MAIN ***/

define('DB_HOST', "localhost");   // IP/HOSTNAME del server mysql
define('DB_USER', "user");        // Nome Utente Mysql
define("DB_PASS", "password");            // Password MySql
define('DB_NAME', "saveme");         // Nome database
define('DB_CONNECTOR', "mysql");
define('DB_TIMEOUT', 5);



/***  MAIN URL ***/

/**** LOGIN STUFF *****/
define("CAN_REGISTER", true);
define("DEFAULT_ROLE", "User");

define("SECURE", FALSE);    // FOR DEVELOPMENT ONLY!!!!
/************************/


/*** VARIOUS ***/
define("CONN_TIMEOUT", 3); // Seconds

/*** INFO ***/
define('APP_NAME', "Save Me"); // nome app
define('APP_VERSION', "1.0.0"); // versione
define('APP_SLOGAN', "Sistema segnalazione Randagi"); //slogan
define('APP_LAST_UPDATE', "21/05/2018"); //last update


/*** AUTHOR ***/
define('DEVELOPER', "Antonio D'Angelo");
define('DEVELOPER_MAIL', 'dangeloantonio179@gmail.com');
define('DEVELOPER_URL', '#');
