<?php 
session_start();
require_once "Books.php";
require_once "Users.php";

$books = new Books(MongoPOO::$dsn);
$user = new Users(MongoPOO::$dsn);

// Form verification
if(isset($_POST["username"]) and $_POST["username"]) {
    $formUsername = $_POST["username"];
    $_SESSION['username'] = $formUsername;

    if(isset($_POST["password"])) {
        $formPassword = $_POST["password"];
    }

    // Query and validation
    $query = $books->initQuery(MongoPOO::$dbName, MongoPOO::$collectionUsers);
    foreach($query as $row) {
        if($formUsername === $row->name && $formPassword === $row->password) {
            $connect = true;
            $_SESSION['connect'] = $connect;
        } 
    }
} else {

}

require_once "_inc/header.php";

// Redirection if not connected
if(!$_SESSION['connect']) {
    header('Location: login.php');
    exit;
}
?>

<h1><?= "Bienvenue " . $_SESSION['username'] ." !" ?></h1>
<h2>Bibliothèque</h2>
<?php $books->displayBooks(MongoPOO::$dbName, MongoPOO::$collectionBooks); ?>

<h2>Vos emprunts</h2>
<?php

$userName = ['name' => $user->getUser()];
if(isset($_POST) and !empty($_POST) and $_POST[array_keys($_POST)[0]] === "Emprunter") {
    $bookTakenID = array_keys($_POST)[0];
    $userName = ['name' => $user->getUser()];

    $userCurrentID = ['_id' => $user->getMongoDbObjectId($user, MongoPOO::$dbName, MongoPOO::$collectionUsers, $userName)];
    
    $nbReservations = Users::userNbReservations();
    // $books = [];

    // $bookSelectedToAdd = [
    //     '$set' => ['
    //         books' => 
    //             // [['book'. $nbReservations => $bookTakenID], 'bite' => 'cjoe']
    //             [['book'=> $bookTakenID], ['book2' => 'cjoe']]
    //     ]
    // ];

    $bookSelectedToAdd = [
        '$set' => ['books' => ['book'=> $bookTakenID]]
    ];

    $books->addBookToUser(MongoPOO::$dbName, MongoPOO::$collectionUsers, $userCurrentID, $bookSelectedToAdd);
}

$books->displayBooksTaken(MongoPOO::$dbName, MongoPOO::$collectionBooks, $userName); 

// foreach($query as $row) {
//     echo $row->name;
//     echo $row->password;
// }
?>