// Suggested code may be subject to a license. Learn more: ~LicenseLog:20194636.
php
<?php
$servername = "db";
$username = "user";
$password = "user";
$dbname = "root_db";
$port= 3306;

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo "Connessione riuscita";
$conn->close();
?>
