<?php
//inizializzazione sessioni
session_start();
?>

<!doctype html>
<html>
<head>
    <meta charset=utf-8>
    <meta http-equiv=x-ua-compatible content="IE=edge">

    <title>Sessione - Autenticato</title>

    <link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png>
    <meta name=viewport content="width=device-width,initial-scale=1">
    <meta name=description content="Here is a demo of all shortcodes available in Hugo.">
    <meta property="og:image" content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png">
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
    <link href=https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css rel=stylesheet>
    <link rel=stylesheet type=text/css media=screen href=https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css>
    <link rel=stylesheet type=text/css href=https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css media="(prefers-color-scheme: dark)">
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


    <main>
        <article>
            <div class=title>
                <h1 class=title>AUTENTICAZIONE</h1>
                <div class=meta>Posted on Dic 06, 2021</div>
            </div>



            <?php
            //verifica se variabile di sessione è attiva
            //questo per evitare che se un utente conosce la pagina
            //la possa aprire direttamente senza passare dalla pagina di autorizzazione
            if (isset($_SESSION['utente'])) {
                ?>
                <H3>Utente RICONOSCIUTO</H3><BR>
                <?php
                //visualizzazione nome utente
                echo "Benvenuto<B> " . $_SESSION['utente'];
                ?>
                </B>Sei nella sezione riservata.
                <?php
            } else {
                //utente non riconosciuto in quanto la variabile di sessione non è stata settata
                ?>
                Utente sconosciuto, riprova a <A HREF="sessione-prova.php">connetterti</a>
                <?php
            }
            ?>

            <ul class=pagination>
                <span class="page-item page-prev"></span>
                <span class="page-item page-next">
                    <a href="/php_sito/download/sessione-prova-autorizzato.txt" download class=page-link aria-label=Next>
                        <span aria-hidden=true>Download Codice PHP →</span>
                    </a>
                </span>
            </ul>


            <BR><BR>
            <div class=post-tags></div>
        </article>
    </main>


    <footer>
        <hr><b>Marco Aquilanti</b> ⚡️
        Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a href=https://gohugo.io>Hugo</a>
    </footer>

    <script>feather.replace()</script>
</div>
</body>
</html>