<?php 
    session_start();
    require_once('includes/db.php');


    // query per stampare la lista dei link 
    // creare un form per inserire un shortlink
    // funzione php che crei l'hash per creare il link shortato
    //      - parte del nome dell'utente: prime due lettere mail e ultime due    

    // Function to generate a short link hash
    function generateShortLinkHash($username, $originalLink) {
        // Hash the combined string (you can use other hashing algorithms)
        $hash = md5($originalLink);
        // Take a portion of the hash to make it shorter (e.g., the first 8 characters)
        $shortHash = substr($hash, 0, 8);

        // Combine username and original link
        $combinedString = substr($username, 0, 2).$shortHash;
        return $combinedString;
    }

        // Handle the form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['link']) && isset($_SESSION['username'])) {
            $originalLink = $_POST['link'];
            $username = $_SESSION['username'];
            $id_user = $_SESSION['id_user'];

            // Generate the short link hash
            $shortHash = generateShortLinkHash($username, $originalLink);

            // Query per inserire l'utente con le credenziali fornite
            $query = "INSERT INTO linkshortati (originalLink, linkshortato, id_utente) VALUES (?,?,?)";

            // Preparo la query
            $stmt = $conn->prepare($query);
            // Associo i parametri alla query, "ssd" indica che sono due stringhe ed un intero
            $stmt->bind_param("ssd", $originalLink , $shortHash, $id_user);
            // Eseguo la query


            try{    
                $stmt->execute();
            } catch(mysqli_sql_exception $e){
                // Se l'eccezione è una mysqli_sql_exception
                $registration_error = "Utente o e-mail già presente";
            } catch (Exception $e) {
                // Se si verifica un errore generico
                $registration_error = "Errore durante la registrazione";    
            }
            
            // Create a new file named with the shortHash
            $newFilePath = $shortHash . ".php";
            $file = fopen($newFilePath, "w");
            if ($file) {
                // Create a new PHP file for the shortened link
                $filePath = $shortHash . ".php";
                $fileContent = "<?php\n";
                $fileContent .= "require_once('includes/db.php');\n";
                $fileContent .= "\$shortHash = '$shortHash';\n";

                $fileContent .= "\$stmt = \$conn->prepare(\"UPDATE linkshortati SET visite = visite + 1 WHERE linkshortato = ?\");\n";
                $fileContent .= "\$stmt->bind_param(\"s\", \$shortHash);\n";
                $fileContent .= "\$stmt->execute();\n";


                $fileContent .= "\$stmt = \$conn->prepare(\"SELECT originalLink FROM linkshortati WHERE linkshortato = ?\");\n";
                $fileContent .= "\$stmt->bind_param(\"s\", \$shortHash);\n";
                $fileContent .= "\$stmt->execute();\n";
                $fileContent .= "\$result = \$stmt->get_result();\n";
                $fileContent .= "\$row = \$result->fetch_assoc();\n";
                $fileContent .= "header(\"Location: \" . \$row['originalLink']);\n";
                $fileContent .= "exit;\n";
                $fileContent .= "?>";
                file_put_contents($filePath, $fileContent);
                fclose($file);
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Short Link</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <!-- Stampa tabella con i link shortati -->
    <header>
        <h1>Short Linkner</h1>
    </header>
    <?php
        $sql = "SELECT originalLink, linkshortato, visite FROM linkshortati";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class=\"form-container\"><table>";
            echo "<tr><th>Original Link</th><th>Shortened Link</th><th>Visite</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["originalLink"]. "</td>";
                echo "<td>" . $row["linkshortato"]. "</td>";
                echo "<td>" . (is_null($row["visite"]) ? 0 : $row["visite"]) . "</td>";
                echo "</tr>";
            }
            echo "</table></div>";
        } else {
            echo "0 results";
        }
        $conn->close();
    ?>

    <!-- Form per inserire un shortlink -->

    <div class="form-container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="link">Inserire link da shortare</label>
            <input type="text" id="link" name="link" required>
            <button type="submit">Shortare</button>
        </form>
    </div>
</body>
</html>


