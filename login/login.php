<?php
session_start();
ob_start(); 
require 'db.php';  

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica le credenziali dell'utente
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // Confronto con la password 
    if ($user && $password === $user['password']) {
        // Creare la sessione
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Reindirizzamento a `arearis.php`
        header("Location: arearis.php"); 
        exit;
    } else {
        $error = "Credenziali non valide.";
    }

    $stmt->close();
}
$conn->close();
ob_end_flush(); 
?>


<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link href="login.css" rel="stylesheet" type="text/css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
