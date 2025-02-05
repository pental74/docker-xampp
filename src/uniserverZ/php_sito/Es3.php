	<!DOCTYPE html>
	<html>
		<head>
			<title>Form con dati sensibili di persone</title>
		</head>



		<body>

						<?php
					$destinazioni="";
					$valute="";
					$name="";
					$cognome="";
					$indirizzo="";
				?>
				
			<!--Creo form che stamperà i dati inviati-->
			<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				
				
				Scegli la destinazione 
				<select name="destinazioni" value="<?php echo $destinazioni;?>">
					<option value="Francia">Francia</option>
					<option value="Tunisia">Tunisia</option>
					<option value="Marocco">Marocco</option>
					<option value="Seychelles">Seychelles</option>
					<option value="Brasile">Brasile</option>
				</select >
				<br>
				Scegli la valuta:
				<select name="valute" value="<?php echo $valute;?>">
					<option value="euro">euro</option>
					<option value="dollaro">dollaro</option>
				</select>
				<br>
				Imettere il nome
				<input type="text" name="nome" value="<?php echo $name;?>" >
				<br>
				Imettere il cognome
				<input type="text" name="cognome" value="<?php echo $cognome;?>" >
				<br>
				Imettere indirizzo
				<input type="text" name="indirizzo" value="<?php echo $indirizzo;?>">
				<br>
				<!--Invio dati-->
				<input type= "submit">
			</form>
				
				<?php
					if ($_POST)
					{
						echo "Questi sono i dati da te inseriti";
						 
						echo "<br>nome ".$_POST["nome"];
						echo "<br>cognome ".$_POST["cognome"];
						echo "<br>indirizzo ".$_POST["indirizzo"];
						echo "<br>valuta ".$_POST["valute"];
						echo "<br>Destinazione".$_POST["destinazioni"];
						
					}
					
				?>
			
		</body>
	</html>