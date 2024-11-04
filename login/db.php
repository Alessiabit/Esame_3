<?php
$host = '127.0.0.1';
$db = 'esame';
$user = 'root';
$pass = '';


// Creazione della connessione
$conn = new mysqli($host, $user, $pass, $db);

// Verifica della connessione
if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
?>
