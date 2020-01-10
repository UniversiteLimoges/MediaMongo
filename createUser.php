<?php 
$title = "User Creation";
require_once "_inc/header.php";
require_once "MongoPOO.php";

$mongo = new MongoPOO(MongoPOO::$dsn);

$usersToAdd = [
    ['name' => 'Administrator', 'password' => 'admin123', 'role' => 'admin'],
    ['name' => 'Tony', 'password' => 'tony123', 'role' => 'user'],
    ['name' => 'Lucie', 'password' => 'lucie23', 'role' => 'user'],
    ['name' => 'Louis', 'password' => 'louis123', 'role' => 'user']
];

// $mongo->deleteCollection(MongoPOO::$dbName, MongoPOO::$collectionUsers)
$mongo->addDatas(MongoPOO::$dbName, MongoPOO::$collectionUsers, $usersToAdd);

?>
