<?php
/**
 * index.php
 * 
 * Description: This file is the main dashboard for the chat application.
 * It displays the available chat rooms, allows users to create new rooms,
 * and lets users select and interact with individual rooms.
 * 
 * @version 1.0
 * @author  [Your Name]
 */
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
 *
 * This function queries the 'stanze' table to retrieve a list of all
 * available chat rooms, including their unique identifiers and names.
 *
 * @param PDO $conn The PDO database connection object.
 */
$sql = "SELECT DISTINCT * FROM stanze";
$result = $conn->query($sql);
$rooms = [];
if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        $rooms[] = ['numero_stanza' => $row['codice'], 'nome' => $row['nome']];
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
 * @param PDO $conn The PDO database connection object.
 */
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
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Benvenuto, <?php echo $username; ?>! </h1>
        <a href="logout.php" class="btn btn-danger mt-3">Logout</a>
        <a href=# class="btn btn-success mt-3">Crea Nuova Stanza</a>
    </div>

    <div class="container mt-5"> <h2 class="fw-bold pb-2">Chat Rooms</h2>
        <?php
        if (count($rooms) > 0) {
            foreach ($rooms as $room){ ?>
                <a href="chat.php?room=<?php echo $room['numero_stanza']; ?>" class="text-decoration-none"> 
                    <div class="card mb-4">
                        <div class="card-header">
                            <h2 class="card-title"><?php echo $room['nome'] ?></h2>
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

