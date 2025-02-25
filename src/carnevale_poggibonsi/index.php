<?php
session_start();
require_once('includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $codice_fiscale = $_POST['codice_fiscale'];
    $data_nascita = $_POST['data_nascita'];
    
 
    // Verifica credenziali
    $stmt = $conn->prepare("SELECT * FROM Abitanti WHERE codice_fiscale = ? AND data_nascita = ?");
    $stmt->bind_param("ss", $codice_fiscale, $data_nascita);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $_SESSION['codice_fiscale'] = $codice_fiscale;
        header("Location: pannello_controllo.php");
        exit();
    } else {
        $errore = "Credenziali errate.";
    }
    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            display: flex;
            flex-direction: column;

            align-items: center;
        }
        h1 {
            color: #333;
            text-align: center;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            display: flex;
            flex-direction: column;
        }
        label {

            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        p {
            color: red;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Carnevale di Paggibonsi 2025</h1>
    <h2>Login</h2>
    <?php if (isset($errore)) echo "<p>$errore</p>"; ?>
    <form method="POST" action="login.php">
        <label>Codice Fiscale:</label>
        <input type="text" name="codice_fiscale" required>
        <label>Data di Nascita:</label>
        <input type="date" name="data_nascita" required>
        <input type="submit" value="Accedi">
    </form>
</body>
</html>
