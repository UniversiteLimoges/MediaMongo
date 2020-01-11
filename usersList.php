<?php
session_start();

$title = "User listing";
require_once "_inc/header.php";
require_once "Users.php";

echo "<a href='usersAdd.php'>Ajout des utilisateurs</a>";
echo "<a href='usersDelete.php'>Suppression des utilisateurs</a>";

$users = new Users(MongoPOO::$dsn);
$users->displayUsers(MongoPOO::$dbName, MongoPOO::$collectionUsers);
