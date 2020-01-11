<?php 
session_start();
require_once "_inc/header.php";

require_once "Users.php";

$users = new Users(MongoPOO::$dsn);
$users->addDatas(MongoPOO::$dbName, MongoPOO::$collectionUsers, Users::$usersToAdd);

header('Location: usersList.php');
exit;
?>
