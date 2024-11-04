<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $image, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: arearis.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM projects WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet" type="text/css">

    <title>Modifica Progetto</title>
</head>
<body>
    <h2>Modifica Progetto</h2>
    <form method="post">
        <label>Titolo:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required><br>
        <label>Descrizione:</label>
        <textarea name="description"><?php echo htmlspecialchars($project['description']); ?></textarea><br>
        <label>Immagine:</label>
        <input type="text" name="image" value="<?php echo htmlspecialchars($project['image']); ?>"><br>
        <button type="submit">Salva Modifiche</button>
    </form>
</body>
</html>
