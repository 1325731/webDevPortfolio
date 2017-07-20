<?php
    $dir = __DIR__;
    error_reporting(E_ALL);
    require_once ("$dir/../Model/DB.php");
    
    # throw exceptions if there is a problem
    mysqli_report(MYSQLI_REPORT_ALL);
    
    # define return constants
    define ("DB_USER_SUCCESS",0);
    define ("DB_USER_INVALID_INPUTS",1);
    define ("DB_USER_NAME_TAKEN",2);
    define ("DB_USER_TOO_MANY_FAILS",3);
    define ("DB_USER_PASSWORD_INVALID",4);
    define ("DB_USER_NOT_EXIST",5);
    
    # define lock_out conditions
    define ("DB_USER_MAX_FAILS",5); # how many times can some mess up before being locked
    define ("DB_USER_LOCK_OUT_TIME",60);  # seconds

    # ========================================================================
    # User.php: All functions for authentication and creation of a user
    # July 2016 - S. Bultena
    # ========================================================================


    # ===========================================================================
    # user_login
    # ===========================================================================
    # purpose: validates the username/password combination
    # inputs: database handle
    #         user name
    #         user password
    # returns: DB_USER_SUCCESS if user's name/password is valid
    #          DB_USER_NOT_EXIST if there is no user with name '$name'
    #          DB_USER_PASSWORD_INVALID if the password is invalid for user '$name'
    # errors: Throws an exception if there is a database error
    # ---------------------------------------------------------------------------
    function user_login ($dbh, $name, $password) {

        # -----------------------------------------------------------------------
        # user name is case insensitive, so set to lower case
        # -----------------------------------------------------------------------
        $name = strtolower($name);
        
        # -----------------------------------------------------------------------
        # query the db for the user, password
        # -----------------------------------------------------------------------
        $sql = "select username, password from user where username=?";
        $sth = $dbh->prepare($sql);

        $sth->bind_param("s",$name);
        $sth-> bind_result($db_user, $db_password);
        $sth->execute();

        # get results
        $sth->fetch();
        $sth->close();
        
        # -----------------------------------------------------------------------
        # check username returned from database, if nothing returned, user
        # does not exist
        # -----------------------------------------------------------------------
        if (! $db_user) {
            return DB_USER_NOT_EXIST;
        }

        # -----------------------------------------------------------------------
        # check password
        # -----------------------------------------------------------------------
        if ( $password == $db_password) {
            return DB_USER_SUCCESS;
        }
        
        # -----------------------------------------------------------------------
        # password is invalid
        # -----------------------------------------------------------------------
        else {
            return DB_USER_PASSWORD_INVALID;
        }
        
    }
    
    # ===========================================================================
    # user_create
    # ===========================================================================
    # purpose: creates a new use in the database IF that username does not
    #          already exist
    # inputs: database handle
    #         new user name
    #         new user password
    #         new user email
    # returns: 
    #          DB_USER_SUCCESS if user account created
    #          DB_USER_INVALID_INPUTS if invalid inputs 
    #               (one of $name, $email, $password not set)
    #          DB_USER_NAME_TAKEN if cannot create user because user name
    #               already exists
    # errors: Throws an exception if there is a database error
    # ---------------------------------------------------------------------------
    function user_create ($dbh, $name, $pass, $email) {
        
        # -----------------------------------------------------------------------
        # user name is case insensitive, so set to lower case
        # -----------------------------------------------------------------------
        $name = strtolower($name);
        
        # -----------------------------------------------------------------------
        # All inputs are mandatory
        # -----------------------------------------------------------------------
        if (empty($name) || empty($pass) || empty($email)) {
            return DB_USER_INVALID_INPUTS;
        }
        
        # -----------------------------------------------------------------------
        # does a user already exist with this name?
        # -----------------------------------------------------------------------
        if ( user_exists($dbh, $name)) {
            return DB_USER_NAME_TAKEN;
        }
        
        # -----------------------------------------------------------------------
        #  add user to the database
        # -----------------------------------------------------------------------
        
        $sth = $dbh-> prepare("INSERT INTO user (username,email,password) VALUES (?, ?, ?)");
        $sth-> bind_param("sss", $name, $email, $pass);
        $sth-> execute();

        return DB_USER_SUCCESS;
        
    }

    # =========================================================================
    # user_exist
    # =========================================================================
    # purpose: given a user name, return the user info
    # inputs: database handle
    #         user name
    # outputs: true or false
    # errors: Throws an exception if there is a database error
    # -------------------------------------------------------------------------
    function user_exists($dbh, $name) {
        
        # -----------------------------------------------------------------------
        # query the db for the user
        # -----------------------------------------------------------------------
        $sql = "select username from user where username=?";
        $sth = $dbh->prepare($sql);
        $sth->bind_param("s",$name);
        $sth->bind_result($db_user);
        $sth->execute();

        # get results
        $sth->fetch();
        $sth->close();
        
        if (empty($db_user)) {
            return FALSE;
        }
        else {
            return TRUE;
        }
    }

    
?>