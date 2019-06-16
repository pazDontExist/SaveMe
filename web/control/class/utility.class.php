<?php

/**
 * Class utility
 * Various usefull functions
 */
class utility
{
    function __construct()
    {
        return $this;
    }

    public static function format_kBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = number_format($bytes / 1000000, "2");

        return round($pow, $precision) . ' GB';
    }

    public static function is_date_time($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    /**
     * Ritorna array con la differenza temporale tra 2 date
     *
     * @param string Data Inizio
     * @param string Data Fine
     * @return array Ritorna array con differenza temporale = array("days"=>1, "hours"=>"2", "minutes"=>"3", "seconds"=>"4")
     */
    public static function get_time_difference($start, $end) {
        $uts['start'] = strtotime($start);
        $uts['end'] = strtotime($end);
        if ($uts['start'] !== -1 && $uts['end'] !== -1) {
            if ($uts['end'] >= $uts['start']) {
                $diff = $uts['end'] - $uts['start'];
                if ($days = intval((floor($diff / 86400))))
                    $diff = $diff % 86400;
                if ($hours = intval((floor($diff / 3600))))
                    $diff = $diff % 3600;
                if ($minutes = intval((floor($diff / 60))))
                    $diff = $diff % 60;
                $diff = intval($diff);
                return (array('days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $diff));
            } else {
                trigger_error("Ending date/time is earlier than the start date/time", E_USER_WARNING);
            }
        } else {
            trigger_error("Invalid date/time data detected", E_USER_WARNING);
        }
        return (false);
    }

    public static function clean_shit($dirty)
    {
        // togliamo js
        $dirty = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $dirty);
        $clean = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($dirty, ENT_QUOTES));
        return $clean;

    }

    public static function cleanForMsg($msg)
    {
        //anti xss
        $avoid = array("<script>");
        return str_replace($avoid, " TROL THE TROLLE ", $msg);
    }

    /**
     * @param $price
     * @param $sconto
     * @return mixed
     */
    public static function percentage($price, $sconto)
    {
        $a = $sconto / 100;
        $b = $a * $price;
        $priceF = $price - $b;
        return number_format($priceF, 2);
    }

    public static function array_utf8_encode($dat)
    {
        if (is_string($dat))
            return utf8_encode($dat);
        if (!is_array($dat))
            return $dat;
        $ret = array();
        foreach ($dat as $i => $d)
            $ret[$i] = self::array_utf8_encode($d);
        return $ret;
    }

    public static function filtra_madonna($dirty)
    {
        if (!is_array($dirty)) {
            $dirty = ereg_replace("[\'\")(;|`,<>]", "", $dirty);
            $dirty = mysql_real_escape_string(trim($dirty));
            $clean = stripslashes($dirty);
            return $clean;
        }
        $clean = array();
        foreach ($dirty as $p => $data) {
            $data = ereg_replace("[\'\")(;|`,<>]", "", $data);
            $data = mysqli_real_escape_string(trim($data));
            $data = stripslashes($data);
            $clean[$p] = $data;
        }
        return $clean;
    }

    /**
     * Funzione per vedere se un numero è compreso in
     * un determinato intervallo
     *
     * @param int $number Numero da controllare
     * @param int $min Start Range Controllo
     * @param int $max End Range Controllo
     * @return boolean
     */
    function between($number, $min, $max)
    {
        if ($number >= $min && $number <= $max) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Converte da TIMESTAMP a data e ora Italiana
     *
     * @param string $tms
     * @return string Data e ora
     * @example Entra questo => 1383651685 ed esce 05/11/2013 11:41:25
     */
    public static function deTimeStamp($tms)
    {
        $dirty = explode(" ", $tms);

        //$date = self::data_convert("it", $dirty[0]);
        //$time = $dirty[1];

        return $dirty[0];
    }

    /**
     * Conversione di una data
     * da formato italiano a inglese e viceversa
     *
     * @param string $to "it" oppure "en"
     * @param string $data Data da convertire
     * @return string Data Convertita
     * @uses dataConvert("en", "28/11/1989") return 1989-11-28
     * @uses dataConvert("it", "1989-11-28") return 28/11/1989
     */
    public static function data_convert($to, $data)
    {
        switch ($to) {
            case "it":
                $rsl = explode('-', $data);
                $rsl = array_reverse($rsl);
                return implode($rsl, '/');
                break;
            case "en":
                $rsl = explode('/', $data);
                $rsl = array_reverse($rsl);
                return implode($rsl, '-');
                break;
        }
    }

    /**
     * Evidenzia comparazione stringhe
     *
     * @param string $oldString
     * @param string $newString
     */
    function compare_strings($oldString, $newString)
    {
        $old_array = explode(' ', $oldString);
        $new_array = explode(' ', $newString);

        for ($i = 0; isset($old_array[$i]) || isset($new_array[$i]); $i++) {
            if (!isset($old_array[$i])) {
                echo '<font color="red">' . $new_array[$i] . '</font>';
                continue;
            }

            for ($char = 0; isset($old_array[$i]{$char}) || isset($new_array[$i]{$char}); $char++) {

                if (!isset($old_array[$i]{$char})) {
                    echo '<font color="red">' . substr($new_array[$i], $char) . '</font>';
                    break;
                } elseif (!isset($new_array[$i]{$char})) {
                    break;
                }

                if (ord($old_array[$i]{$char}) != ord($new_array[$i]{$char}))
                    echo '<font color="red">' . $new_array[$i]{$char} . '</font>';
                else
                    echo $new_array[$i]{$char};
            }

            if (isset($new_array[$i + 1]))
                echo ' ';
        }
    }

    /**
     * Splitta campo nominativo in cognome e nome
     *
     * @param string $col1 Nominativo
     * @param string $divider Se separato con qualcosa
     * @return array
     */
    function nominativo_split($col1, $divider)
    {
        $cog = "";
        $nom = "";

        if (count($pieces = @split(" ", $col1)) == 2) {
            $cog = $pieces[0];
            $nom = $pieces[1];
        }

        if (count($pieces = @split(" ", $col1)) == 3) {
            if (strlen($pieces[0]) <= 5) {
                if (substr($pieces[0], 0, 1) == "R") {
                    $cog = $pieces[0];
                    $nom = $pieces[1] . " " . $pieces[2];
                } else {
                    $cog = $pieces[0] . " " . $pieces[1];
                    $nom = $pieces[2];
                }
            } else {
                $cog = $pieces[0];
                $nom = $pieces[1] . " " . $pieces[2];
            }
        }

        if (count($pieces = @split(" ", $col1)) >= 4) {
            if (strlen($pieces[0]) <= 5) {
                $cog = $pieces[0] . " " . $pieces[1];
                $nom = $pieces[2] . " " . $pieces[3];
            } else {
                $cog = $pieces[0];
                $nom = $pieces[1] . " " . $pieces[2] . " " . $pieces[3];
            }
        }

        $nominat = array("cognome" => $cog,
            "nome" => $nom);

        return $nominat;
    }

    function translate($string)
    {
        $translate = "";
        $string = strtolower($string);
        switch ($string) {
            case "monday"    :
                $translate = "Lunedì";
                break;
            case "tuesday"   :
                $translate = "Martedì";
                break;
            case "wednesday" :
                $translate = "Mercoledì";
                break;
            case "thursday"  :
                $translate = "Giovedì";
                break;
            case "friday"    :
                $translate = "Venerdì";
                break;
            case "saturday"  :
                $translate = "Sabato";
                break;
            case "sunday"    :
                $translate = "Domenica";
                break;
        }

        return $translate;
    }

    function recursive_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    recursive_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    /**
     * Compare two arrays and return a list of items only in array1 (deletions) and only in array2 (insertions)
     *
     * @param array $array1 The 'original' array, for comparison. Items that exist here only are considered to be deleted (deletions).
     * @param array $array2 The 'new' array. Items that exist here only are considered to be new items (insertions).
     * @param array $keysToCompare A list of array key names that should be used for comparison of arrays (ignore all other keys)
     * @return array[] array with keys 'insertions' and 'deletions'
     */
    public static function array_difference(array $array1, array $array2, array $keysToCompare = null) {
        $serialize = function (&$item, $idx, $keysToCompare) {
            if (is_array($item) && $keysToCompare) {
                $a = array();
                foreach ($keysToCompare as $k) {
                    if (array_key_exists($k, $item)) {
                        $a[$k] = $item[$k];
                    }
                }
                $item = $a;
            }
            $item = serialize($item);
        };
        $deserialize = function (&$item) {
            $item = unserialize($item);
        };
        array_walk($array1, $serialize, $keysToCompare);
        array_walk($array2, $serialize, $keysToCompare);
        // Items that are in the original array but not the new one
        $deletions = array_diff($array1, $array2);
        $insertions = array_diff($array2, $array1);
        array_walk($insertions, $deserialize);
        array_walk($deletions, $deserialize);
        return array('game_to_add' => $insertions, 'game_to_delete' => $deletions);
    }

    /**
     * remove the last `$level` of directories from a path
     * example 'aaa/bbb/ccc' remove 2 levels will return aaa/
     *
     * @param $path
     * @param $level
     *
     * @return mixed
     */
    public function removeLastDir($path, $level){
        if (is_int($level) && $level > 0) {
            $path = preg_replace('#\/[^/]*$#', '', $path);

            return $this->removeLastDir($path, (int)$level - 1);
        }

        return $path;
    }


    public static function unique_code_generator($prefix='',$post_fix=''){
        // $t=time();
        // return ( rand(000,111).$prefix.$t.$post_fix);
        return rand(10000000000000,99999999999999);

    }


    /**
     * Ping a host
     * @param $host IP
     * @return bool TRUE is alive FALSE is Offline (or it's me to be offline ?)
     */
    public static function is_alive($host){
        $port = 80;
        $waitTimeoutInSeconds = 1;
        if($fp = fsockopen($host,$port,$errCode,$errStr,$waitTimeoutInSeconds)){
            return true;
        } else {
            return false;
        }
        fclose($fp);
    }

    public static function liveExecuteCommand($cmd) {

        while (@ ob_end_flush()); // end all output buffers if any

        $proc = popen("$cmd 2>&1 ; echo Exit status : $?", 'r');

        $live_output     = "";
        $complete_output = "";

        while (!feof($proc))
        {
            $live_output     = fread($proc, 4096);
            $complete_output = $complete_output . $live_output;
            // echo "$live_output"; - uncomment me for live output
            @ flush();
        }

        pclose($proc);

        // get exit status
        preg_match('/[0-9]+$/', $complete_output, $matches);

        // return exit status and intended output
        return array (
            'exit_status'  => intval($matches[0]),
            'output'       => str_replace("Exit status : " . $matches[0], '', $complete_output)
        );
    }

    public static function dump_debug($input, $collapse=false) {
        $recursive = function($data, $level=0) use (&$recursive, $collapse) {
            global $argv;

            $isTerminal = isset($argv);

            if (!$isTerminal && $level == 0 && !defined("DUMP_DEBUG_SCRIPT")) {
                define("DUMP_DEBUG_SCRIPT", true);

                echo '<script language="Javascript">function toggleDisplay(id) {';
                echo 'var state = document.getElementById("container"+id).style.display;';
                echo 'document.getElementById("container"+id).style.display = state == "inline" ? "none" : "inline";';
                echo 'document.getElementById("plus"+id).style.display = state == "inline" ? "inline" : "none";';
                echo '}</script>'."\n";
            }

            $type = !is_string($data) && is_callable($data) ? "Callable" : ucfirst(gettype($data));
            $type_data = null;
            $type_color = null;
            $type_length = null;

            switch ($type) {
                case "String":
                    $type_color = "green";
                    $type_length = strlen($data);
                    $type_data = "\"" . htmlentities($data) . "\""; break;

                case "Double":
                case "Float":
                    $type = "Float";
                    $type_color = "#0099c5";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;

                case "Integer":
                    $type_color = "red";
                    $type_length = strlen($data);
                    $type_data = htmlentities($data); break;

                case "Boolean":
                    $type_color = "#92008d";
                    $type_length = strlen($data);
                    $type_data = $data ? "TRUE" : "FALSE"; break;

                case "NULL":
                    $type_length = 0; break;

                case "Array":
                    $type_length = count($data);
            }

            if (in_array($type, array("Object", "Array"))) {
                $notEmpty = false;

                foreach($data as $key => $value) {
                    if (!$notEmpty) {
                        $notEmpty = true;

                        if ($isTerminal) {
                            echo $type . ($type_length !== null ? "(" . $type_length . ")" : "")."\n";

                        } else {
                            $id = substr(md5(rand().":".$key.":".$level), 0, 8);

                            echo "<a href=\"javascript:toggleDisplay('". $id ."');\" style=\"text-decoration:none\">";
                            echo "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>";
                            echo "</a>";
                            echo "<span id=\"plus". $id ."\" style=\"display: " . ($collapse ? "inline" : "none") . ";\">&nbsp;&#10549;</span>";
                            echo "<div id=\"container". $id ."\" style=\"display: " . ($collapse ? "" : "inline") . ";\">";
                            echo "<br />";
                        }

                        for ($i=0; $i <= $level; $i++) {
                            echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                        }

                        echo $isTerminal ? "\n" : "<br />";
                    }

                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }

                    echo $isTerminal ? "[" . $key . "] => " : "<span style='color:black'>[" . $key . "]&nbsp;=>&nbsp;</span>";

                    call_user_func($recursive, $value, $level+1);
                }

                if ($notEmpty) {
                    for ($i=0; $i <= $level; $i++) {
                        echo $isTerminal ? "|    " : "<span style='color:black'>|</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                    }

                    if (!$isTerminal) {
                        echo "</div>";
                    }

                } else {
                    echo $isTerminal ?
                        $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " :
                        "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";
                }

            } else {
                echo $isTerminal ?
                    $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "  " :
                    "<span style='color:#666666'>" . $type . ($type_length !== null ? "(" . $type_length . ")" : "") . "</span>&nbsp;&nbsp;";

                if ($type_data != null) {
                    echo $isTerminal ? $type_data : "<span style='color:" . $type_color . "'>" . $type_data . "</span>";
                }
            }

            echo $isTerminal ? "\n" : "<br />";
        };

        call_user_func($recursive, $input);
    }

    public static function terminal($command) {
        //system
        if(function_exists('system')) {
            ob_start();
            system($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
        }
        //passthru
        else if(function_exists('passthru')) {
            ob_start();
            passthru($command , $return_var);
            $output = ob_get_contents();
            ob_end_clean();
        }

        //exec
        else if(function_exists('exec')) {
            exec($command , $output , $return_var);
            $output = implode("n" , $output);
        }

        //shell_exec
        else if(function_exists('shell_exec')) {
            $output = shell_exec($command) ;
        }

        else {
            $output = 'Command execution not possible on this system';
            $return_var = 1;
        }

        return array('output' => $output , 'status' => $return_var);
    }

    /**
     * Tail Log
     * tail -n $line $log_file
     * @param string $log_file
     * @param int $lines
     * @param bool $adaptive
     * @return
     */
    public static function tail_log($log_file, $lines = 20, $adaptive = true){
        $filepath = "";

        switch ($log_file){
            case 'hotfix':
                $filepath = LOG_PATH . DS . 'cron' . DS . 'hot_fix.log';
                break;
            case 'media':
                $filepath = LOG_PATH . DS . 'manual' . DS . 'media_send.log';
                break;
            default:
                $filepath = LOG_PATH . DS . 'test.log';
                break;
        }

        // Open file
        $f = @fopen($filepath, "rb");
        if ($f === false) return false;
        // Sets buffer size, according to the number of lines to retrieve.
        // This gives a performance boost when reading a few lines from the file.
        if (!$adaptive) $buffer = 4096;
        else $buffer = ($lines < 2 ? 64 : ($lines < 10 ? 512 : 4096));
        // Jump to last character
        fseek($f, -1, SEEK_END);
        // Read it and adjust line number if necessary
        // (Otherwise the result would be wrong if file doesn't end with a blank line)
        if (fread($f, 1) != "\n") $lines -= 1;

        // Start reading
        $output = '';
        $chunk = '';
        // While we would like more
        while (ftell($f) > 0 && $lines >= 0) {
            // Figure out how far back we should jump
            $seek = min(ftell($f), $buffer);
            // Do the jump (backwards, relative to where we are)
            fseek($f, -$seek, SEEK_CUR);
            // Read a chunk and prepend it to our output
            $output = ($chunk = fread($f, $seek)) . $output;
            // Jump back to where we started reading
            fseek($f, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            // Decrease our line counter
            $lines -= substr_count($chunk, "\n");
        }
        // While we have too many lines
        // (Because of buffer size we might have read too many)
        while ($lines++ < 0) {
            // Find first newline and remove all text before that
            $output = substr($output, strpos($output, "\n") + 1);
        }
        // Close file and return
        fclose($f);
        return trim($output);
    }

    /**
     * List all files in a folder
     * @param $path
     * @param $ext
     */
    public static function list_files($path, $ext){

    }

    /**
     * https://stackoverflow.com/questions/1707801/making-a-temporary-dir-for-unpacking-a-zipfile-into
     * @author  Will <https://stackoverflow.com/users/145279/will>
     * @param null $dir
     * @param string $prefix
     * @param int $mode
     * @param int $maxAttempts
     * @return bool|string
     */
    public static function temp_dir($dir = null, $prefix = 'tmp_', $mode = 0700, $maxAttempts = 1000)
    {
        /* Use the system temp dir by default. */
        if (is_null($dir))
        {
            $dir = sys_get_temp_dir();
        }

        /* Trim trailing slashes from $dir. */
        $dir = rtrim($dir, DIRECTORY_SEPARATOR);

        /* If we don't have permission to create a directory, fail, otherwise we will
         * be stuck in an endless loop.
         */
        if (!is_dir($dir) || !is_writable($dir))
        {
            return false;
        }

        /* Make sure characters in prefix are safe. */
        if (strpbrk($prefix, '\\/:*?"<>|') !== false)
        {
            return false;
        }

        /* Attempt to create a random directory until it works. Abort if we reach
         * $maxAttempts. Something screwy could be happening with the filesystem
         * and our loop could otherwise become endless.
         */
        $attempts = 0;
        do
        {
            $path = sprintf('%s%s%s%s', $dir, DIRECTORY_SEPARATOR, $prefix, mt_rand(100000, mt_getrandmax()));
        } while (
            !mkdir($path, $mode) &&
            $attempts++ < $maxAttempts
        );

        return $path;
    }

    /**
     * https://stackoverflow.com/questions/34190464/php-scandir-recursively
     * @param $target
     */
    public static function scan_dir($target) {
        if(is_dir($target)){
            $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
            foreach( $files as $file ) {
                self::scan_dir( $file );
            }
        }
    }

    public static function is_json($string){
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    static public function copyr($source, $dest){
        // recursive function to copy
        // all subdirectories and contents:
        if( is_dir( $source ) ) {
            //echo "working in DIR {$source}<br/>";
            $dir_handle=opendir($source);
            $sourcefolder = basename($source);
            $n_dir = $dest. DS .$sourcefolder;
            //echo "MKDIR {$n_dir}</br>";
            mkdir($n_dir, 0777);
            while($file=readdir($dir_handle)){

                if($file!="." && $file!=".." && $file != ".DS_Store") {
                    if(is_dir($source. DS .$file)){
                        self::copyr($source. DS .$file, $dest. DS .$sourcefolder);
                    } else {

                        $s_file = $source. DS .$file;
                        $d_file = $n_dir. DS .$file;
                        //echo "COPING FILE {$s_file} -> {$d_file}</br>";

                        copy($s_file,$d_file );
                    }
                }
            }
            closedir($dir_handle);
        } else {
            //echo "coping file {$source}<br/>";
            // can also handle simple copy commands
            copy($source, $dest);
        }
    }

    public static function move_my_shit($dir, $dirNew){
        // Open a known directory, and proceed to read its contents
        if (is_dir($dir)) {
            if ($dh = opendir($dir)) {
                while (($file = readdir($dh)) !== false) {
                    //echo '<br>Archivo: '.$file;
                    //exclude unwanted
                    if(is_dir($file)){
                        mkdir($file);
                    }
                    if ($file==".") continue;
                    if ($file=="..")continue;
                    //if ($file=="index.php") continue; for example if you have index.php in the folder
                    if (rename($dir.'/'.$file,$dirNew.'/'.$file))
                    {
                        $err = false;
                        //if files you are moving are images you can print it from
                        //new folder to be sure they are there
                    }
                    else {$err = true;}
                }
                closedir($dh);
            }
        }
        return $err;
    }
}