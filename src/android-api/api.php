<?php
require_once 'config.php';
//header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    // CREATE
    case 'POST':
        if(isset($_POST['nome']) && isset($_POST['email'])) {
            $stmt = $conn->prepare("INSERT INTO utenti (nome, email, telefono) VALUES (?, ?, ?)");
            $stmt->execute([$_POST['nome'], $_POST['email'], $_POST['telefono']]);
            echo json_encode(['message' => 'Utente creato con successo']);
        }
        break;

    // READ ALL
    case 'GET':
        if(isset($_GET['id'])) {
            // READ SINGLE
            $stmt = $conn->prepare("SELECT * FROM utenti WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch(PDO::FETCH_ASSOC));
        } elseif(isset($_GET['search'])) {
            // SEARCH
            $search = "%" . $_GET['search'] . "%";
            $stmt = $conn->prepare("SELECT * FROM utenti WHERE nome LIKE ? OR email LIKE ?");
            $stmt->execute([$search, $search]);
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        } else {
            // READ ALL
            $stmt = $conn->query("SELECT * FROM utenti");
            echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        }
        break;

    // UPDATE
    case 'PUT':
        parse_str(file_get_contents("php://input"), $put_vars);
        if(isset($put_vars['id'])) {
            $stmt = $conn->prepare("UPDATE utenti SET nome = ?, email = ?, telefono = ? WHERE id = ?");
            $stmt->execute([$put_vars['nome'], $put_vars['email'], $put_vars['telefono'], $put_vars['id']]);
            echo json_encode(['message' => 'Utente aggiornato con successo']);
        }
        break;

    // DELETE
    case 'DELETE':
        parse_str(file_get_contents("php://input"), $delete_vars);
        if(isset($delete_vars['id'])) {
            $stmt = $conn->prepare("DELETE FROM utenti WHERE id = ?");
            $stmt->execute([$delete_vars['id']]);
            echo json_encode(['message' => 'Utente eliminato con successo']);
        }
        break;
}
?>