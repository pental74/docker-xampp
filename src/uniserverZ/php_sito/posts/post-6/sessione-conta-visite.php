<?php
    //attivazione delle sessioni
    //obbligatorio come prima riga in PHP ogni volta che si usano le sessions
    session_start();
    //se la variabile di sessione non esiste
    if (!isset($_SESSION['numero_visite'])) {
        //settaggio variabile sessione a 1
        $_SESSION['numero_visite'] = 1;
    } else {
        //se esiste già incremento variabile sessione
        $_SESSION['numero_visite']++;
    }
?>

<!doctype html>
<html>
<head>
    <meta charset=utf-8>
    <meta http-equiv=x-ua-compatible content="IE=edge">

    <title>Contavisite con $_SESSION</title>

    <link rel=icon type=image/png
          href=https://img.icons8.com/officel/16/000000/chevron-right.png>
    <meta name=viewport content="width=device-width,initial-scale=1">
    <meta name=description content="Here is a demo of all shortcodes available in Hugo.">
    <meta property="og:image"
          content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png">
    <meta property="og:title" content="Hugo shortcodes">
    <meta property="og:description" content="Here is a demo of all shortcodes available in Hugo.">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://athul.github.io/archie/posts/post-6/">
    <meta property="article:published_time" content="2020-04-15T12:13:36+05:30">
    <meta property="article:modified_time" content="2020-04-15T12:13:36+05:30">
    <meta name=twitter:card content="summary">
    <meta name=twitter:title content="Hugo shortcodes">
    <meta name=twitter:description content="Here is a demo of all shortcodes available in Hugo.">
    <script src=https://athul.github.io/archie/js/feather.min.js></script>
    <link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css
          rel=stylesheet>
    <link rel=stylesheet type=text/css media=screen
          href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css>
    <link rel=stylesheet type=text/css
          href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css
          media="(prefers-color-scheme: dark)">
</head>

<body>
<div class=content>

    <header>
        <div class=main><a href=/php_sito/> PHP scripting lato server </a></div>
        <nav>
            <a href=/php_sito/>Home</a>
            <a href=/php_sito/about>About</a>
        </nav>
    </header>
    <br>

    <main>
        <article>
            <div class=title>
                <h1 class=title>Contavisite con $_SESSION</h1>
                <div class=meta>Posted on Dic , 2021</div>
            </div>
            <p>Questa pagina conta le volte che si è visitata questa pagina utilizzanto la variabile SUPERGLOBAL
                <b>$_SESSION (Server)</b>.<br> A differenza dell'impiego diretto dei <a href=cookie-visite.php><b>cookie</b></a>
                salvati sul tuo PC, in questo caso il conteggio avviene nel <b>server.</b></p><br>

            <p>Il numero di volte che ti sei connesso a questa pagina è ...
                <B>
                    <?php
                        //visualizzazione variabile di sessione
                        echo $_SESSION['numero_visite'];
                    ?>
                </B>
            </p>

            <div class=post-tags></div>
        </article>
    </main>

    <br><br>
    <footer>
        <hr>
        <b>Marco Aquilanti</b> ⚡️
        Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a>
    </footer>

    <script>feather.replace()</script>
</div>
</body>
</html>