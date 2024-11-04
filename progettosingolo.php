<?php
session_start();

// Connessione al database
include 'login/db.php'; 

// ID di default
$default_id = 1;

// Ottieni l'ID del progetto dall'URL 
$id = isset($_GET['id']) ? intval($_GET['id']) : $default_id;

// Query per ottenere i dettagli del progetto con l'ID specificato
$sql = "SELECT * FROM projects WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$project = $result->fetch_assoc();

// Se non c'è un progetto, mostra un messaggio di errore
if (!$project) {
    echo "<p>Progetto non trovato.</p>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <link href="style/main.css" rel="stylesheet" type="text/css">
    <link href="style/footer.css" rel="stylesheet" type="text/css">
    <link href="style/menu.css" rel="stylesheet" type="text/css">
    <link href="style/form.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title><?php echo htmlspecialchars($project['title']); ?></title>
</head>
<header>
    <?php include 'menu.php'; ?>
</header>
<style>
    .sfondo {
        background: url(img/sfondo.jpg) no-repeat center center/cover;
        height: 400px;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        text-align: center;
    }
    .testo {
        font-size: 20px;
        padding: 20px;
        border-radius: 10px;
    }
</style>
<body>

<section class="sfondo">
    <div class="testo">
        <h1>BENVENUTO!</h1>
        <p>Esplora i dettagli del progetto.</p>
    </div>
</section>

<div class="profilo">
    <h2>DETTAGLI DEL PROGETTO</h2>
</div>
<div class="container">
    <div class="project">
        <img src="<?php echo htmlspecialchars($project['image']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
        <h3><?php echo htmlspecialchars($project['title']); ?></h3>
        <p><?php echo htmlspecialchars($project['description']); ?></p>
    </div>
</div>

<?php include 'form.php'; ?>

<hr>

<?php include 'footer.php'; ?>
</body>
</html>
