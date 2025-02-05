<?php
// Inizializzazione sessioni - sempre in testa al documento sopra ai tag HTML
session_start();

// Tecnica postback: verifica se non è il primo accesso alla pagina
if (!isset($_POST['utente'])) {
    // Se primo accesso visualizzazione form che richiama la pagina stessa
    // Usando la variabile d'ambiente $PHP_SELF per evitare di riscrivere il nome della pagina
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sessione - Login</title>

    <link rel="icon" type="image/png"
        href="https://img.icons8.com/officel/16/000000/chevron-right.png">
    <meta name="description" content="Here is a demo of all shortcodes available in Hugo.">
    <meta property="og:image"
        content="https://raw.githubusercontent.com/athul/archie/master/images/archie-dark.png">
    <meta property="og:title" content="Hugo shortcodes">
    <meta property="og:description" content="Here is a demo of all shortcodes available in Hugo.">
    <meta property="og:type" content="article">
    <meta property="og:url" content="https://athul.github.io/archie/posts/post-6/">
    <meta property="article:published_time" content="2020-04-15T12:13:36+05:30">
    <meta property="article:modified_time" content="2020-04-15T12:13:36+05:30">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="Hugo shortcodes">
    <meta name="twitter:description" content="Here is a demo of all shortcodes available in Hugo.">
    <script src="https://athul.github.io/archie/js/feather.min.js"></script>
    <link href="https://athul.github.io/archie/css/fonts.b685ac6f654695232de7b82a9143a46f9e049c8e3af3a21d9737b01f4be211d1.css"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://athul.github.io/archie/css/main.6e5c46a02667a5b78139b70a121f969854b60f0bfaae7fad2a2c93a98f1477cb.css">
    <link rel="stylesheet" type="text/css"
        href="https://athul.github.io/archie/css/dark.726cd11ca6eb7c4f7d48eb420354f814e5c1b94281aaf8fd0511c1319f7f78a4.css"
        media="(prefers-color-scheme: dark)">
</head>

<body>
    <div class="content">

        <header>
            <div class="main">
                <a href="/php_sito/">PHP scripting lato server</a>
            </div>
            <nav>
                <a href="/php_sito/">Home</a>
                <a href="/php_sito/about">About</a>
            </nav>
        </header>

        <main>
            <article>
                <div class="title">
                    <h1 class="title">LOGIN - SESSIONE AVVIATA</h1>
                    <div class="meta">Posted on Dic 06, 2021</div>
                </div>

                <!-- FORM LOGIN (se non si viene riconosciuti come utenti) -->
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <table>
                        <tr>
                            <td>Nome Utente:</td>
                            <td><input name="utente"><br></td>
                            <td>
                                <?php if ($_POST) echo "UTENTE NON RICONOSCIUTO! Riprovare l'autenticazione"; ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password"><br></td>
                            <td>
                                <?php if ($_POST) echo $err_pas; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="submit" value="Invia"></td>
                        </tr>
                    </table>
                </form>

                <?php
} else {
    // Se secondo accesso alla pagina avviene controllo autorizzazioni
    // La variabile user_id contiene il nome utente in minuscolo
    $user = strtolower($_POST['utente']);
    // La variabile pwd contiene la password
    $pwd = $_POST['password'];
    // L'array utenti contiene i nomi degli utenti ammessi e le relative password
    $utenti = array(
        'marco' => 'marco',
        'admin' => 'qwerty',
        'paolo' => '1234',
        'riccardo' => 'pippo'
    );

    // Verifica se l'array contiene contiene un nome utente come inserito nel form
    if (isset($utenti["$user"])) {
        // In caso positivo verifica se l'array contiene una password come inserita nel form
        if ($utenti["$user"] == $pwd) {
            // In caso positivo avviene la creazione della variabile di sessione
            // Con il nome dell'utente
            $_SESSION['utente'] = $_POST['utente'];
            // Quindi viene richiamata la pagina autorizzato.php
            header("Location: sessione-prova-autorizzato.php");
        } else {
            // Se password non riconosciuta vengono eliminate le variabili ricevute dal form
            unset($_POST['utente']);
            unset($_POST['password']);
            // Viene richiamata di nuovo la pagina di login
            // header("Location: ".$_SERVER['PHP_SELF']);
            header("Location: sessione-prova-autorizzato.php");
        }
    } else {
        // Se il nome utente non è riconosciuto vengono eliminate le variabili ricevute dal form
        // unset($_POST['login']);
        unset($_POST['password']);
        // Viene richiamata di nuovo la pagina di login
        // header("Location: ".$_SERVER['PHP_SELF']);
        header("Location: sessione-prova-autorizzato.php");
    }
}
?>

                <br>
                <ul class="pagination">
                    <span class="page-item page-prev"></span>
                    <span class="page-item page-next">
                        <a href="/php_sito/download/sessione-prove-autorizzato.txt" download
                            class="page-link" aria-label="Next">
                            <span aria-hidden="true">Download Codice PHP →</span>
                        </a>
                    </span>
                </ul>
                <div class="post-tags"></div>
            </article>
        </main>
        <footer>
            <hr>
            <b>Marco Aquilanti</b> ⚡️
            Credit to Athul | <a href="https://github.com/athul/archie">Archie Theme</a> | Built with <a
                href="https://gohugo.io">Hugo</a>
        </footer>
        <script>
            feather.replace()
        </script>
    </div>
</body>
</html>