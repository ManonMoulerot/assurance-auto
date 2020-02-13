<?php
    session_name("formulaire");
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formulaire</title>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="bg">
<h1>Assurtout</h1>
    <form action="login.php" method="post">
        <div class="formulaire animatoo">
            <div class="formulaire-f">
            <label>Nom d'utilisateur * </label><input type = "text" name = "username" class="champs" required>
            <label>Mot de passe * </label><input type = "password" name = "password" class="champs" required>
            <input class="button" type = "submit" value = "Envoyer">
        </div>
        </div>
    </form>
    
</body>
</html>
