<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $messaggio = $_POST['messaggio'];

    $stmt = $conn->prepare("INSERT INTO utenti (nome, email, telefono, messaggio) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $email, $telefono, $messaggio);
    $stmt->execute();
    $stmt->close();

    header("Location: arearis.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet" type="text/css">

    <title>Aggiungi Utente</title>
</head>
<body>
    <h2>Aggiungi Utente</h2>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" required><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Telefono:</label>
        <input type="text" name="telefono" required><br>
        <label>Messaggio:</label>
        <textarea name="messaggio" required></textarea><br>
        <button type="submit">Aggiungi Utente</button>
    </form>
</body>
</html>
