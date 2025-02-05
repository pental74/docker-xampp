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

<?php
 $primi = array {
	"lasagne marchigiane" => array {8.5, "lasagne-marchigiane.png", 0},
	"spaghetti al pomodoro" => array {6}, "spaghetti-al-pomodoro.png", 0 },
	"spaghetti di mare" => array {15, "spaghetti-di-mare.png", 0},
	"tagliatelle al cinghiale" => array {13, "tagliatelle-al-cinghiale.png", 0},
	"tortellini primavera" => array {10.5, "tortellini-primavera.png", 0} );
?>

<!-- 	Crea un form che mostri i piatti ordinabili in un ipotetico ristorante online.
		A seconda delle scelte effettuate (piatti e numero) deve mostrare il prezzo complessivo. 
		
		echo "<tr><td>$nome<br><img src="$vettore[1]"></td><td>$vettore[0]</td><td><input type="text" name="quantita$1" size="20" value="0"</td></tr>"
		
		-->

<main>
<article><div class=title><h1 class=title>Es.1 - Postback | Ristorante</h1><div class=meta>Posted on dic 07, 2021</div></div>

<H2> Ristorante PROVAMI</H2>
<P>Menù</P><BR><BR>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
  Name Prenotante: <input type="text" size="100" name="name">
  <br><br>
  Primi piatti
  <table>
	<?php 
		i=0;
		foreach ($primo as $nome => $vettore)
		{
			//$q="quantita".$i;
			echo "<tr><td>$nome<br><img src=\"".$vettore[1]."\"></td><td>".$vettore[0]."</td></tr>";
		}
	?>
  </table>
  <br>
  <input type="submit" name="submit" value="Prenota">  
</form>


<div class=post-tags></div>
</article>
</main>


<footer><hr><b>Marco Aquilanti</b> ⚡️
Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a></footer>

<script>feather.replace()</script></div></body></html>