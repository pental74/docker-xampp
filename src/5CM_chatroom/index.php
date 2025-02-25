<?php
    session_start();
    require_once('includes/db.php');

    $login_error = "";
    $registration_success = false;
    $registration_error = "";

    if (isset($_SESSION['username'])) {
        header("Location: chatroom.php"); // Redirect to Chatroom
        exit();
    }

    // Controllo login
    if ($_POST!=null){
        if (isset($_POST['loginUsername']) && $_POST['loginUsername']!="" && isset($_POST['loginPassword']) && $_POST['loginPassword']!="")  {
            $username = $_POST['loginUsername'];
            $password = $_POST['loginPassword'];
            
            // Query per selezionare l'utente con le credenziali fornite
            $query = "SELECT * FROM utenti WHERE nome_utente = ?";
            // Preparo la query
            $stmt = $conn->prepare($query);
            // Associo i parametri alla query, "ss" indica che sono due stringhe
            $stmt->bind_param("s", $username);
            // Eseguo la query
            $stmt->execute();
            // Ottengo il risultato
            $result = $stmt->get_result();
            // Controllo se esiste almeno una riga nel risultato
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();
                if ($user && password_verify($password, $user['password'])) {
                    $_SESSION['username'] = $user['nome_utente'];
                    $_SESSION['id_user'] = $user['codice'];
                    header('Location: chatroom.php');
                }
                else $login_error = "Password errata";
            }
            else $login_error = "Utente non presente";
        }
  
        

        if (isset($_POST['registerUsername']) && $_POST['registerUsername']!="" && isset($_POST['registerPassword']) && $_POST['registerPassword']!="" && isset($_POST['registerEmail']) && $_POST['registerEmail']!="") {
            $username = $_POST['registerUsername'];
            $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);
            $email = $_POST['registerEmail'];
            

            // Query per inserire l'utente con le credenziali fornite
            $query = "INSERT INTO utenti (nome_utente, email, password) VALUES (?,?,?)";
            // Preparo la query
            $stmt = $conn->prepare($query);
            // Associo i parametri alla query, "sss" indica che sono tre stringhe
            $stmt->bind_param("sss", $username, $email, $password);
            // Eseguo la query
            try{    
                $stmt->execute();
            } catch(mysqli_sql_exception $e){
                // Se l'eccezione è una mysqli_sql_exception
                $registration_error = "Utente o e-mail già presente";
            } catch (Exception $e) {
                // Se si verifica un errore generico
                $registration_error = "Errore durante la registrazione";        }
            $stmt->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <style>
 
    </style>

    <script>
            function showRegistration() {
                document.getElementById('loginForm').style.display = 'none';
                document.getElementById('registrationForm').style.display = 'block';
            }

            function showLogin() {
                document.getElementById('registrationForm').style.display = 'none';
                document.getElementById('loginForm').style.display = 'block';
            }
    </script>
</head>
<body>

    <div class="container">
        <h1>Chatroom</h1>
        

        <!-- Login  -->
        <form id="loginForm" name="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" placeholder="Username" id="loginUsername" name="loginUsername" >
            <input type="password" placeholder="Password" id="loginPassword" name="loginPassword" >
            <button id="loginButton">LOGIN</button>

            <?php
                if($login_error != ""){
                    echo "<div class=\"error\"><br>";
                    echo $login_error;
                    echo "</div>";
                }
                if($registration_success){
                    echo "<div class=\"success\"><br>";
                    echo "Registrazione effettuata con successo!";
                    echo "</div>";
                }
            ?>

            <div class="switch-form" id="switchLogin">
                Non sei registrato? <a href="#" onclick="showRegistration()">REGISTRATI</a>
            </div>
        </form>
        
        <!-- Registrazione -->
        <form id="registrationForm" name="registrationForm" style="display:none;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" name="registerUsername" placeholder="Username" id="registerUsername">
            <input type="text" name="registerEmail" placeholder="Email" id="registerEmail">
            <input type="password" name="registerPassword" placeholder="Password" id="registerPassword">
            <button id="registerButton">REGISTRATI</button>
            <div class="switch-form" id="switchRegistrazione">
            <?php

            if($registration_error != ""){
                echo "<div class=\"error\">";
                echo $registration_error;
                $_SESSION['registration_error'] = "errore";
                echo "</div><br>";
            }
            ?>
            Esegui <a href="#" onclick="showLogin()">LOGIN</a>
            </div>
        </form>
    </div>

    <?php
        $registration_error="";
        $login_error="";
    ?>


</body>
</html>


