<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $page_name = $_POST['page_name'];
    $hobbi2 = $_POST['hobbi2'];
    $contenuto = $_POST['contenuto'];
    $paragrafo = $_POST['paragrafo'];
    $conten1 = $_POST['conten1'];
    $hobbi1 = $_POST['hobbi1'];
    $info = $_POST['info'];

    $stmt = $conn->prepare("UPDATE pages SET page_name = ?, hobbi2 = ?, contenuto = ?, paragrafo = ?, conten1 = ?, hobbi1 = ?, info = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $page_name, $hobbi2, $contenuto, $paragrafo, $conten1, $hobbi1, $info, $id);
    $stmt->execute();
    $stmt->close();

    header("Location: arearis.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM pages WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$page = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="styles.css" rel="stylesheet" type="text/css">

    <title>Modifica Pagina</title>
</head>
<body>
    <h2>Modifica Pagina</h2>
    <form method="post">
        <label>Nome Pagina:</label>
        <input type="text" name="page_name" value="<?php echo htmlspecialchars($page['page_name']); ?>" required><br>
        <label>Hobbi2:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($page['hobbi2']); ?>"><br>
        <label>Paragrafo:</label>
        <textarea name="paragrafo"><?php echo htmlspecialchars($page['paragrafo']); ?></textarea><br>
        <input type="text" name="contenuto" value="<?php echo htmlspecialchars($page['contenuto']); ?>" required><br>
        <label>Contenuto:</label>
        <button type="submit">Salva Modifiche</button>
    </form>
</body>
</html>
