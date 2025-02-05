<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>Es.1 - Postback</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png><meta name=viewport content="width=device-width,initial-scale=1"><meta name=description content="Here is a demo of all shortcodes available in Hugo."><meta property="og:image" content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png"><meta property="og:title" content="Hugo shortcodes"><meta property="og:description" content="Here is a demo of all shortcodes available in Hugo."><meta property="og:type" content="article"><meta property="og:url" content="https://athul.github.io/archie/posts/post-6/"><meta property="article:published_time" content="2020-04-15T12:13:36+05:30"><meta property="article:modified_time" content="2020-04-15T12:13:36+05:30"><meta name=twitter:card content="summary"><meta name=twitter:title content="Hugo shortcodes"><meta name=twitter:description content="Here is a demo of all shortcodes available in Hugo."><script src=https://athul.github.io/archie/js/feather.min.js></script><link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)"></head>

<body><div class=content>

<header>
<div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header>


<?php  // Array multidimensionale misto per caricare il menù dei primi

 $pathimg ="/php_sito/images/";			// Path per caricare le immagini
 $primi = array (
	"lasagne marchigiane" => array (8.5, "lasagne-marchigiane.png"),
	"spaghetti al pomodoro" => array (6, "spaghetti-al-pomodoro.png"),
	"spaghetti di mare" => array (15, "spaghetti-di-mare.png"),
	"tagliatelle al cinghiale" => array (13, "tagliatelle-al-cinghiale.png",),
	"tortellini primavera" => array (10.5, "tortellini-primavera.png",) 
	);
?>

<!-- 	Crea un form che mostri i piatti ordinabili in un ipotetico ristorante online.
		A seconda delle scelte effettuate (piatti e numero) deve mostrare il prezzo complessivo. 
		
		echo "<tr><td>$nome<br><img src="$vettore[1]"></td><td>$vettore[0]</td><td><input type="text" name="quantita$1" size="20" value="0"</td></tr>"
		
		-->

<main>
<article><div class=title><h1 class=title>Es.1 - Postback | Es1. Ristorante</h1><div class=meta>Posted on dic 07, 2021</div></div>
<p>Creare un form che mostri i piatti ordinabili in un ipotetico ristorante online.<br>A seconda delle scelte effettuate piatti e numero)si deve mostrare il prezzo complessivo.<p>

<H2> Menù Ristorante PROVAMI</H2>
<BR><BR>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Name Prenotante: <input type="text" size="100" name="name">
  <br><br>
  
  <table width="80%">
 
	<?php 
		 echo "<tr valign=middle align=left><th width=20% > </th><th width=40% >Primi piatti</th><th width=20%>Prezzo unitario</th><th width=20% >Quantità</th></tr>";
		$i=0;
		foreach ($primi as $nome => $vettore)
		{
			echo "<tr valign=middle><td valign=middle><img border0  width=100 height=80 src=\"".$pathimg.$vettore[1]." \"></td> <td>$nome</td><td>".$vettore[0]."</td><td><input type=text name=\"quantita".$i."\" size=2 value=0 align=middle></td></tr>";
			$i++;
		}
	?>
  </table>
  <br>
  <input type="submit" name="submit" value="Prenota">  
</form>

<?php
 if ($_POST)
 {
	 echo "<BR><BR><hr>";
	 echo "Grazie <b>".$_POST["name"]."</b><br><br>";
	 
	 echo "La tua prenotazione: <br>";
	 echo "<br><table width=80% bgcolor=f71818 >";
	 echo "<tr valign=middle align=left><th width=20% align=center>Quantità </th><th width=40%>Primo</th><th width=20% align=center>Prezzo</th><th width=20% align=center>Parziale</th></tr>";
	 $i=0;
	 $tot=0;
	 foreach ($primi as $nome => $vettore)
		{
			
			$app="quantita".$i;
			$parziale=$_POST[$app]*$vettore[0];
			if ($parziale!=0)
			{
				echo "<tr valign=middle><td align=center>$_POST[$app]</td><td valign=middle>$nome</td><td align=center>".$vettore[0]."</td><td align=center>$parziale</td></tr>";
				$tot+=$_POST[$app]*$vettore[0];
			}
			$i++;
		}
		echo "<tr valign=middle><td></td><td></td><td><b>TOTALE EURO</b></td><td align=center><b>$tot </b></td></tr>";
	 echo "</table>";
	 echo "<BR><BR>";
	 
 }

?>

<div class=post-tags></div>
</article>
</main>


<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>