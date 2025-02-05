<!-- Session start sempre all'inizio del file  --> 
<?php
session_start();
require_once('registrati.php'); // eventuale implementazione con i file

if (isset($_SESSION['session_id'])) 
{
    header('Location: ../prenotazione.php');  // Se la sessione_id ha un valore allora si è effettuato il login
}
?>


<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>LOGIN ESEGUITO</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png><link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)"></head>

<body><div class=content>

<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header><br><br>


<main><article><div class=title><h2 class=title>Login</h2><div class=meta>Posted on Dic 13, 2021</div></div>



<?php

if (isset($_POST)) 
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    if (empty($email) || empty($password)) 
	{
        $msg = 'Inserisci email e password %s';
    } 
	else 
	{
        
		// Mysql da implementare
		
		/*$query = "
            SELECT username, password
            FROM users
            WHERE username = :username
        ";
        
        $check = $pdo->prepare($query);
        $check->bindParam(':username', $username, PDO::PARAM_STR);
        $check->execute();
        
        $user = $check->fetch(PDO::FETCH_ASSOC);*/
		
		// Copiato il vettore di REGISTRAZIONE - Struttura non molto sensata, occorre FILE oppure DATABASE
		$registrati = array ("marco.aquilanti@iismarconipieralisi.it" => array ("maquilanti", "qwertyuiop"),
					"prova@prova.com" => array ("prova","qwertyuiop")
					);
					
		// Conversione in hash della password - Non utilizzata perché i vettori non sono strutture statiche - utilizzata in login.php
		
		// La funzioni di hash sono algoritmi matematici in grado di convertire una stringa di dimensioni variabili 
		// (nel nostro caso la password) in una di dimensioni fisse detta hash, composta da caratteri alfanumerici casuali.
		// rif: https://www.flaviobiscaldi.it/blog/memorizzare-password-utenti-php-con-password-hash
		$hash = password_hash($registrati[$email][1], PASSWORD_BCRYPT);
    	
		// Controllo se presente la chiave $email nell'array e se la password è verificata
        if (array_key_exists($email, $registrati) && password_verify($password, $hash))
        {
			
			// Generazione del ID di sessione
            session_regenerate_id();
			
			// Elementi di sessione: Session_ID e nome
            $_SESSION['session_id'] = session_id();
            $_SESSION['session_user'] = $registrati[$email][0];
			
			
			// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
			// Si passa a prenotazione.php - sessione solo per autenticati
            header('Location: ../prenotazione.php');            
			
        } 
		else 
		{
			echo "Non valido <a href=\"../login.html\">torna indietro</a>";
		}	
    }
    
    
}
?>


<div class=post-tags></div></article></main>

<br><br>
<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>