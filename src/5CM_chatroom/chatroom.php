<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];  // username tabella utenti
$id_utente = $_SESSION['id_user'];  // codice tabella utenti

require_once('includes/db.php');   // file connessione al database

/**
 * Retrieve all available rooms from the database.
 */
$sql = "SELECT DISTINCT * FROM stanze";
$result = $conn->query($sql);
$rooms = [];
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $lastMessageSql = "SELECT messaggi.testo, utenti.nome_utente 
                            FROM messaggi 
                            LEFT JOIN utenti ON messaggi.utente_codice = utenti.codice 
                            WHERE stanza_codice = '{$row['codice']}' 
                            ORDER BY data_ora DESC 
                            LIMIT 1";
        $lastMessageResult = $conn->query($lastMessageSql);
        $lastMessage = $lastMessageResult->num_rows > 0 ? $lastMessageResult->fetch_assoc()['testo'] : "Nessun messaggio";
        $rooms[] = ['numero_stanza' => $row['codice'], 'nome' => $row['nome'], 'messaggio' => $lastMessage];
    }


}else {
    $rooms = [];
}
/**
 * Handles the creation of a new room.
 *
 * This function processes the request to create a new chat room,
 * ensuring the room name is provided and inserting the new room
 * into the database.
 *
 */

// Codice php per inserire una nuova stanza nel database
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['new_room_name'])) {
    $new_room_name = htmlspecialchars($_POST['new_room_name']);
    $sql = "INSERT INTO stanze (nome) VALUES ('$new_room_name')";
    $conn->query($sql);
    header("Location: index.php"); // Refresh the page to display the new room
    exit();
}
?>

<!DOCTYPE html>
<!--
    This HTML file is the main layout for the chat dashboard.
-->
<html>
<head>
    <title>Dashboard Stanze</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .room-card {
            background-color: #f8f9fa; /* Light grey */
            border: 1px solid #dee2e6; /* Light grey border */
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="mt-5">Benvenuto, <?php echo $username; ?>! </h3>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success mt-3" data-bs-toggle="modal" data-bs-target="#newRoomModal">
            Crea Nuova Stanza
        </button>
    </div>    

    <!-- Pop up per inserire una nuova stanza --> 
    <div class="modal fade" id="newRoomModal" tabindex="-1" aria-labelledby="newRoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newRoomModalLabel">Crea una Nuova Stanza</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="">
                        <input type="text" name="new_room_name" class="form-control" placeholder="Nome della stanza" required>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5"> <h2 class="fw-bold pb-2">Chat Rooms</h2>
        <?php
        if (count($rooms) > 0) {
            foreach ($rooms as $room){ ?>
                <a href="chat.php?room=<?php echo $room['numero_stanza']; ?>" class=" text-decoration-none"> 
                    <div class="card mb-4 room-card">
                        <div class="card-header">
                            <h2 class="card-title"><?php echo $room['nome'] ?></h2>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php echo $room['messaggio']; ?></p>
                        </div>                      
                    </div>
                </a>
            <?php
            }
        } else {
            echo "<p>No rooms are created.</p>";
        }
        ?>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

