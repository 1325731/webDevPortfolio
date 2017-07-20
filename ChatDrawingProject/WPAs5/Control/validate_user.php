<?php
    # ========================================================================
    # validate_user.php
    # ========================================================================
    # PURPOSE:
    # Verifies that all information that is required for user validation is
    # present, and returns info to the client via a JSON string.
    #
    # INPUTS: by POST
    # action:   "login" or "create_user"
    # user:     "username"
    # pass:     "password"
    # email:    "email" (only for create_user)
    # vMail:    (Validates Email. Currently available: True/False)  (only for create_user)
    # database: (defaults to 'Production')
    # lang:     (defaults to 'English'.  Currently available: French/English)
    #
    # OUTPUTS (JSON string):
    # user: username   # only set if user was created or logged in
    # error: error string # set to empty string if no error
    #
    # VERSION 1.0 - July 2016 - Sandy Bultena
    # ========================================================================
    error_reporting(E_ALL);
    ini_set('display_errors','On');
    
    session_start();
    $_SESSION['LAST_ACTIVITY'] = time();
    
    $info["error"] = "";
    $info["user"] = "";
    
    # ========================================================================
    # get Model files, and set up error handling
    # ========================================================================
    $dir = __DIR__;
    require ("$dir/../Model/DB_user.php");
    require ("$dir/../Model/DB_error_handling.php");
    set_exception_handler('DBexceptionHandler');
    # set_error_handler('DBerrorHandler'); uncomment this during production mode
    # register_shutdown_function('DBshutDownFunction'); uncomment this for production mode
    
    $error_messages = array(
        'English'=>array(
            DB_USER_INVALID_INPUTS => 'There is missing information',
            DB_USER_NAME_TAKEN => 'User name is already taken',
            DB_USER_PASSWORD_INVALID => 'Invalid username/password',
            DB_USER_NOT_EXIST => 'Invalid username/password',
            'unknown' => 'An unknown error has occured',
            'server_error' => 'Server is down, please try again later',
            'missing_input' => 'There is missing information',
            'missing_email' => 'Email address is not defined',
            'missing_user' => 'Username is not defined',
            'missing_password' => 'Password is not defined',
            'email_invalid' => 'Email address is invalid (EX: email@hotmail.com)',
            'no_action' => 'What, exactly, do you want me to do!'
            ),
        'French'=>array(
            DB_USER_INVALID_INPUTS => 'Il y a des informations manquantes',
            DB_USER_NAME_TAKEN => 'Nom d\'utilisateur est déjà pris',
            DB_USER_PASSWORD_INVALID => 'Invalid nom d\'utilisateur / mot de passe',
            DB_USER_NOT_EXIST => 'Invalid nom d\'utilisateur / mot de passe',
            'unknown' => 'Une erreur inconnue est survenue',
            'server_error' => 'Server ne marche pas, s\'il vous plaît réessayer plus tard',
            'missing_input' => 'Il y a des informations manquantes',
            'missing_email' => 'Courriel ne se définit pas',
            'missing_user' => 'Nom d\'utilisateur est pas défini ',
            'missing_password' => 'Mot de passe est pas défini ',
            'email_invalid' => 'Courriel est invalide (EX: courriel@hotmail.com)',
            'no_action' => 'Qu\'est-ce, exactement, voulez-vous que je fasse !'
            )
        );

    # ========================================================================
    # Extract all the post variables
    # ========================================================================
    extract($_POST, EXTR_PREFIX_ALL, "P");

    # ========================================================================
    # which database to use?
    # ========================================================================
    $database = 'Production';
    if (isset($_POST['database'])) {
        $database = $_POST['database'];
    }

    # ========================================================================
    # which language to use?
    # ========================================================================
    $lang = 'English';
    if (isset($_POST['lang']) && array_key_exists($lang,$error_messages)) {
        $lang = $_POST['lang'];
    }

    # ========================================================================
    # was the required data defined?
    # ========================================================================
    $status = "";
    if (empty($_POST['user'])) {
        $status = "missing_user";
    }
    if (empty($_POST['pass'])) {
        $status = "missing_password";
    }

    # ========================================================================
    # Log in or create user
    # ========================================================================
    if (! $status ) {
        try {
            if (isset($_POST['action']) && $_POST['action'] == "login") {
                $dbh = connect($database);
                $status = user_login($dbh, $_POST['user'], $_POST['pass']);
            }
            elseif (isset($_POST['action']) && $_POST['action'] == "create_user") {
                if (empty($_POST['email'])) {
                    $status = "missing_email";
                }
                elseif ($_POST['vmail'] == "false") {
                    $status = "email_invalid";
                }
                else {
                    $dbh = connect($database);
                    $status = user_create($dbh, $_POST['user'],$_POST['pass'],$_POST['email']);
                }
            }
            elseif (isset($_POST['action']) && $_POST['action'] == "logout") {
                session_destroy();
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
    # Successfully logged in? - yes set user info, save session info
    # ========================================================================
    if ($status === DB_USER_SUCCESS) {
        $info['user'] = $_POST['user'];
        $info['error']="";
        $_SESSION['user'] = $_POST['user'];
    }
    
    # ========================================================================
    # Failure to log in - set error message, unset session variable 'user'
    # ========================================================================
    else {
        if (array_key_exists($status,$error_messages[$lang])) {
            $info['error'] = $error_messages[$lang][$status];
        }
        else {
            $info['error'] = $error_messages[$lang]['unknown'];
        }
        $info['user']="";
        unset($_SESSION['user']);
    }

    # ========================================================================
    # send info back to client
    # ========================================================================
    echo json_encode($info);
?>