<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>Metodo POSTBACK</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png><meta name=viewport content="width=device-width,initial-scale=1"><meta name=description content="Here is a demo of all shortcodes available in Hugo."><meta property="og:image" content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png"><meta property="og:title" content="Hugo shortcodes"><meta property="og:description" content="Here is a demo of all shortcodes available in Hugo."><meta property="og:type" content="article"><meta property="og:url" content="https://athul.github.io/archie/posts/post-6/"><meta property="article:published_time" content="2020-04-15T12:13:36+05:30"><meta property="article:modified_time" content="2020-04-15T12:13:36+05:30"><meta name=twitter:card content="summary"><meta name=twitter:title content="Hugo shortcodes"><meta name=twitter:description content="Here is a demo of all shortcodes available in Hugo."><script src=https://athul.github.io/archie/js/feather.min.js></script><link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)">
<style>
.error {color: #FF0000;}
</style>
</head>

<body><div class=content>

<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header>


<main><article><div class=title><h1 class=title>Metodo POSTBACK</h1><div class=meta>Posted on Nov 30, 2021</div></div>
<p>I dati inviati dal form vengono <b>inviati ed elaborati nella stessa pagina<b/></p>

<?php
// Definizione di variabile utilizzate nel form e inizializzate vuote
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";


// Utilizzo della variabile SUPERGLOBAL $_SERVER["REQUEST_METHOD"]
// Controllo sul metodo utilizzato (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Se la variabile "name" è vuota (cioè nessun valore inserito dall'utente nel form)
		// visualizza il messaggio a schermo " Campo Obbligatorio" 
  if (empty($_POST["name"])) {
    $nameErr = " Campo Obbligatorio";
  } else {
    $name = test_input($_POST["name"]);
    // Controllo se il name contiene solamente caratteri da a-z, da A-Z e spazio
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Inserire solo caratteri alfabetici e spazio";
    }
  }
  
  if (empty($_POST["email"])) {
    $emailErr = " Campo Obbligatorio";
  } else {
    $email = test_input($_POST["email"]);
    // Cotrolla se la mail ha una giusta sintassi
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Formato email non valido";
    }
  }
    
  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    // Controlla se la sintassi dell'indirizzo URL (this regular expression also allows dashes in the URL)
    if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
      $websiteErr = "URL non valido";
    }
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = " Campo OBBLIGATORIO";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

// Funzione per il controllo della email
function test_input($data) {
  // trim — Elimina gli spazi bianchi (o altri caratteri) dall'inizio e dalla fine di una stringa
  $data = trim($data);
  
  // stripslashes - Restituisce una stringa senza / (backslash) - I doppi backslash si riducono a 1
  $data = stripslashes($data);
  
  // htmlspecialchars - Converte alcuni caratteri predefiniti in entità HTML
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>Esempio di validazione dati PHP </h2>
<p><span class="error"> Campo OBBLIGATORIO</span></p>

<!-- Nella action invece di richiamare un nuovo file si richiama la variabile SUPERGLOBAL $_SERVER, con chiave PHP_SELF 
 -->

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Name: <input type="text" name="name" value="<?php echo $name;?>">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  E-mail: <input type="text" name="email" value="<?php echo $email;?>">
  <span class="error">* <?php echo $emailErr;?></span>
  <br><br>
  Website: <input type="text" name="website" value="<?php echo $website;?>">
  <span class="error"><?php echo $websiteErr;?></span>
  <br><br>
  Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Femminile") echo "checked";?> value="Femminile">Femminile
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Maschile") echo "checked";?> value="Maschile">Maschile
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="Altro") echo "checked";?> value="Altro">Altro 
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Invia">  
</form>

<?php

// Verifica se è il primo accesso alla variabile SUPERGLOBAL $_POST
// Se contiene TRUE significa che contiene dei valori, il modulo è stato inviato
// altrimenti, se FALSE, non è stato utilizzato il metodo POST
if ($_POST)
{
	echo "<h2>Questi sono i dati da te inseriti:</h2>";
	echo "NOME: ";
	if (empty($nameErr)) echo "<b> $name </b>";	
					else echo "<b><span class=\"error\">Non accettato</span></b>";
	 
	echo "<br>";
	echo "E-MAIL: ";
	if (empty($emailErr)) echo "<b> $email </b>";	
					else echo "<b><span class=\"error\">Non accettato</span></b>";
	echo "<br>";
	echo "WEBSITE: ";
	if (empty($websiteErr)) echo "<b> $website </b>";	
					else echo "<b><span class=\"error\">Non accettato</span></b>";
	echo "<br>";
	echo "COMMENTO: ";
	echo "<b> $comment </b>";
	echo "<br>";
	echo "GENDER: ";
	if (empty($genderErr)) echo "<b> $gender </b>";	
					else echo "<b><span class=\"error\">Non accettato</span></b>";
}					
?>

<br><br>
<ul class=pagination><span class="page-item page-prev"></span><span class="page-item page-next">
<a href="/php_sito/download/esempio_postback.TXT" download class=page-link aria-label=Next>
<span aria-hidden=true>Download pagina CODICE →</span></a></span></ul>

<div class=post-tags></div></article></main>


<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>