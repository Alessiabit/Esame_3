<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("INSERT INTO projects (title, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $image);
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

    <title>Aggiungi Progetto</title>
</head>
<body>
    <h2>Aggiungi Progetto</h2>
    <form method="post">
        <label>Titolo:</label>
        <input type="text" name="title" required><br>
        <label>Descrizione:</label>
        <textarea name="description" required></textarea><br>
        <label>Immagine (URL):</label>
        <input type="text" name="image"><br>
        <button type="submit">Aggiungi Progetto</button>
    </form>
</body>
</html>
