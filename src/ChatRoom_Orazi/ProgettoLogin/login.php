<?php
session_start();
require_once 'Includes/db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $user = htmlspecialchars($_POST["user"]);
    $password = htmlspecialchars($_POST["password"]);

    $table = "Utenti";
    $query = "SELECT * FROM $table WHERE Nome_utente = '$user' AND Password = '$password'";

    $result = $conn->query($query);
    
    if($result -> num_rows > 0){
        $row = $result -> fetch_assoc();      

        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user;  
        header('Location: chatroom.php');           
    }
    else
    {
        echo "Accesso non riuscito!";
    }
}
?>

