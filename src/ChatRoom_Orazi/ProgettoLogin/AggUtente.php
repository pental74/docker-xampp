<?php
session_start();
include 'Includes/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $user = htmlspecialchars($_POST["user"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Verifica se l'utente esiste già
    $sql_check = "SELECT COUNT(*) AS count FROM Utenti WHERE Nome_utente = '$user'";
    $result_check = $conn->query($sql_check);
    $row = $result_check->fetch_assoc();

    // Se l'utente esiste già, mostra un errore
    if ($row['count'] > 0) {
        echo "Errore: Il nome utente è già in uso.";
    } else {
        // Se l'utente non esiste, inserisci il nuovo utente
        // Ricorda di fare attenzione alla sicurezza (SQL Injection)
        $sql_ins = "INSERT INTO Utenti (Nome_utente, email, Password) VALUES ('$user', '$email', '$password')";
        $result_ins = $conn->query($sql_ins);

        // Verifica se l'inserimento è riuscito
        if ($result_ins) {
            echo "Utente aggiunto con successo!";
        } else {
            echo "Errore durante l'aggiunta dell'utente";
        }
    }
} else {
    echo "Metodo non riuscito";
}
?>