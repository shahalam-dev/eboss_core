<?php

$ROOT_PATH=getenv('ROOT_PATH');

class ErrorHandler {

    public static function handleException($e, $from, $user) {
        // Log the error
        self::logError($e, $from, $user);

    }

    private static function logError($e, $from, $user) {
        // Implement your logging logic here (e.g., log to a file or console)
        $dt=date('Y-m-d H:i:s');
        $exceptionMessage = "Exception: " . $e->getMessage();
        $exceptionTrace = "Trace: " . $e->getTraceAsString();
        $logFilePath = $GLOBALS['ROOT_PATH'] . '/logs/app.log';
        
        $logMessage = "$dt|$from|$user|$exceptionMessage|$exceptionTrace\n";

        error_log($logMessage, 3, $logFilePath);
        // error_log(print_r($logMessage, true));
    }


}

