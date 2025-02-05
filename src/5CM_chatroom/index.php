<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            margin-top: 30px;
            width: 500px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 85%;
            padding: 20px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        #loginForm{
            background-color: #add8e6; 
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 15px;
        }
        #registrationForm{
            padding: 20px;
            background-color: #90ee90;
            border-radius: 15px;

        }
        
        button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 90%;
        }

        button:hover {
            background-color: #4cae4c;
        }

        .switch-form {
            margin-top: 15px;
            font-size: 0.9em;
        }

        .switch-form a {
            color: #337ab7;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <?php
        require_once('includes/db.php');
    ?>
    <div class="container">
        <h1>Chatroom</h1>
        
        <!-- Login  -->
        <form id="loginForm" name="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="text" placeholder="Username" id="loginUsername" name="loginUsername">
            <input type="password" placeholder="Password" id="loginPassword" name="loginPassword">
            <button id="loginButton">LOGIN</button>
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
            Esegui <a href="#" onclick="showLogin()">LOGIN</a>
            </div>
        </form>
    </div>

    <?php 
        // Controllo login
        if (isset($_POST['loginUsername']) && isset($_POST['loginUsername']) && isset($_POST['loginPassword']))  {
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
                    //header("Location: dashboard.php");

                    echo "<div class=\"switch-form\">
                            Login effettuato con successo
                          </div>";    
                    //echo "<script>showMessage(\"Login effettuato con successo\", \"switchLogin\")</script>";
                }
                else
                {
                echo "<div class=\"switch-form\">
                    Password errata
                    </div>"; 
                }
            }
            else
            {
            echo "<div class=\"switch-form\">
                Utente non presente
                </div>"; 
            }    
        }

        if (isset($_POST['registerUsername']) && isset($_POST['registerUsername']) && isset($_POST['registerPassword']) && isset($_POST['registerEmail'])) {
            $username = $_POST['registerUsername'];
            $password = password_hash($_POST['registerPassword'], PASSWORD_DEFAULT);
            $email = $_POST['registerEmail'];


            
            // Query per selezionare l'utente con le credenziali fornite
            $query = "INSERT INTO utenti (nome_utente, email, password) VALUES (?,?,?)";
            // Preparo la query
            $stmt = $conn->prepare($query);
            // Associo i parametri alla query, "ss" indica che sono due stringhe
            $stmt->bind_param("sss", $username, $email, $password);


            // Eseguo la query
            if($stmt->execute()){
                 // L'inserimento è avvenuto con successo
                 echo "<div class=\"switch-form\">
                         Registrazione effettuata con successo!
                       </div>"; 
                       
            } else {
                  // Si è verificato un errore
                  echo "<div class=\"switch-form\">
                          Errore durante la registrazione!
                        </div>"; 
            }
          

            $stmt->close();

        }



    ?>

    <script>
        function showRegistration() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registrationForm').style.display = 'block';
        }

        function showLogin() {
            document.getElementById('registrationForm').style.display = 'none';
            document.getElementById('loginForm').style.display = 'block';
        }

        function showMessage(message, id) {
            alert("Ciao");
            console.log("Hello world!");
            document.getElementById(id).innerHTML = message;
        }        
    </script>
</body>
</html>


