<?php
session_start();

require_once "../_inc/exo.php";
require_once "../Books.php";

$books = new Books(MongoPOO::$dsn);

$numEx = 1;
generateForm($books, $numEx, 'Tous les titres', 'titre_avec_lien_vers_le_catalogue');

$numEx = 2;
// $filter = ['rang' => ['$gt' => '40.0' ]];
// db.livres.find({"fields.rang" : {$gt : 47}})
// $filter = ['recordid' => 'c109457a21dbdf472f2aec9b42cf8b85a3a77642']; 
$filter = ['rang' => ['$gt' => 40 ]]; 
generateForm($books, $numEx, 'Les titres des documents ayant les rangs 1 à 10', 'titre_avec_lien_vers_le_catalogue');
// generateForm($books, $numEx, 'Les titres des documents ayant les rangs 1 à 10');

$numEx = 3;
$regex = new MongoDB\BSON\Regex('^N');
$filter = ['titre_avec_lien_vers_le_catalogue' => [$regex]]; 
// db.livres.find({'fields.titre_avec_lien_vers_le_catalogue' : {$regex : /^N/}})
generateForm($books, $numEx, 'Les auteurs de tous les documents dont le titre commence par la lettre N', 'auteur', ['titre_avec_lien_vers_le_catalogue' => 'New York City : le guide']);
// var_dump($regex);

echo "<h1>4) Toutes les informations vers les documents n'ayant pas de champ 'type_de_document'</h1>";



$numEx = 5;
$aggregate = new \MongoDB\Driver\Command([
    'distinct' => 'type_of_document', 
]);
generateForm($books, $numEx, 'Les différents types de document qui apparaissent dans cette base', 'type_de_document', $aggregate);

// foreach($cursor as $key => $document) {
//     var_dump($document);
// }

function generateForm($instance, $ex, $string, $fieldToDisplay, $filter = null, $aggregate = null) {
    echo "<h1>$ex) $string</h1>";
    $query = $instance->initQuery(MongoPOO::$dbName, MongoPOO::$collectionBooks, $filter);
    
    // $query = $instance->initCommand(MongoPOO::$collectionBooks, $aggregate);

    // var_dump($query);
    echo "<form action='#' method='post'>
        <input type='submit' name='$ex' value='Voir' />
    </form>";

    if(isset($_POST[$ex])) {
        foreach ($query as $row) {
            // print_r($row);
            if(!empty($row->fields->$fieldToDisplay)) {
                echo $row->fields->$fieldToDisplay . "<br>";
            }
        }
    }
}
