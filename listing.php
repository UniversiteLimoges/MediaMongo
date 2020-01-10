<?php 
require_once "_inc/header.php" ;
require_once "MongoPOO.php";
$mongo = new MongoPOO(MongoPOO::$dsn);

// $collectionSpells = "spells";

// $valuesToAdd = [
//     ['name' => 'Poke', 'level' => 1],
//     ['name' => 'Zap', 'level' => 1],
//     ['name' => 'Blast', 'level' => 2]
// ];

// $valuesToUpdate = [
//     [ ['name' => 'Poke'], ['$set' => ['flavor' => 'Snick snick!']] ],
//     [ ['name' => 'Zap'], ['$set' => ['flavor' => 'Bzazt!']] ],
//     [ ['name' => 'Blast'], ['$set' => ['flavor' => 'FWOOM!']] ]
// ];


// $mongo->deleteCollection($dbName, $collectionBooks);
// $mongo->deleteDatas($dbName, $collectionSpells);
// $mongo->addDatas($dbName, $collectionSpells, $valuesToAdd);
// $mongo->updateDatas($dbName, $collectionSpells, $valuesToUpdate);

// $filter = ['level' => 1];
// $mongo->displaySpells($dbName, $collectionSpells, $filter);
// $mongo->displaySpells($dbName, $collectionSpells);
?>

<h1><?= "Bienvenue " . $_POST["username"] ." !" ?></h1>
<h2>Bibliothèque</h2>
<?php $mongo->displayBooks(MongoPOO::$dbName, MongoPOO::$collectionBooks); ?>
<h2>Vos emprunts</h2>
