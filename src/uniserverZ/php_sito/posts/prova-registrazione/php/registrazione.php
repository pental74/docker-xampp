<!doctype html><html>

<head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>Pagina Login</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png>
<link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)">
</head>

<body><div class=content>

<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header><br><br>


<main><article><div class=title><h2 class=title>Esercizio Gestione sessione e Login</h2><div class=meta>Posted on Dic 13, 2021</div></div>


<?php
// eventuale utilizzo di una struttura a file per controllare le password
require_once('registrati.php');

if (isset($_POST)) 
{
    $name = $_POST['name'];
	$email = $_POST['email'];
    $password = $_POST['password'];
    
	// eventuale controllo su email da modificare
	/*$isUsernameValid = filter_var(
        $email,
        FILTER_VALIDATE_REGEXP, [
            "options" => [
                "regexp" => "/^[a-z\d_]{3,20}$/i"
            ]
        ]
    );*/
	
	// in $pwdLenght lunghezza della password
    $pwdLenght = mb_strlen($password);
    
	// Controllo sulla presenza dei campi - non necessario se si utilizza HTML5 required nel form
    /*if (empty($name) || empty($password) || empty($email)) {
        $msg = 'Compila tutti i campi %s';
    } */
	
	/*elseif (false === $isUsernameValid) {
        $msg = 'Lo username non è valido. Sono ammessi solamente caratteri 
                alfanumerici e l\'underscore. Lunghezza minina 3 caratteri.
                Lunghezza massima 20 caratteri';
    }*/
	
	// Controllo sulla lunghezza della password
	if ($pwdLenght < 8 || $pwdLenght > 20) 
	{
        $msg = 'Lunghezza minima password 8 caratteri.
                Lunghezza massima 20 caratteri';
    } 
	
	else 
	{
        // Conversione in hash della password - Non utilizzata perché i vettori non sono strutture statiche - utilizzata in login.php
		
		// La funzioni di hash sono algoritmi matematici in grado di convertire una stringa di dimensioni variabili 
		// (nel nostro caso la password) in una di dimensioni fisse detta hash, composta da caratteri alfanumerici casuali.
		
		// $password_hash = password_hash($password, PASSWORD_BCRYPT);

		// Eventuale implementazione con DATABESE
		/*    $query = "
            SELECT id
            FROM users
            WHERE username = :username
        ";
		*/
		
		// controllo se nel vettore c'è la mail registrata
		$registrati = array ("marco.aquilanti@iismarconipieralisi.it" => array ("maquilanti", "qwertyuiop"),
					"prova@prova.com" => array ("prova","qwertyuiop")
					);
					
		// FUNZIONI DI RICERCA NEGLI ARRAY			
		// in_array - valida solo per vettori monodimensionali
		// array_key_exists - valida per array multidimensionali
		if (array_key_exists($email, $registrati)) $msg = 'Username già in uso %s';
		else 
		{
				// inserimento nel vettore dei nuovi dati di registrazione - purtroppo con una struttura non permanente come gli
				// array la registrazione non funziona - DA PROVAREE IN UNA PAGINA UNICA CON POSTBACK
				$registrati[$email][0]= $name;
				$registrati[$email][1]= $password;
				//$registrati[$email][2]= $password_hash;
				
				/* Collegamento a DATABASE - non implementato
				$query = "
					INSERT INTO users
					VALUES (0, :username, :password)
				";
			
				$check = $pdo->prepare($query);
				$check->bindParam(':username', $username, PDO::PARAM_STR);
				$check->bindParam(':password', $password_hash, PDO::PARAM_STR);
				$check->execute();
				
				if ($check->rowCount() > 0) $msg = 'Registrazione eseguita con successo';
             	else $msg = 'Problemi con l\'inserimento dei dati %s';*/
				
				$msg = $registrati[$email][0]." - Registrazione eseguita con successo <br> Ora effettua il <a href=\"../login.html\">LOGIN</a> per accedere alla funzionalità di prenotazione";
		}
			
    }
    
    printf($msg, '<a href="../registrazione.html">torna indietro</a>');
}
else echo "non sono entrato";
?>


<div class=post-tags></div></article></main>

<br><br>
<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>