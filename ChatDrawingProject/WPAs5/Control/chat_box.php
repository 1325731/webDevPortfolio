<?php
    # ========================================================================
    # chat_box.php
    # ========================================================================
    # PURPOSE:
    # Stores messages or gets messages.
    #
    # INPUTS: by POST
    # action:   "store_message" or "get_latest_messages"
    # msg: "message" (for store_message)
    # hours: "hours" (for get_latest_messages)
    # database: (defaults to 'Production')
    #
    # OUTPUTS (JSON string):
    # messages: (messages from get_latest messages)
    # error: error string (if any)
    #
    # VERSION 1.0 - November 2016 - Kamal El Hindawi / Sandy Bultena
    # ========================================================================
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    session_start();

    $_SESSION['LAST_ACTIVITY'] = time();
    
    $info["messages"] = "";
    $info["error"] = "";
    $status = "";
    $user = "";
    
    # Checks if session variable is available
    if (!empty($_SESSION['user'])) {
        $user = $_SESSION['user'];
        $info["messages"] = $_SESSION['user'];
    } else {
        $user = "";
    }
    
    # ========================================================================
    # get Model files, and set up error handling
    # ========================================================================
    $dir = __DIR__;
    require ("$dir/../Model/DB_message.php");
    require ("$dir/../Model/DB_error_handling.php");
    set_exception_handler('DBexceptionHandler');
    # set_error_handler('DBerrorHandler'); uncomment this during production mode
    # register_shutdown_function('DBshutDownFunction'); uncomment this for production mode
    
    $error_messages = array(
        'English'=>array(
            'unknown'           => 'An unknown error has occured',
            'server_error'      => 'Server is down, please try again later',
            'missing_message'   => 'There was no message received',
            'missing_hours'     => 'There was no hours received',
            'not_logged_in'     => 'There is no session of any user logged in',
            'no_action'         => 'What, exactly, do you want me to do!'
            ),
        'French'=>array(
            'unknown'           => 'Une erreur inconnue est survenue',
            'server_error'      => 'Server ne marche pas, s\'il vous plaît réessayer plus tard',
            'missing_message'   => 'Aucun message reçu',
            'missing_hours'     => 'Aucune heure n\'a été reçue',
            'not_logged_in'     => 'Il n\'y a pas de session d\'un utilisateur connecté',
            'no_action'         => 'Qu\'est-ce, exactement, voulez-vous que je fasse !'
            )
        );
        
    # ========================================================================
    # Extract all the post variables
    # ========================================================================
    extract($_POST, EXTR_PREFIX_ALL, "P");

    # ========================================================================
    # which language to use?
    # ========================================================================
    $lang = 'English';
    if (isset($_POST['lang']) && array_key_exists($lang,$error_messages)) {
        $lang = $_POST['lang'];
    }
    
    # ========================================================================
    # which database to use
    # ========================================================================
    $database = 'Production';
    if (isset($_POST['database'])) {
        $database = $_POST['database'];
    }
    # ========================================================================
    # Store or get messages
    # ========================================================================
    if (! $status ) {
        try {
            if (isset($_POST['action']) && $_POST['action'] == "store_message") {
                if (empty($_POST['msg'])) {
                    $status = "missing_message";
                }
                elseif (empty($user)) {
                    $status = "not_logged_in";
                }
                else {
                    $dbh = connect($database);
                    store_message($dbh, $user, $_POST['msg']);
                }
            }
            elseif (isset($_POST['action']) && $_POST['action'] == "get_latest_messages") {
                if (empty($_POST['hours'])) {
                    $status = "missing_hours";
                }
                elseif (empty($user)) {
                    $status = "not_logged_in";
                }
                else {
                    $dbh = connect($database);
                    $info['messages'] = get_latest_messages($dbh, $_POST['hours'], $user);
                }
            }
            else {
                $status = "no_action";
            }
        }
        
        catch (Exception $e) {
            $status = 'server_error';
            error_log("EXCEPTION: " . $e->getMessage() .
            " in " . $e->getFile() . " line " . $e->getLine());
            error_log("\t".$e->getTraceAsString());
        }
    }
    
    
    
    # ========================================================================
    # Failure to store or receive messages - set error message
    # ========================================================================
    if ($status != "") {
        if (array_key_exists($status,$error_messages[$lang])) {
            $info['error'] = $error_messages[$lang][$status];
        }
        else {
            $info['error'] = $error_messages[$lang]['unknown'];
        }
    }

    # ========================================================================
    # send info back to client
    # ========================================================================
    echo json_encode($info);
?>