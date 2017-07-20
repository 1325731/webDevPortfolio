<?php
    
    /***********************\
    | Dictionary For Smarty |
    | --------------------- |
    | Assosiative Array     |
    | "words" has two       |
    | arrays; "english" and |
    | "french". They hold   |
    | key words on the site |
    | that are translated.  |
    \***********************/
    $words = array(
        "english"=>array(
            'home'      => "Home",
            'login'     => "Login",
            'create'    => "Create",
            'cuser'     => "Create User",
            'about'     => "About Us",
            'extra'     => "Extra Information",
            'contact'   => "Contact Us",
            'enuser'    => "Enter Username",
            'enpass'    => "Enter Password",
            'enmail'    => "Enter Email",
            'lang'      => "Francais",
            'tolang'    => "french",
            'curlang'   => "english",
            'chatroom'  => "Chat",
            'welchat'   => "Welcome to the chatbox",
            'connect'   => "Connect",
            'logout'    => "Logout",
            'enter'     => "Enter"
        ),
       "french"=>array( 
           'home'       => "Accueil",
            'login'     => "Identifier",
            'create'    => "Creer",
            'cuser'     => "Creer un utilisateur",
            'about'     => "A propos de nous",
            'extra'     => "Informations supplementaires",
            'contact'   => "Contactez nous",
            'enuser'    => "Entrez nom d'utilisateur",
            'enpass'    => "Entrer le mot de passe",
            'enmail'    => "Entrez l'adresse e-mail",
            'lang'      => "English",
            'tolang'    => "english",
            'curlang'   => "french",
            'chatroom'  => "Bavarder",
            'welchat'   => "Bienvenue dans le chatbox",
            'connect'   => "Relier",
            'logout'    => "Déconnexion",
            'enter'     => "Dépose"
        )
    );
    
    /************************************\
    | Assigning the  Smarty Placeholders |
    | ---------------------------------- |
    | Using smarty syntax, we assign     |
    | each placeholder that would show   |
    | up on every page the corresponding |
    | word of the language of choice.    |
    \************************************/
    
    $smarty->assign('Home',     $words[$language][home]);
    $smarty->assign('Login',    $words[$language][login]);
    $smarty->assign('Create',   $words[$language][create]);
    $smarty->assign('CUser',    $words[$language][cuser]);
    $smarty->assign('About',    $words[$language][about]);
    $smarty->assign('Extra',    $words[$language][extra]);
    $smarty->assign('Contact',  $words[$language][contact]);
    $smarty->assign('EnUser',   $words[$language][enuser]);
    $smarty->assign('EnPass',   $words[$language][enpass]);
    $smarty->assign('EnMail',   $words[$language][enmail]);
    $smarty->assign('Language', $words[$language][lang]);
    $smarty->assign('Lang',     $words[$language][tolang]);
    $smarty->assign('CLang',    $words[$language][curlang]);
    $smarty->assign('ChatRoom', $words[$language][chatroom]);
    $smarty->assign('WelChat',  $words[$language][welchat]);
    $smarty->assign('Connect',  $words[$language][connect]);
    $smarty->assign('Logout',   $words[$language][logout]);
    $smarty->assign('Enter',   $words[$language][enter]);

?>