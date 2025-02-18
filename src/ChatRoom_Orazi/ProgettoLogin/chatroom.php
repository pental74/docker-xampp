<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatroom</title>
    <link rel="stylesheet" href="chatroom.css">
    <script>
        let selectedUser = '';

        function selectUser(user, id) {
            
            <?php 
            //print_r ($_SESSION['id_stanza']);
            //echo $_SESSION['id_stanza'];


          ?>

            selectedUser = user;
            document.getElementById('chat-user').textContent = `Chat con '.<?php 
            print_r ($_SESSION['id_stanza']);?>;
            document.getElementById('selectedUser').value = user;
            document.getElementById('chat-messages').innerHTML = '';
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Utenti</h2>
            <ul id="user-list">
                <!-- <li onclick="selectUser('Mario')">Mario</li>
                <li onclick="selectUser('Luigi')">Luigi</li>
                <li onclick="selectUser('Anna')">Anna</li> -->
                <?php
                include 'Includes/db_connection.php';

                $sql = "SELECT Nome, id FROM Chat"; 
                $result = $conn->query($sql);            

                if ($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        $stanza = $row["Nome"];
                        $id = $row["id"];
                        $_SESSION['id_stanza'] = 0;   
                        echo $_SESSION['id_stanza'];      
                        echo "<li onclick=\"selectUser('$stanza', $id)\">$stanza</li>";
                    }    
                }
               else {
                    echo "<li>Nessun utente trovato</li>";
                }
                ?>
            </ul>            
              
    </div>
        <div class="chat-container">
            <div class="chat-header">
                <h1 id="chat-user">Chatroom</h1>
            </div>
            <div class="chat-messages" id="chat-messages">
                <!-- Messaggi della chat -->
                <?php
                    include 'Includes/db_connection.php';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $message = htmlspecialchars($_POST['message']);
                        $selectedUser = htmlspecialchars($_POST['selectedUser']);
                        // Ottieni l'orario corrente
                        $timestamp = date('Y-m-d H:i:s');
                        
                        // Genera un id_chat univoco
                        //$id_chat = uniqid('chat_'); // Usando uniqid() per generare un ID univoco

                        // La query di inserimento include `id_chat`
                        $id_stanza = $_SESSION['id_stanza'];
                        $sql = "INSERT INTO Messaggio (id_chat, Testo, id_utente, Orario) VALUES ('$id_stanza', '$message', '$selectedUser', '$timestamp')";
                        echo $sql;
                        exit();
                        // Esegui la query
                        if ($conn->query($sql) === TRUE) {
                            echo "<div class='chat-message'><strong>$selectedUser:</strong> $message</div>";
                        } else {
                            echo "Errore: " . $conn->error;
                        }
                    }
                ?>
            </div>
            <div class="chat-input">
                <form method="POST" action="">
                    <input type="hidden" name="selectedUser" id="selectedUser" value="">
                    <input type="text" name="message" id="message-input" placeholder="Scrivi un messaggio...">
                    <button type="submit">Invia</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
