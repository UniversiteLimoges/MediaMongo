<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="main.css">
    <title>MediaMongo</title>
</head>
<?php
require_once "MongoPOO.php";
// var_dump($_POST);

$dsn = "mongodb://localhost:27017";
$dbName = "BenoitCrespin";
$collectionLivres = "livres";
$collectionSpells = "Spells";

$valuesToAdd = [
    ['name' => 'Poke', 'level' => 1],
    ['name' => 'Zap', 'level' => 1],
    ['name' => 'Blast', 'level' => 2]
];

$valuesToUpdate = [
    [ ['name' => 'Poke'], ['$set' => ['flavor' => 'Snick snick!']] ],
    [ ['name' => 'Zap'], ['$set' => ['flavor' => 'Bzazt!']] ],
    [ ['name' => 'Blast'], ['$set' => ['flavor' => 'FWOOM!']] ]
];

$mongo = new MongoPOO($dsn);

// $mongo->deleteDatas($dbName, $collectionSpells);
// $mongo->addDatas($dbName, $collectionSpells, $valuesToAdd);
// $mongo->updateDatas($dbName, $collectionSpells, $valuesToUpdate);

// $filter = ['level' => 1];
// $mongo->displaySpells($dbName, $collectionSpells, $filter);
// $mongo->displaySpells($dbName, $collectionSpells);

// $mongo->displayBooks($dbName, $collectionLivres);
?>
<h1><?= "Bienvenue " . $_POST["username"] ." !" ?></h1>
<h2>Bibliothèque</h2>
<?php $mongo->displayBooks($dbName, $collectionLivres); ?>

<h2>Vos emprunts</h2>
