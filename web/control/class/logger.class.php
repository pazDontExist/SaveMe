<?php

class logger
{
    var $user_ip = "";
    var $uniqid = null;
    var $func_trace = false;

    function __construct( $filename = null, $with_uniq_id = false, $called_function = false )
    {
        $this->filename = $filename;

        /*
         * Setting the unique id to track logger single instance
         *
         */
        if ( $with_uniq_id ) {
            $this->uniqid = "[ ". uniqid() . " ]";
        }

        if ( $called_function ) {
            $this->func_trace = true;
        }

        return $this;
    }

    function log_action( $message = null, $verbose = false ) {

        $logfile_descriptor = fopen($this->filename, 'a+');
        fwrite($logfile_descriptor, $this->_format_log_message( $message ) );
        fclose($logfile_descriptor);

        if( $verbose ) {
            echo $message . "\n";
        }

    }

    /*
     * In a very "rustic" way formats the log entry with basic infos.
     */
    private function _format_log_message( $message = null ) {


        $date = date("Y-M-d H:i:s");
        /*
         * If the logger is constructed with uniqid support
         * adds it to the log message, otherwise adds an empty string
         */
        $uniqid = ( $this->uniqid != null ) ? $this->uniqid : "";
        $called_function = ( $this->func_trace ) ? "[ " . @debug_backtrace()[2]['function'] . " ]" : "";

        return "[ {$date} ]{$uniqid}{$called_function}: {$message}\n";

    }

}