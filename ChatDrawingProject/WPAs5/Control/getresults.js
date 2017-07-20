$(document).ready(function() {
    $( "#msgfromusr" ).keypress(function(e) {
        if(e.which == 13) {
            $("#sendmsg").click();
        }
    }); 
    
	//Load the file containing the chat log
	function loadLog(){		
		$.ajax({
			url: "../Control/log.html",
			cache: false,
			success: function(html){		
				$(".messagelist").html(html); //Insert chat log into the .messagelist div	
			},
		});
	}
	setInterval (loadLog, 250);	//Reload file every .25 seconds
});

/********************\
|   login Function   |
| ------------------ |
| Extracts input     |
| values and posts   |
| to validate_user,  |
| which then deals   |
| with the database  |
| so database things |
| happen.            |
\********************/
function login() {
    
    /*  Declaring Variables
        -------------------  */
    var action = "login";
    var database = "devA";
    var user = $( "#user" ).val();
    var pass = $( "#pass" ).val();
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "French";
        var txtUser = "Redirection en 2 secondes<br>Nom d'utilisateur: ";
        var txtError = "Erreur: ";
    } else {
        lang = "English";
        var txtUser = "Redirecting in 2 seconds<br>Username: ";
        var txtError = "Error: ";
    }
    
    /*  Post Method to Controller; Validate User 
        ----------------------------------------  */
    $.post( "../Control/validate_user.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { action: action, user: user, pass: pass, database: database, lang: lang }) 
    
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        var r = JSON.parse(data); // Parse incoming JSON data
        
        if (r.error == "") { // If there was no ERRORs.
            $( "#msg" ).show();
            $( "#msg" ).html(txtUser + r.user + "<br>"); // Print the username to the user
            setTimeout(function(){ document.location.href = "index.php?lang=" + lang.toLowerCase(); }, 2000);
        }
        else {
            $( "#msg" ).show();
            $( "#msg" ).html(txtError + r.error + "<br>"); // Otherwise, print the error
        }
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}

/*******************\
|  logout Function  |
| ----------------- |
| Logs user out and |
| destroys session. |
\*******************/
function logout() {
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "french";
    } else {
        lang = "english";
    }
    
    $.post( "../Control/validate_user.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { action: "logout" }) 
    /*  Done Method 
        -----------  */
    .done(function() {
        document.location.href = "index.php?lang=" + lang;
    });
}

/********************\
|  Connect Function  |
| ------------------ |
| Allows the user    |
| to join a chat.    |
\********************/
function connect() {
    var online = $( "#online" ).val();
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        var txtError = "Erreur: Non connecté. Avant de connecter s'il vous plaît connecter.";
    } else {
        var txtError = "Error: Not logged in. Please log in before connecting.";
    }
    
    if (online.length > 0) {
        $( "#connect" ).fadeOut(1000);
        setTimeout(function(){ 
            
        }, 1000);
    } else {
        $( "#msg" ).show();
        $( "#msg" ).html(txtError + "<br>"); // Print the username to the user
        
    }
}


/********************\
|  Create Function   |
| ------------------ |
| Extracts input     |
| values and posts   |
| to validate_user,  |
| which then deals   |
| with the database  |
| so database things |
| happen.            |
\********************/
function create() {
    
    /*  Declaring Variables
        -------------------  */
    var action = "create_user";
    var database = "devA";
    var user = $( "#user" ).val();
    var pass = $( "#pass" ).val();
    var mail = $( "#mail" ).val();
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "French";
        var txtUser = "Redirection en 2 secondes<br>Nom d'utilisateur: ";
        var txtError = "Erreur: ";
    } else {
        lang = "English";
        var txtUser = "Redirecting in 2 seconds<br>Username: ";
        var txtError = "Error: ";
    }
    
    var testEmail = validateEmail(mail); // Calls an outside function to validate the email
    
    /*  Post Method to Controller; Validate User 
        ----------------------------------------  */
    $.post( "../Control/validate_user.php", 
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { action: action, user: user, pass: pass, email: mail, vmail: testEmail, database: database, lang: lang }) 
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        var r = JSON.parse(data);
        
        if (r.error == "") { // If there was no ERRORs.
            $( "#msg" ).show();
            $( "#msg" ).html(txtUser + r.user + "<br>"); // Print the username to the user
            setTimeout(function(){ document.location.href = "index.php?lang=" + lang.toLowerCase(); }, 2000);
        }
        else {
            $( "#msg" ).show();
            $( "#msg" ).html(txtError + r.error + "<br>"); // Otherwise, print the error
        }
    })
    
    
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}


/*******************\
|   ValidateEmail   |
| ----------------- |
| Uses regex to     |
| validate emails.  |
\*******************/
function validateEmail(email) {
    // Complex regex string.
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    // Returns after using an internal function; test with the regex string on input parameter; email.
    return re.test(email);
}

