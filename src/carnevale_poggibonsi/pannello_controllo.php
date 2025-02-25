<?php
session_start();
require_once('includes/db.php');

if (!isset($_SESSION['codice_fiscale'])) {
    header("Location: index.php");
    exit();
}


    $stmt = $conn->prepare("SELECT id_maschera FROM Scelte WHERE codice_fiscale = ?");
    $stmt->bind_param("s", $codice_fiscale);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        // Recupera il nome della maschera scelta
        $stmt_maschera = $conn->prepare("SELECT nome_maschera FROM Maschere WHERE id_maschera = ?");
        $stmt_maschera->bind_param("i", $id_maschera_scelta);
        $stmt_maschera->execute();
        $stmt_maschera->bind_result($nome_maschera_scelta);
        $stmt_maschera->fetch();

    }



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_maschera = $_POST['id_maschera'];
    $codice_fiscale = $_SESSION['codice_fiscale'];
    
    // Verifica se l'utente ha già scelto una maschera
    $stmt = $conn->prepare("SELECT * FROM Scelte WHERE codice_fiscale = ?");
    $stmt->bind_param("s", $codice_fiscale);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $errore = "Hai già scelto una maschera.";
    } else {
        // Verifica il numero di partecipanti per la maschera scelta
        $stmt = $conn->prepare("SELECT COUNT(*) as num FROM Scelte WHERE id_maschera = ?");
        $stmt->bind_param("i", $id_maschera);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($row['num'] < 50) {
            // Registra la scelta
            $stmt = $conn->prepare("INSERT INTO Scelte (codice_fiscale, id_maschera) VALUES (?, ?)");
            $stmt->bind_param("si", $codice_fiscale, $id_maschera);
            $stmt->execute();
            header("Location: conferma.php");
            exit();
        } else {
            $errore = "La maschera scelta ha raggiunto il limite di 50 partecipanti.";
        }
    }
    $stmt->close();
}

// Recupera le maschere con meno di 50 partecipanti
$sql = "SELECT m.id_maschera, m.nome_maschera, COUNT(s.id_scelte) as num_partecipanti
        FROM Maschere m
        LEFT JOIN Scelte s ON m.id_maschera = s.id_maschera
        GROUP BY m.id_maschera
        HAVING num_partecipanti < 50";
$result = $conn->query($sql);
$maschere = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Pannello di Controllo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
        }

        ul {
            list-style-type: none;
            padding-top: 20px;
        }
        li {
            background-color: #fff;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        li:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            
color: #333;
            text-align: center;
        }
        p {
            background-color: #ffebee;
            color: #d32f2f;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        form {
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 
0, 0, 0.1);
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            appearance: none;
            background-image: url('data:image/svg+xml;utf8,<svg fill="%23444" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M7 10l5 5 5-5z"/></svg>');
            background-repeat: no-repeat;
            background-position-x: 100%;
            background-position-y: 50%;
            background-color: #fff;
        }
        option {
            padding: 10px;
        }
        input[type="
submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }


    </style>
</head>
<body>
    <h1>Scegli una Maschera</h1>
    <?php if (isset($errore)) echo "<p>$errore</p>"; ?>
    <form method="POST" action="pannello_controllo.php">
        <select name="id_maschera" required>
            <?php foreach ($maschere as $maschera): ?>
                <option value="<?= $maschera['id_maschera'] ?>"><?= $maschera['nome_maschera'] ?> (Partecipanti: <?= $maschera['num_partecipanti'] ?>)</option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Scegli">
    </form>
    <h2>Partecipanti per Maschera</h2>
    <ul>
        <?php foreach ($maschere as $maschera): ?>
            <li><?= $maschera['nome_maschera'] ?>: <?= $maschera['num_partecipanti'] ?> partecipanti</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
