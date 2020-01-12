<?php
    if(!isset($title)) $title = "";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./main.css">
    <title>MediaMongo <?= $title ?></title>
</head>
<body>

<nav>
    <ul>
        <li><a href="../index.php">Home</a></li>
        <li><a href="../exercices/index.php">Exercices</a></li>
        <li><a href="../usersList.php">Utilisateurs</a></li>
        <?php
            if(isset($_SESSION['connect']) && $_SESSION['connect']) {
                echo "<li><a href='../logout.php'>Deconnexion</a></li>";
            } 
        ?>
    </ul>
</nav>