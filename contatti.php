<?php include 'menu.php'; ?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style/footer.css" rel="stylesheet" type="text/css">
    <link href="style/form.css" rel="stylesheet" type="text/css">
    <link href="style/menu.css" rel="stylesheet" type="text/css">
    <link href="style/style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="img/icon.png">
    <title>Contatti</title>

    <style>
        html, body {
            background: url(img/sfondo.jpg) no-repeat center center/cover;
            color: white;
            max-height: fit-content;
        } 

        form {
            margin-top: 100px;
        }
        footer{
            margin-top: 120px;

        }
        .logo img {
            height: 150px;
            width: 150px;
        }

        @media (max-width: 768px) {
            body {
                min-height: 700px;
            }
        }
    </style>
</head>
<body>
    <?php require 'form.php'; ?>
    
</body>
<footer>
<?php require 'footer.php'; ?>
</footer>
</html>
