<?php
    # =========================================================================
    # connect to database
    # =========================================================================
    # purpose: 
    #          1) If previously connected to a different database than the one
    #             requested, close the previous database connection.
    #          2) Connect to the requested database
    # inputs: none
    # outputs: database handle
    # errors: Throws an exception if there is a database error
    # ---------------------------------------------------------------------------
    function connect ($database = "chat")
    {
        static $old_db, $dbh;
        
        # close previous connection if we are switching databases;
        if (isset($dbh) && $old_db != $database) {
            try { $dbh->close();}
            catch (Exception $e) {$dbh = "";}
        }
        
        # set info
        $servername = getenv("IP");
        $username = getenv("C9_USER");
        $password = "";
        $dbport = "3306";
        
        $dbh = new mysqli("p:".$servername, $username, $password, $database, $dbport);
        $old_db = $database;
        
        # return connection object
        return $dbh;
    }
?>
