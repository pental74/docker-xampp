<!doctype html><html><head><meta charset=utf-8><meta http-equiv=x-ua-compatible content="IE=edge">

<title>Pagina Iniziale Ristorante</title>

<link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png><link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet><link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css><link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)"></head>

<body><div class=content>

<header><div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
<nav>
<a href=/php_sito/>Home</a>
<a href=/php_sito/about>About</a>
</nav>
</header><br><br>


<main><article>

<H2> Menù Ristorante PROVAMI</H2>

<p>Per prenotare occorre <a href="registrazione.html">registrarsi</a> od effettuare il <a href="login.html">login</a></p>
<BR><BR>
  
  <table width="80%">
 
	<?php 
	$pathimg ="images/";			// Path per caricare le immagini
	$primi = array (
	"lasagne marchigiane" => array (8.5, "lasagne-marchigiane.png"),
	"spaghetti al pomodoro" => array (6, "spaghetti-al-pomodoro.png"),
	"spaghetti di mare" => array (15, "spaghetti-di-mare.png"),
	"tagliatelle al cinghiale" => array (13, "tagliatelle-al-cinghiale.png",),
	"tortellini primavera" => array (10.5, "tortellini-primavera.png",) 
	);
	
		 echo "<tr valign=middle align=left><th width=20% > </th><th width=40% >Primi piatti</th><th width=20%>Prezzo unitario</th></tr>";
		$i=0;
		foreach ($primi as $nome => $vettore)
		{
			echo "<tr valign=middle><td valign=middle><img border0  width=100 height=80 src=\"".$pathimg.$vettore[1]." \"></td> <td>$nome</td><td>".$vettore[0]."</td></tr>";
			$i++;
		}
	?>
  </table>


<div class=post-tags></div></article></main>

<br><br>
<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>