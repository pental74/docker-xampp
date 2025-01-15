<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['fname'];
    $cognome = $_POST['lname'];
    $username = $_POST['uname'];

    
    echo $nome . "<br>";
    echo $cognome . "<br>";
    echo $username . "<br>";


    // Ulteriori elaborazioni come la validazione o l'inserimento nel database
}

?>