<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<?php
	// Funzione che genera la tabella Auto con una semplice select
	function CaricaTabellaAuto ( $con, $query)
	{
		// Controllo errore di connessione >>  mysqli_connect_errno
	if (mysqli_connect_errno()) 
	{
		  echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");  // mysqli_connect_error() >> tipo di errore
		  exit();
	}
	// Visualizzazione tabella AUTO con semplice SELECT
	if (!$query) $query = "SELECT Targa, Marca, Modello FROM auto";

	//Esecuzione query che restituisce $ris
	$ris = $con->query($query) or die ("Query fallita!");

	//Genero tabella di visualizzazione
	echo "<TABLE id=auto width=90%><TR align=left><TH>Targa</TH><TH>Marca</TH><TH>Modello</TH></TR>";

	//Ciclo foreach legge gli elementi del resultset $ris
	foreach($ris as $riga) 
	{
	   echo "<TR><TD>".$riga["Targa"]."</TD>";
	   echo "<TD>".$riga["Marca"]."</TD>";
	   echo "<TD>".$riga["Modello"]."</TD></TR>";
	}
	echo "</TABLE>";
	}
?>

<title>Connessione DB Mysql</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png>


<link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)">


<style>

#auto {
  border-collapse: collapse;
}

#auto td, #auto th {
  border: 1px solid #ddd;
  padding: 8px;
  vertical-align: top;
}
#table {
	width: 100%;
}

#auto tr:nth-child(even){background-color: #f2f2f2;}

#auto tr:hover {background-color: #ddd;}

#auto th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #1E5799;
  color: white;
}

td {
	  vertical-align: top;
}

</style>
</head>

<body><div class=content>

<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header><br>




<main><article><div class=title><h1 class=title>Connessione al DB Mysql</h1><div class=meta>Posted on Dic 16, 2021</div></div>
<div><p>Connessione di esempio al <b>DB Multe</b> su server remoto <b>db4free.net</b>.<br><br>

<table width="80%">   	<!-- Tabella principale -->
<tr><td width="70%">	<!-- Prima colonna-->
<?php
//Creazione oggetto mysqli per realizzare la connessione 
$con = new mysqli("db4free.net", "maquilanti", "qwertyuiop", "db_multe");	// SINTASSI >> Nuovo oggetto mysqli ("server", "utente", "password", "DB")

// Controllo errore di connessione >>  mysqli_connect_errno
if (mysqli_connect_errno()) 
{
      echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");  // mysqli_connect_error() >> tipo di errore
      exit();
}

// Caricamento della tabella auto alla prima visita della pagina
if (!$_POST) // se la variabile superglobal $_POST è VUOTA
{	
	CaricaTabellaAuto($con, "");  // Funzione che carica la tabella auto dal DB remoto
}
else
{
	// Controllo errore di connessione >>  mysqli_connect_errno
	if (mysqli_connect_errno()) 
	{
		  echo("Connessione non effettuata: ".mysqli_connect_error()."<BR>");  // mysqli_connect_error() >> tipo di errore
		  exit();
	}

	if (isset($_POST['campo']))
		{
		// Visualizzazione tabella AUTO ordinata a seconda del pulsante premuto: Targa, Modello, Marca
		$query = "SELECT * FROM auto ORDER BY ".$_POST['campo']." ASC ";
		
		//Esecuzione query che restituisce $ris
		$ris = $con->query($query) or die ("Query fallita!");

		CaricaTabellaAuto($con, $query);  // Aggiornamento della tabella con l'ordinamento effettuato

		}
	
		// Inserimento nella tabella AUTO
	if 	(isset($_POST['inserisci']))
		{
			
		// QUERY INSERIMENTO ELEMENTO
		//modello da phpmyadmin INSERT INTO `auto` (`Targa`, `Marca`, `Modello`) VALUES ('DF342GH', 'hiunday', 'i10');
		$query = "INSERT INTO auto (Targa, Marca, Modello) VALUES ('".$_POST['Targa']."', '".$_POST['Marca']."', '".$_POST['Modello']."')";

		
		//Esecuzione query che restituisce $ris
		$ris = $con->query($query) or die ("Query fallita!");

		//Funzione che genera la tabella
		CaricaTabellaAuto($con, "");	// Aggiornamento della tabella con il nuovo inserimento
		
		}
		
		// Cancella auto dalla tabella AUTO
	if 	(isset($_POST['elimina']))
		{
		$cancella = $_POST['Targa']; // Targa da cancellare selezionata nel form 
				
		// QUERY CANCELLAZIONE ELEMENTO
		//modello da phpmyadmin: DELETE FROM `auto` WHERE `auto`.`Targa` = \'TY344ZX\'"?
		$query = "DELETE FROM auto WHERE auto.Targa ='".$cancella."'";

		//Esecuzione query che restituisce $ris
		$ris = $con->query($query) or die ("Query fallita!");

		//Funzione che genera la tabella
		CaricaTabellaAuto($con, "");	// Aggiornamento della tabella dopo l'eliminazione dell'auto
		
		}	
	}
?>

<!-- Form per ORDINAMENTO -->
<TABLE width=90%> 
<form name="ordinanemento" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<TR>
<TD><input type="submit" name="campo" value="Targa"></TD>
<TD><input type="submit" name="campo" value="Modello"></TD>
<TD><input type="submit" name="campo" value="Marca"></TD>
</TR>
</form>
</TABLE>

</td> <!-- Tabella principale: FINE prima colonna-->

<td width="30%"> <!-- Tabella principale: seconda colonna-->


<!-- Form per INSERIMENTO -->
<TABLE >
<form name="inserimento" Inserimento auto method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" ><b>Inserimento auto</b> 
<TR><td><input type="Text" name="Targa" placeholder="Targa" required></TD></TR>
<TR><TD><input type="Text" name="Marca" placeholder="Marca" required></TD></TR>
<TR><TD><input type="Text" name="Modello" placeholder="Modello" required></TD></TR>
<TR><TD><input type="submit" name="inserisci" value="Inserisci"></TD></TR>
</form>
</TABLE>

<br><br>

<!-- Form per ELIMINARE -->
<TABLE >
<form name="eliminare" Inserimento auto method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" ><b>Elimina auto</b> 
<TR><td>  <label for="cars">Scegli:</label>
	<select name="Targa">
		<?php
			$query = "SELECT Targa, Marca, Modello FROM auto";
			$ris = $con->query($query) or die ("Query fallita!");
			
			foreach($ris as $riga) 
				{
				   echo "<option value=".$riga["Targa"].">".$riga["Targa"]." => ".$riga["Marca"]." - ".$riga["Modello"]."</option>";
				}
		?>
	</select></TD></TR>
<TR><TD><input type="submit" name="elimina" value="Elimina"></TD></TR>
</form>
</TABLE>


</td></tr>
</table> <!-- Chiusura tabella principale -->


<?php
// rilascio connessione DATABASE  !!!!!!
	$con->close();
?>

</p></div>



<div class=post-tags></div></article></main>

<br><br>
<footer>
<hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a>
</footer>

<script>feather.replace()</script></div>
</body>
</html>