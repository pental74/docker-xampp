<!doctype html>
<html>
<head>
    <meta charset=utf-8>
    <meta http-equiv=x-ua-compatible content="IE=edge">

    <title>Cookie - Visite</title>

    <link rel=icon type=image/png href=https://img.icons8.com/officel/16/000000/chevron-right.png>
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
            <a href=/php_sito/about>About</a><br><br>
        </nav>
    </header>


    <main>
        <article>
            <div class=title>
                <h1 class=title>Cookie - Visite</h1>
                <div class=meta>Posted on Dic 07, 2021</div>
            </div>
            <p>Conteggio delle visite a questa pagina tramite l'utilizzo della variabile SUPERGLOBAL <B>$_COOKIE.</b>
            <p>Questa pagina creerà dei file nel tuo PC. Cercali seguendo le indicazioni che seguono:</p>
            <p>
            <ul type="circle">
                <li> Vai nella pagina delle impostazioni del browser, sezione "privacy e sicurezza".</li>
                <li> Seleziona "Cookie e altri dati", quindi cerca "marco.aquilanti".</li>
                <li> Scoprirai che sono presenti diversi biscottini.</li>
            </ul>
            </p>

            <p>Aggiorna la pagina <B>(F5)</B> per verificare l'aumento del contatore delle visite.</p>
            <br>
            <hr>

            <?php
            // verifica se il cookie 'visite' esiste
            if (isset($_COOKIE['visite'])) {
                //in caso positivo incremento del cookie visite di 1
                //viene eseguito il casting all'intero in quanto il cookie è sempre di tipo stringa
                $numero_visite = (int)$_COOKIE['visite'] + 1;
            } else {
                //se è la prima visita viene creato il cookie e assognato ad esso 1
                //tramite la variabile numero_visite
                //il cookie creato ha un tempo di durata di 3600 secondi = 1 ora
                $numero_visite = 1;
            }
            setcookie('visite', $numero_visite, time() + 3600);
            if ($numero_visite == 1) {
                echo "<H2>Benvenuto!</H2>";
                echo "Nell'ultima ora hai visitato questa pagina 1 volta";
            } else {
                echo "<H2>Bentornato!</H2>";
                echo "Nell'ultima ora hai visitato questa pagina <b>$numero_visite volte</b>";
            }
            ?>


            <div class=post-tags></div>
        </article>
    </main>

    <br><br>
    <footer>
        <hr>
        <b>Marco Aquilanti</b> ⚡️
        Credit to Athul | <a href=https://github.com/athul/archie>Archie Theme</a> | Built with <a
                href=https://gohugo.io>Hugo</a></footer>

    <script>feather.replace()</script>
</div>
</body>
</html>