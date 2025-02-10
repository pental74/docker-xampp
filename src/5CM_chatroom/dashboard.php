<?php
    session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

$username = $_SESSION['username'];  // username tabella utenti
$id_utente = $_SESSION['id_user'];  // codice tabella utenti

require_once('includes/db.php');   // file connessione al database

// // Function to display messages
// function displayMessages($conn, $room) {
//     $sql = "SELECT username, message, timestamp FROM messages WHERE room = '$room' ORDER BY timestamp ASC";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//             echo "<p><strong>" . $row["username"] . ":</strong> " . $row["message"] . " <small>(" . $row["timestamp"] . ")</small></p>";
//         }
//     } else {
//         echo "<p>No messages yet.</p>";
//     }
// }

// // Function to handle message sending
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['message']) && isset($_POST['room'])) {
//     $message = htmlspecialchars($_POST['message']);
//     $room = $_POST['room'];
//     $sql = "INSERT INTO messages (room, username, message) VALUES ('$room', '$username', '$message')";
//     $conn->query($sql);
// }

// Get all rooms from database
$sql = "SELECT DISTINCT * FROM stanze";
$result = $conn->query($sql);
$rooms = [];
if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){
        var_dump($row);
        exit();
        $rooms[] = $row['nome'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat Rooms</title>
</head>
<body>
    <h1>Welcome, <?php echo $username; ?>!</h1>

    <?php
    if (count($rooms) > 0) {
        foreach ($rooms as $room){ ?>
        <h2>Chat Room: <?php echo $room ?></h2>
        <div id="chatbox-<?php echo $room ?>" style="border: 1px solid black; padding: 10px; margin-bottom: 10px; height: 300px; overflow-y: scroll;">
            <?php //displayMessages($conn, $room); ?>
        </div>
        <form method="post" action="">
            <input type="hidden" name="room" value="<?php echo $room ?>">
            <input type="text" name="message" placeholder="Enter your message" required>
            <button type="submit">Send</button>
        </form>
    <?php
        }
    } else {
        echo "No rooms are created";
    }
    ?>
     <a href="logout.php">Logout</a>
</body>
</html>

