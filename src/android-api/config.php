<?php
// Connessione DB
$host = "db";
$db_name = "android_db";
$username = "user";
$password = "user";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Connessione fallita: " . mysqli_connect_error());
}
?>


<!-- Connessione con classi o PDO
try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Errore connessione: " . $e->getMessage();
}
?> -->
