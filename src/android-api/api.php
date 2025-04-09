<?php
    require_once 'config.php';
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Content-Type');

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        // CREATE
        case 'POST':
            $data = json_decode(file_get_contents("php://input"), true);
            // Debug: restituisci i dati ricevuti (opzionale)
            // file_put_contents('debug.log', print_r($data, true));
            if (isset($data['nome']) && isset($data['email']) && isset($data['telefono'])) {
                $stmt = mysqli_prepare($conn, "INSERT INTO utenti (nome, email, telefono) VALUES (?, ?, ?)");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sss", $data['nome'], $data['email'], $data['telefono']);
                    if (mysqli_stmt_execute($stmt)) {
                        $id = mysqli_insert_id($conn);
                        echo json_encode(['message' => 'Utente creato con successo', 'id' => $id]);
                    } else {
                        echo json_encode(['error' => 'Errore nella creazione: ' . mysqli_stmt_error($stmt)]);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(['error' => 'Errore nella preparazione della query: ' . mysqli_error($conn)]);
                }
            } else {
                echo json_encode(['error' => 'Nome, email e telefono sono obbligatori', 'data_received' => $data]);
            }
            break;

        // READ ALL / READ SINGLE / SEARCH
        case 'GET':
            if (isset($_GET['id'])) {
                // READ SINGLE
                $stmt = mysqli_prepare($conn, "SELECT * FROM utenti WHERE id = ?");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $_GET['id']);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $utente = mysqli_fetch_assoc($result);
                    echo json_encode($utente ? $utente : ['error' => 'Utente non trovato']);
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(['error' => 'Errore nella preparazione della query: ' . mysqli_error($conn)]);
                }
            } elseif (isset($_GET['search'])) {
                // SEARCH
                $search = "%" . $_GET['search'] . "%";
                $stmt = mysqli_prepare($conn, "SELECT * FROM utenti WHERE nome LIKE ? OR email LIKE ?");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "ss", $search, $search);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $utenti = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $utenti[] = $row;
                    }
                    echo json_encode($utenti);
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(['error' => 'Errore nella preparazione della query: ' . mysqli_error($conn)]);
                }
            } else {
                // READ ALL
                $result = mysqli_query($conn, "SELECT * FROM utenti");
                if ($result) {
                    $utenti = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $utenti[] = $row;
                    }
                    echo json_encode($utenti);
                } else {
                    echo json_encode(['error' => 'Errore nella lettura: ' . mysqli_error($conn)]);
                }
            }
            break;

        // UPDATE
        case 'PUT':
            $data = json_decode(file_get_contents("php://input"), true); // Usa JSON invece di parse_str
            if (isset($data['id']) && isset($data['nome']) && isset($data['email']) && isset($data['telefono'])) {
                $stmt = mysqli_prepare($conn, "UPDATE utenti SET nome = ?, email = ?, telefono = ? WHERE id = ?");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "sssi", $data['nome'], $data['email'], $data['telefono'], $data['id']);
                    if (mysqli_stmt_execute($stmt)) {
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            echo json_encode(['message' => 'Utente aggiornato con successo']);
                        } else {
                            echo json_encode(['error' => 'Nessun utente aggiornato (ID non trovato)']);
                        }
                    } else {
                        echo json_encode(['error' => 'Errore nell\'aggiornamento: ' . mysqli_stmt_error($stmt)]);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(['error' => 'Errore nella preparazione della query: ' . mysqli_error($conn)]);
                }
            } else {
                echo json_encode(['error' => 'ID, nome, email e telefono sono obbligatori']);
            }
            break;

        // DELETE
        case 'DELETE':
            $data = json_decode(file_get_contents("php://input"), true); // Usa JSON invece di $_GET
            if (isset($data['id'])) {
                $stmt = mysqli_prepare($conn, "DELETE FROM utenti WHERE id = ?");
                if ($stmt) {
                    mysqli_stmt_bind_param($stmt, "i", $data['id']);
                    if (mysqli_stmt_execute($stmt)) {
                        if (mysqli_stmt_affected_rows($stmt) > 0) {
                            echo json_encode(['message' => 'Utente eliminato con successo']);
                        } else {
                            echo json_encode(['error' => 'Utente non trovato']);
                        }
                    } else {
                        echo json_encode(['error' => 'Errore nell\'eliminazione: ' . mysqli_stmt_error($stmt)]);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo json_encode(['error' => 'Errore nella preparazione della query: ' . mysqli_error($conn)]);
                }
            } else {
                echo json_encode(['error' => 'ID obbligatorio']);
            }
            break;

        default:
            echo json_encode(['error' => 'Metodo non supportato']);
            break;
}

// Chiudi la connessione
mysqli_close($conn);
?>