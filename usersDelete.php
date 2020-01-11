<?php 
session_start();
require_once "_inc/header.php";
require_once "Users.php";

$users = new Users(MongoPOO::$dsn);
$users->deleteCollection(MongoPOO::$dbName, MongoPOO::$collectionUsers);

header('Location: usersList.php');
exit;
?>
