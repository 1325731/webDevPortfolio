<?php
$test_dir = __DIR__;
require("$test_dir/test_framework.php");

$log_file = "$test_dir/test_error_handling_log.log";
$store = 'store_message';
$fetch = 'get_latest_messages';
$connect = 'connect';

# --------------------------------------------------------------------------
# Set up initial state
# --------------------------------------------------------------------------
# use a special log file for this
ini_set('error_log',$log_file);
error_reporting(E_ALL);  

    
# =====================================================================
# Testing Model/DB_User.php
# =====================================================================
echo "\n\nTESTING Model/DB_message.php\n";
    
# --------------------------------------------------------------------------
# Do I have the required files and functions?
# --------------------------------------------------------------------------
$files_ok = 0;
$functions_ok = 0;

$files_ok += include_ok("$test_dir/../Model/DB_message.php", "Include File to Test");
$files_ok += include_ok("$test_dir/../Model/DB_user.php", "Include File to Test");

if ($files_ok != 2) {
    bail_out('Could not include all files');
}

$functions_ok += isa_function($connect,"'$connect' function exists");
$functions_ok += isa_function($store,"'$store' function exists");
$functions_ok += isa_function($fetch, "'$fetch' function exists");

if ($functions_ok != 3) {
    bail_out('Missing some functions');
}


# --------------------------------------------------------------------------
# SETUP - EMPTY DEVA OF ALL DATA
# --------------------------------------------------------------------------
# set up the test databases devA and devB
`mysql -u root < $test_dir/create_db.sql`;

# connect to the database 'devA';
try {
    $dbh = connect('devA');
}
catch (Exception $e) {
    bail_out('Could not connect to devA - Aborting tests');
}

# --------------------------------------------------------------------------
# SETUP - create two new users 'Sandy' & 'Bob'
# --------------------------------------------------------------------------
$result = user_create($dbh,'sandy','sandy','sandy@sandy');
is ($result,DB_USER_SUCCESS,"Create user");
$result = user_create($dbh,'bob','bob','bob@bob');
is ($result,DB_USER_SUCCESS,"Create user");

# --------------------------------------------------------------------------
# bob send a message, do sandy & bob both get those messages?
# --------------------------------------------------------------------------
store_message($dbh,'Bob','This is message 1');
store_message($dbh,'Bob','This is message 2');

# currently two messages sent, neither sandy nor bob 
# have read either of them

$msgs = get_latest_messages($dbh,'x','bob'); # invalid input for hours
is ($msgs[0]['user'],'bob','user msg1 is bob');
is ($msgs[0]['msg'],'This is message 1','user msg1 is correct');
is ($msgs[1]['user'],'bob','user msg2 is bob');
is ($msgs[1]['msg'],'This is message 2','user msg2 is correct');

$msgs = get_latest_messages($dbh,1,'sandy'); 
is ($msgs[0]['user'],'bob','user msg1 is bob');
is ($msgs[0]['msg'],'This is message 1','user msg1 is correct');
is ($msgs[1]['user'],'bob','user msg2 is bob');
is ($msgs[1]['msg'],'This is message 2','user msg2 is correct');

# at this point, bob and sandy have both read messages
# one and two

# --------------------------------------------------------------------------
# sandy sends a message and bob reads it
# - does bob only get the latest message?
# --------------------------------------------------------------------------

store_message($dbh,'sandy','This is message 3');

# at this point three messages are stored, bob and
# sandy have both read the first two 
$msgs = get_latest_messages($dbh,1,'bob');
is (count($msgs),1,'bob received 1 message');
is ($msgs[0]['msg'],'This is message 3','bob received correct message');

# at this point three messages are stored, bob has
# read message 3, and sandy has read up to message 2

# --------------------------------------------------------------------------
# bob replies 
# - does bob only get the one message, and sandy the last two?
# --------------------------------------------------------------------------
store_message($dbh,'bob','This is message 4');
echo"\n\nStoring message 4\n";

# at this point four messages are stored, bob has
# read message 3, and sandy has read up to message 2

$msgs = get_latest_messages($dbh,1,'bob');
is (count($msgs),1,'bob received his reply');
is ($msgs[0]['msg'],'This is message 4','bob received correct message');

$msgs = get_latest_messages($dbh,1,'sandy');
is (count($msgs),2,'sandy receive two messages');
is ($msgs[0]['msg'],'This is message 3','sandy received message 3');
is ($msgs[1]['msg'],'This is message 4','sandy received message 4');

# at this point four messages are stored, bob and
# sandy have read all four

# --------------------------------------------------------------------------
# no messages returned, empty array?
# --------------------------------------------------------------------------
$msgs = get_latest_messages($dbh,1,'sandy');
is (count($msgs),0,'no more messages to get');

