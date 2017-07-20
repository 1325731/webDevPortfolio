<?php
    session_start();
    
    $page       = $Page;
    $Page       = $words[$language][$Page];
    $CLang      = $words[$language][curlang];
    $Home       = $words[$language][home];
    $Login      = $words[$language][login];
    $Logout     = $words[$language][logout];
    $Create     = $words[$language][create];
    $ChatRoom   = $words[$language][chatroom];
    $Language   = $words[$language][lang];
    $Lang       = $words[$language][tolang];
    
    $Disabled[$page]  = "id=\"sel\" disabled";
    
    $login  = "<a href=\"login.php?lang=$CLang\"><button ". $Disabled[login].">$Login</button></a>";
    $logout     = "<a onclick=\"logout()\"><button id=\"logout\">$Logout</button></a>";
    $create     = "<a href=\"user_create.php?lang=$CLang\"><button ". $Disabled[create] .">$Create</button></a>";
    $username   = "<input type=\"submit\" value=\"". $_SESSION['user'] ."\" id=\"online\" disabled></form>";
    
    if (!isset($_SESSION['user'])) {
        $LoginOrLogout = $login;
        $CreateOrUsername = $create;
    } else {
        $LoginOrLogout = $logout;
        $CreateOrUsername = $username;
    }
    
    $header = 
    "<!DOCTYPE html>
    <meta charset=\"utf-8\" /> 
    <html>
    <head>
    <script src=\"//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js\" type=\"text/javascript\"></script>
    <script src=\"../Control/getresults.js\" type=\"text/javascript\"></script>
    <link rel=\"stylesheet\" href=\"Style/style.css\" type=\"text/css\" />
    <title>KyWill - $Page</title>
    <script type='text/javascript'>
        $(document).ready(function () {
            $(\".body-content\").css(\"transition\", \"all 0.4s 0s ease\");            
            $(\".body-content\").css(\"opacity\", \"1\");
        })
        $(window).on('beforeunload', function () {
            $(\".body-content\").css(\"transition\", \"all 0.4s 0s ease\");
            $(\".body-content\").css(\"opacity\", \"0\");
        });
    </script>
    </head>
    <body>
    <h1>KyWill Gaming Company - <span id=\"page\" class=\"body-content\">$Page</span></h1>
    <nav>
    <a href=\"index.php?lang=$CLang\"><button ". $Disabled[home].">$Home</button></a>
    $LoginOrLogout
    $CreateOrUsername
    <a href=\"chat_room.php?lang=$CLang\"><button ". $Disabled[chatroom] .">$ChatRoom</button></a> 
    <form action=\"?\" method=\"get\"> 
    <input hidden type=\"text\" name=\"lang\" id=\"lang\" value=\"$Lang\" />
    <input hidden id=\"online\"/>
    <input type=\"submit\" value=\"$Language\"></form>
    <img id=\"sprite\" class=\"body-content\" src=\"Image/$Picture.png\" />
    </nav>";
    
    $smarty->assign('Header', $header);
?>