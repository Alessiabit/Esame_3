<?php
session_start();
require 'db.php';

// Controlla se l'utente è autenticato
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $messaggio = $_POST['messaggio'];

    $stmt = $conn->prepare("UPDATE utenti SET nome = ?, email = ?, telefono = ?, messaggio = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $nome, $email, $telefono, $messaggio, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: arearis.php");
    exit;
}

// Ottieni i dati dell'utente da modificare
$stmt = $conn->prepare("SELECT * FROM utenti WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet" type="text/css">

    <title>Modifica Utente</title>
</head>
<body>
    <h2>Modifica Utente</h2>
    <form method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required><br>
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <label>Telefono:</label>
        <input type="text" name="telefono" value="<?php echo htmlspecialchars($user['telefono']); ?>" required><br>
        <label>Messaggio:</label>
        <textarea name="messaggio" required><?php echo htmlspecialchars($user['messaggio']); ?></textarea><br>
        <button type="submit">Salva Modifiche</button>
    </form>
</body>
</html>
