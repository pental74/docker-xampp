<!DOCTYPE html>
<html>
<body>

<?php

// Array Multidimensionale numerico
$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15),
  array("Tesla", 20, 18)
);

echo "<h3>AUTOSALONE MARCONI</h3>";
    
// Impostazione TABELLA con larghezza 50% della pagina e allieneamento della
// riga di intestazione a sinistra (<tr align=\"left\"> - '\' carattere escape
echo "<table width=\"50%\"><tr align=\"left\"><th>MARCA</th><th>DISPONIBILI</th>
<th>VENDUTE</th></tr>";    

// Due cicli iterativi per stampare riga per riga, tutti gli elementi degli array
// la funzione count($array) >> conta gli elementi del vettore
sort($car,1);

for ($row = 0; $row < count($cars); $row++) 
{
    echo "<tr>";
    for ($col = 0; $col < count($cars[$row]); $col++) 
	{
    	echo "<td>".$cars[$row][$col]."</td>";
	}
  	echo "</tr>";
}
echo "</table>";

echo "<br><br><br>";



$intestazione = array ("MARCA", "DISPONIBILI", "VENDUTE");


echo "<table width=\"70%\" border=\"1\">"; //<tr align=\"left\"><th></th><th></th><th></th></tr>"; 

// Due cicli iterativi per stampare riga per riga, tutti gli elementi degli array
// la funzione count($array) >> conta gli elementi del vettore
for ($row = 0; $row < 3; $row++) 
{
    echo "<tr align=\"left\">";
    for ($col = 0; $col <= count($cars); $col++) 
	{
    	// Controllo sulla prima colonna per stampare l'intestazione della tabella
        if ($col==0) echo "<td><b>".$intestazione[$row]."</b></td>";
        
        // controllo sulla prima riga per stampare in grassetto le MARCHE
        // stampa degli elementi invertendo gli indici rige e colonna
        // $cars[$col-1][$row] - $col-1 perché la prima colonna è occupata dall'intestazione 
        else if ($row==0)  echo "<td><b>".$cars[$col-1][$row]."</b></td>";
        	 else echo "<td>".$cars[$col-1][$row]."</td>";
	}
  	echo "</tr>";
}
echo "</table>";
?>

</body>
</html>
