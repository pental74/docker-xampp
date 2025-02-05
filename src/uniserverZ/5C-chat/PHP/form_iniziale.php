<?php
      // Include il file di connessione al DB
      include 'PHP/connessione.php';


      if ($_POST) 
      {
        // Acquisizione dei dati inviati tramite form
        $messaggio = $_POST["testo_messaggio"];
        $user = $_POST["nome_utente"];
        $room = $_POST["stanza"];

        // Check connection
        if ($mysqli->connect_errno) die ("Failed to connect to MySQL: " . $mysqli->connect_error); // ERRORE DI CONNESSIONE
        else {
          echo "Connesso";
          exit;
        }
        // CONNESSIONE STABILITA CORRETTAMENTE
        
        if (isset($_POST["visualizza"])) 
        {
            echo "<br>Visualizza<br><br>";
            visualizza_messaggi($mysqli);

        }    
          
          // Query per l'inserimento
          if (isset($_POST["inserisci"])) 
            {
              echo "inserisci<br>";

              $query = "INSERT INTO `messaggi` (`data`, `stanza`, `utente`, `messaggio`) VALUES (CURRENT_TIMESTAMP, '$room', '$user', '$messaggio')";
              // Query copiata da PhpMyAdmin - '$variabilePHP' -> APICI PER L'INSERIMENTO DELLE VARIABILI PHP
              // $query = "INSERT INTO `messaggi` (`data`, `stanza`, `utente`, `messaggio`) VALUES (CURRENT_TIMESTAMP, '73', 'marco', 'Prova da phpmyadmin perché non funziona da form')";
              
              
              // inserimento nel DB
              if ($mysqli->query($query)) echo "Messaggio inserito correttamente<br><br>";
              else die("Errore nell'inserimento nel DB: ". $mysqli-> error); 

              visualizza_messaggi($mysqli);
            }
        $mysqli->close();
      }

      function visualizza_messaggi($con)
      {
        $query = "SELECT * FROM messaggi"; // Query per la visualizzazione
        $risultato = $con->query($query);

        

        if ($risultato->num_rows > 0) 
        {
          // output data of each row
          echo "<table>";
          echo "<tr><th>DATA</th><th>Stanza</th><th>User</th><th>Messaggio</th></tr>";

          while($row = $risultato->fetch_assoc()) 
          {
            echo "<tr><td>" . $row["data"]. "</td><td>" . $row["stanza"]. "</td><td>". $row["utente"]. "</td><td style='text-align: left';>". $row["messaggio"]. "</td></tr>";
          }
          echo "</table>";
        } 
        else echo "0 results";  

        echo "<br><button onclick='nascondi_form(true)'>Indietro</button> ";

      }
  ?>