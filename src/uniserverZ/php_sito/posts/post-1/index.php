<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>Esempi - PHP scripting lato server</title>


<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png><meta name=viewport content="width=device-width,initial-scale=1"><meta name=description content="Syntax Highlighting Examples"><meta property="og:image" content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png"><meta property="og:title" content="Syntax Higlighters"><meta property="og:description" content="Syntax Highlighting Examples"><meta property="og:type" content="article"><meta property="og:url" content="https://athul.github.io/archie/posts/langs/"><meta property="article:published_time" content="2020-06-23T00:00:00+00:00"><meta property="article:modified_time" content="2020-06-23T00:00:00+00:00"><meta name=twitter:card content="summary"><meta name=twitter:title content="Syntax Higlighters"><meta name=twitter:description content="Syntax Highlighting Examples"><script src=https://athul.github.io/archie/js/feather.min.js></script><link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)"></head><body><div class=content>


<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>

<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>

</header>



<main><article><div class=title><h1 class=title>Esempi array</h1><div class=meta>Posted on Nov 23, 2021</div></div>

<?php
echo "<h2>Array Multidimensionale numerico</h2>";
// Array Multidimensionale numerico
$cars = array (
  array("Volvo",22,18),
  array("BMW",15,13),
  array("Saab",5,2),
  array("Land Rover",17,15),
  array("Tesla", 20, 18)
);

echo "AUTOSALONE MARCONI";
    
// Impostazione TABELLA con larghezza 50% della pagina e allieneamento della
// riga di intestazione a sinistra (<tr align=\"left\"> - '\' carattere escape
echo "<table width=\"50%\"><tr align=\"left\"><th>MARCA</th><th>DISPONIBILI</th>
<th>VENDUTE</th></tr>";    

// Due cicli iterativi per stampare riga per riga, tutti gli elementi degli array
// la funzione count($array) >> conta gli elementi del vettore
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

echo "<br><br><br>";

?>
<ul class=pagination><span class="page-item page-prev"></span><span class="page-item page-next">
<a href="/php_sito/download/esercizio_modulo2PHP.txt" download class=page-link aria-label=Next>
<span aria-hidden=true>Download Codice PHP →</span></a></span></ul>


<section class=body>
</section>
</article>
</main>


<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer><script>feather.replace()</script></div></body></html>