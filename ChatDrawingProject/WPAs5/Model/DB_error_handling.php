<?php

    # =========================================================================
    # this file contains error handlers
    # =========================================================================

    # =========================================================================
    # Shut Down Function
    # Purpose: executes when the program stops running, so IF it stopped
    #          running because of an error, we need to log this error
    # Inputs: none
    # =========================================================================
    function DBshutDownFunction() { 
        
        # get last error (if any)
        $error = error_get_last();
        
        # get level of error reporting
        $error_reporting = error_reporting();
        
        # if there was an error AND if user has specified that we want 
        # to report this error, then log it
        if ($error['type'] === E_ERROR && $error['type'] & $error_reporting) { 
            echo 'Server is unavailable - please try again later';
            error_log("FATAL: ".var_dump($error));
        } 
    }

    # =========================================================================
    # error Handler
    # Purpose: Handle any error/warning etc that happens during
    #          execution of our code
    # Inputs:
    #        $errno - error number (E_WARNING/E_ERROR etc)
    #        $errstr - the error message
    #        $errfile - what file did the error occur in?
    #        $errline - what line did the error occur on?
    # =========================================================================
    function DBerrorHandler($errno, $errstr, $errfile, $errline) {
        
        # NB: errors are only written to the log file,
        # if we are handling these errors, otherwise ignore, except for
        # user errors... those we just print out the messages

        # only deal with the error if the appropriate bit in the error
        # level has been set.
        $errlvl = error_reporting();
        switch ($errno & $errlvl) { 

            case E_NOTICE:
            case E_USER_NOTICE:
            case E_DEPRECATED:
            case E_STRICT:
                error_log("STRICT: $errstr at $errfile:$errline \n");
                break;
 
            case E_WARNING:
                error_log("WARNING: $errstr at $errfile:$errline \n");
                break;

            case E_ERROR:
            case E_RECOVERABLE_ERROR:
                log_error("FATAL: $errstr at $errfile:$errline \n");
                break;
 
        }

        # always deal with any E_USER error
        switch ($errno) {
            case E_USER_WARNING:
            case E_USER_NOTICE:
                error_log("WARNING: $errstr at $errfile:$errline \n");
                echo ("Too many login attempts, please try again in 5 minutes");
                break;
 
            case E_USER_ERROR:
                error_log("ERROR: $errstr at $errfile:$errline \n");
                echo ("Server Error, please try again later");
                break;

        }
        
        # we have finished dealing with this error (in other words, we do not
        # want php to continue to process this error)
        return true;
    }

    # =========================================================================
    # Exception handler
    # Purpose:  If we have an unhandled exception, (forgot to catch something?)
    #           then log the exception and print a generic message to the screen
    # Inputs: Exception object
    # =========================================================================
    function DBexceptionHandler ($exception) {
        
        # log the error and the stack trace
        error_log("EXCEPTION: " . $exception->getMessage() .
        " in " . $exception->getFile() . " line " . $exception->getLine());
        error_log("\t".$exception->getTraceAsString());
        
        # generic message to the screen
        echo "Server Error, please try again later";
    }
?>