<?php 
session_start();

$title = "User Creation";
require_once "_inc/header.php";

require_once "Users.php";

$users = new Users(MongoPOO::$dsn);

$usersToAdd = [
    ['name' => 'Administrator', 'password' => 'admin123', 'role' => 'admin'],
    ['name' => 'Tony', 'password' => 'tony123', 'role' => 'user'],
    ['name' => 'Lucie', 'password' => 'lucie23', 'role' => 'user'],
    ['name' => 'Louis', 'password' => 'louis123', 'role' => 'user']
];

$users->addDatas(MongoPOO::$dbName, MongoPOO::$collectionUsers, $usersToAdd);
header('Location: usersList.php');
exit;
?>
