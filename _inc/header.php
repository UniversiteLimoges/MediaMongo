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
        <li><a href="index.php">Home</a></li>
        <li><a href="createUser.php">Ajout d'un utilisateur</a></li>
        <li><a href="listUsers.php">Listing des utilisateurs</a></li>
    </ul>
</nav>