<?php
$title = "User listing";
require_once "_inc/header.php";
require_once "MongoPOO.php";

$mongo = new MongoPOO(MongoPOO::$dsn);
$mongo->displayUsers(MongoPOO::$dbName, MongoPOO::$collectionUsers);
