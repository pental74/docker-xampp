<?php
  $servername = "db";
  $username = "user";
  $password = "user";
  $dbname = "root_db";
  
  try
  {
    $dsn = "mysql:host=$servername;dbname=$dbname;user=$username;password=$password";
    $conn = new PDO($dsn);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connessione riuscita";
  } 
  catch (PDOExcption $e) 
  {
    echo "Connection failed: " . $e->getMessage();
  }
?>
