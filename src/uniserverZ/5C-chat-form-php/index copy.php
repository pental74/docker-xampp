<!-- #region 

CHAT ROOM

Realizzare una semplice applicazione web (html+js+php) che implementi una Chat Room.

Una volta inserito
 - il nome utente 
 - il nome della room
 - l'utente potrà inserire un nuovo messaggio sulla room specificata, oppure 
 - visualizzare i messaggi che vi sono stati scritti.

Si può strutturare l'app con una sola pagina utilizzando la tecnica postback, 
ma per questa soluzione sarà richiesto l'uso dell'attributo "form action", da associare ai relativi pulsanti "Invia" e "Visualizza Messaggi" (oppure associare ai pulsanti degli eventListener da JS che accedono alla pagina stessa mediante querystring diverse).

Ai link un esempio su come usare l'attributo "form action":
- https://stackoverflow.com/a/24989900

In alternativa, si può strutturare l'app con due pagine distinte, una per la scelta della stanza, e l'altra per visualizzare ed inviare messaggi.

  #endregion -->

<!-- Implementazione PAGINA POSTBACK -->

<!-- Documentazione 


- Metodi OOP mysqly: https://www.w3schools.com/php/func_mysqli_error.asp
- Funioni in PHP: https://www.w3schools.com/php/php_functions.asp
- Controllo deghi errori: 
    -> http://www.labsquare.it/?p=4372
    -> https://www.w3schools.com/php/func_mysqli_error.asp
- Include e Require: https://www.w3schools.com/php/php_includes.asp
- Query e visualizzazione: https://www.w3schools.com/php/php_mysql_select.asp

-->

<!doctype html>
<html lang="it">

<head>
  <title>CHAT ROOM</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="CSS/style.css"  rel="stylesheet" type="text/css" >

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
  <header>
    <!-- place navbar here -->
  </header>
  <main>
        <div class="contenitore">
            <h2>CHAT ROOM</h2>
            <br>
            <div id="form">
              <!-- php echo $_SERVER['PHP_SELF']; ?> -->
              <form name="form_chat"  method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                  <input type="text" class="m-2" name="nome_utente" value="Marco" required><br>
                  <input type="text"  class="m-2" name="stanza" value="73" required><br>
                  <textarea class="m-2" name="testo_messaggio">Questo è un messaggio di prova</textarea><br>
                  <input type="submit" id="btn_visualizza" value="Visualizza Messaggi" name="visualizza">
                  <input type="submit" id="btn_inserisci" value="Invia messaggio" name="inserisci">
              </form>
            </div>

            <!-- parte php -->
            <div id="tabella"> <?php include 'PHP/form_iniziale.php' ?></div>
        </div>
  </main>

  
  
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="JVS/visualizza.js"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>