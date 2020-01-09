<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<?php
require_once "MongoPOO.php";

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
    [ ['name' => 'Zap'], ['$set' => ['flavor' => 'Bzazt!'] ] ],
    [ ['name' => 'Blast'], ['$set' => ['flavor' => 'FWOOM!']] ]
];

$mongo = new MongoPOO($dsn);

// $mongo->deleteDatas($dbName, $collectionSpells);
// $mongo->addDatas($dbName, $collectionSpells, $valuesToAdd);
// $mongo->updateDatas($dbName, $collectionSpells, $valuesToUpdate);

// $filter = ['level' => 1];
// $mongo->displaySpells($dbName, $collectionSpells, $filter);
// $mongo->displaySpells($dbName, $collectionSpells);

$mongo->displayBooks($dbName, $collectionLivres);
?>
</body>
</html>