/********************\
|   store Function   |
| ------------------ |
| Extracts input     |
| values and posts   |
| to store_message,  |
| which then deals   |
| with the database  |
| so database things |
| happen.            |
\********************/
function storeA() {
    /*  Declaring Variables
        -------------------  */
    var action = "store_message";
    var database = "devA";
    var message = $( "#msgfromusr" ).val();
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "French";
        var txtError = "Erreur: ";
        var emptyError = "Impossible d'entrer des messages";
    } else {
        lang = "English";
        var txtError = "Error: ";
        var emptyError = "Cannot input empty messages";
    }
    var today = '('+new Date().toLocaleString()+')';
    
    if (message == "") {
        $( "#msg" ).html(emptyError); // Output error message
        return;
    }
    
    $( "#msg" ).html(""); // Output error message
    
    /*  Post Method to Controller; Chat box
        -----------------------------------  */
    $.post( "../Control/chat_box.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { action: action, msg: message, database: database, lang: lang  }) 
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        var r = JSON.parse(data);
        
        if (r.error == "") { // If there was no ERRORs.
            $( "#msgfromusr" ).val('');
            receive();
        }
        else {
            $( "#msg" ).show();
            $( "#msg" ).html(txtError + r.error + "<br>"); // Otherwise, print the error
        }
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}

/***********************\
|   receive  Function   |
| --------------------- |
| get messages from the |
| database depending on |
| the hour given and    |
| refreshes the chatbox |
| to display those      |
| messages.             |
\***********************/
function receiveA() {
    
    /*  Declaring Variables
        -------------------  */
    var action = "get_latest_messages";
    var database = "devA";
    var lang = $( "#lang" ).val();
    var hours = 2;
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "French";
        var txtError = "Erreur: ";
    } else {
        lang = "English";
        var txtError = "Error: ";
    }
    
    /*  Post Method to Controller; Chat box
        -----------------------------------  */
    $.post( "../Control/chat_box.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { action: action, hours: hours, database: database, lang: lang  }) 
    
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        var r = JSON.parse(data); // Parse incoming JSON data
        
        if (r.error != "") { // If there was an ERROR.
            $( "#msg" ).html(txtError + r.error + "<br>"); // Otherwise, print the error
        } else {
            $( "#msgfromusr" ).val('');
            // for ever message we got from the database, print them out on the chat box
            for(var count = 0; count < r.messages.length; count++) {
                $("<ul>"+'('+new Date(r.messages[count]["moment"]).toLocaleString()+')'+" "+r.messages[count]["user"]+": "+r.messages[count]["msg"]+"</ul>").appendTo(".messagelist");
            }
            
        }
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}

/***********************\
|   connect  Function   |
| --------------------- |
| Connects the user to  |
| the chat box to begin |
| chatting.             |
\***********************/
function connect() {
    /*  Declaring Variables
        -------------------  */
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        lang = "French";
        var txtError = "Erreur: Pas connecté";
    } else {
        lang = "English";
        var txtError = "Error: Not logged in";
    }
    
    
    $.post( "../Control/get_user.php", { })
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        var r = JSON.parse(data); // Parse incoming JSON data
        
        if (r.user == null || r.user == "") { // If there was no USER
            $( "#msg" ).html(txtError + "<br>"); // Otherwise, print the error
        } else {
            $( "#connect").hide();
            $( ".chatinput").show();
            $( ".messagebox").show();
            //setInterval(function(){ receive(); }, 1000);
        }
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}

/* 













new













*/

/********************\
|   store Function   |
| ------------------ |
| Extracts input     |
| values and posts   |
| to store_message,  |
| which then deals   |
| with the database  |
| so database things |
| happen.            |
\********************/
function store() {
    
    /*  Declaring Variables
        -------------------  */
    var message = $( "#msgfromusr" ).val();
    var lang = $( "#lang" ).val();
    
    // Determining the returned message's language.
    // input "lang's" value is the opposite, so if it's english, the current language is french
    if (lang == "english") { 
        var txtError = "Erreur: ";
        var emptyError = "Impossible d'entrer des messages";
    } else {
        var txtError = "Error: ";
        var emptyError = "Cannot input empty messages";
    }
    
    var today = new Date().toLocaleString();
    
    if (message == "") {
        $( "#msg" ).html(emptyError); // Output error message
        return;
    }
    
    $( "#msg" ).html(""); // Output error message
    
    /*  Post Method to Controller; Chat box
        -----------------------------------  */
    $.post( "../Control/post.php",  
    // POST_VAR: JS_VAR; passing in the javascript values through post
    { text: message, today: today }) 
    
    /*  Done Method 
        -----------  */
    .done(function( data ) {
        $( "#msgfromusr" ).val('');
    })
          
    /*  Fail Method 
        -----------  */
    .fail(function( data ) {
        $( "#msg" ).html("An error has occurred."); // Output error message
    });
}


function openthing() {
    window.open("drawer.php", "", "width=685,height=664");
}