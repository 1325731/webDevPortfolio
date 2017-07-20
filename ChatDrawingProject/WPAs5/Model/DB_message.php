<?php
    $dir = __DIR__;
    error_reporting(E_ALL);
    require_once ("$dir/../Model/DB.php");

    # throw exceptions if there is a problem
    mysqli_report(MYSQLI_REPORT_ALL);
    //mysqli_report(MYSQLI_REPORT_STRICT ^ MYSQLI_REPORT_INDEX);

    # ========================================================================
    # DB_messages.php: All functions for storing and retrieving messages
    # October 2016 - S. Bultena
    # ========================================================================

    # ===========================================================================
    # store_message
    # ===========================================================================
    # purpose: save the message in the database
    # inputs: database handle
    #         user name (case insensitive)
    #         message
    # returns: nothing 
    # errors: Throws an exception if there is a database error
    # ---------------------------------------------------------------------------
    function store_message($dbh, $user, $msg) {
        
        $max_msg_length = 256; # change this if you change the database
        
        # -----------------------------------------------------------------------
        # user name is case insensitive, so set to lower case
        # -----------------------------------------------------------------------
        $user = strtolower($user);
        
        # -----------------------------------------------------------------------
        # truncate message if necessary
        # -----------------------------------------------------------------------
        $msg = (strlen($msg) > $max_msg_length) 
            ? substr($msg,0,($max_msg_length - 4)) . ' ...' 
            : $msg;
        
        # -----------------------------------------------------------------------
        # define the sql for insertion
        # -----------------------------------------------------------------------
        $sth = $dbh-> prepare("INSERT INTO messages (username,message,moment) VALUES (?,?,date_sub(now(),interval 5 HOUR))");
        
        $sth->bind_param("ss",$user,$msg);
        $sth->execute();

    }
    
    # ===========================================================================
    # get_latest_messages
    # ===========================================================================
    # purpose: for this particular user, get all the messages that she has not
    #          read in the last x hours
    #          ... in other words, only those messages that arrived over the last
    #              x hours that this user has not read
    # inputs: database handle
    #         hours  (messages returned have been posted within these many hours)
    #         user name (case insensitive)
    # returns: array of messages that looks like:
    #          array (
    #                array (moment=>? user=>?, msg=>?),
    #                array (moment=>? user=>?, msg=>?),
    #                )
    # errors: Throws an exception if there is a database error
    # ---------------------------------------------------------------------------
    function get_latest_messages($dbh, $hours, $user) {
        
        # -----------------------------------------------------------------------
        # Basic Algorithm for this:
        # - the last message that was seen by this user is stored in the 
        #   user table (column: last_msg_seen)
        # 1) get the last_msg_seen from table user
        # 2) make sure that $hours is a valid integer, otherwise default to 2 hours
        # 3) query table messages for all messages 
        #    3.1) less than $hours old, and 
        #    3.2) where the id is greater than the last_msg_seen retreived from step 1
        # 4) determine the maximum_message_id while fetching the data
        # 5) update table user so that the last_msg_seen for this user
        #    is maximum_message_id
        # -----------------------------------------------------------------------

        # -----------------------------------------------------------------------
        # user name is case insensitive, so set to lower case
        # -----------------------------------------------------------------------
        $user = strtolower($user);
        
        # -----------------------------------------------------------------------
        # get the id of the last message sent to this user
        # -----------------------------------------------------------------------
        $sql = "select last_msg_seen from user where username = ?";
        $sth = $dbh->prepare($sql);

        $sth->bind_param("s",$user);
        $sth->bind_result($db_last_msg_seen);
        $sth->execute();

        # get results
        $sth->fetch();
        $sth->close();
        
        # make sure last message seen is not null
        if (! isset($db_last_msg_seen)) {$db_last_msg_seen = 0;}

        # -----------------------------------------------------------------------
        # create an array of all messages to be returned
        # -----------------------------------------------------------------------
        $msgs = array();
        
        # set the hours_ago to a valid integer
        $hours_ago = 2;
        if (is_numeric($hours)) {
            $hours_ago = $hours;
        }
        
        # prepare the query ( get messages that user has not already seen)
        $sql = "select id,username,message,moment from messages where moment > date_sub(now(),interval 5 HOUR)-interval $hours_ago hour and id > ? order by id";
        $sth = $dbh->prepare($sql);
        
        # bind and execute
        $sth->bind_param("i",$db_last_msg_seen);
        $sth->bind_result($db_id,$db_user,$db_msg,$db_moment);
        $sth->execute();
        
        # get the messages, and store results in output array;
        $max_id = 0;
        while ($sth->fetch()) {
            $msgs[] = array('moment'=>$db_moment,'user'=>$db_user,'msg'=>$db_msg);
            $max_id = $db_id;
        }
        
        # -----------------------------------------------------------------------
        # update the last_msg_seen for this user
        # -----------------------------------------------------------------------
        $sql = "update user set last_msg_seen = $max_id where username = ?";
        $sth->prepare($sql);
        $sth->bind_param("s",$user);
        $sth->execute();

        # -----------------------------------------------------------------------
        # return the results
        # -----------------------------------------------------------------------
        return $msgs;

    }

?>