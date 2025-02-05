
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

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

<h2>Esempio di Form di validazione dati PHP </h2>
<p><span class="error"> Campo OBBLIGATORIO</span></p>
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
echo "<b> $comment </b>";
echo "<br>";
echo "GENDER: ";
if (empty($genderErr)) echo "<b> $gender </b>";	
				else echo "<b><span class=\"error\">Non accettato</span></b>";
?>

</body>
</html>
