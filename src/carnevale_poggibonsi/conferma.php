<?php
session_start();
require_once('includes/db.php');

if (!isset($_SESSION['codice_fiscale'])) {
    header("Location: index.php");
    exit();
}


$codice_fiscale = $_SESSION['codice_fiscale'];

// Recupera la maschera scelta dall'utente
$stmt = $conn->prepare("SELECT m.nome_maschera FROM Scelte s JOIN Maschere m ON s.id_maschera = m.id_maschera WHERE s.codice_fiscale = ?");
$stmt->bind_param("s", $codice_fiscale);
$stmt->execute();
$result = $stmt->get_result();
$scelta = $result->fetch_assoc();
$stmt->close();

// Recupera tutte le maschere con il numero di partecipanti
$sql = "SELECT m.nome_maschera, COUNT(s.id_scelte) as num_partecipanti
        FROM Maschere m
        LEFT JOIN Scelte s ON m.id_maschera = s.id_maschera
        GROUP BY m.id_maschera";
$result = $conn->query($sql);
$maschere = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title
>Conferma Scelta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 20px;
            background-color: #f4f4f4;

            color: #333;
        }
        h1, h2 {
            color: #444;
            margin-bottom: 10px;
        }
        h1 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
        }
        p {
            margin-bottom: 15px;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            background-color: #
fff;
            padding: 10px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        li:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <h1>Conferma della Scelta</h1>
    <?php if ($scelta): ?>
        <p>Hai scelto la maschera: <?= $scelta['nome_maschera'] ?></p>
    <?php else: ?>
        <p>Non hai ancora scelto una maschera.</p>
    <?php endif; ?>
    
    <h2>Partecipanti per Maschera</h2>
    <ul>
        <?php foreach ($maschere as $maschera): ?>
            <li><?= $maschera['nome_maschera'] ?>: <?= $maschera['num_partecipanti'] ?> partecipanti</li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
