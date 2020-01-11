<?php 
session_start();

require_once "Books.php";
$books = new Books(MongoPOO::$dsn);
// var_dump($_POST['username']);

if(isset($_POST["username"])) {
    $formUsername = $_POST["username"];
    $_SESSION['formUsername'] = $formUsername;

    if(isset($_POST["password"])) {
        $formPassword = $_POST["password"];
    }

    $query = $books->initQuery(MongoPOO::$dbName, MongoPOO::$collectionUsers);
    foreach($query as $row) {
        if($formUsername === $row->name && $formPassword === $row->password) {
            $connect = true;

            $_SESSION['connect'] = $connect;
            $_SESSION['formUsername'] = $formUsername;
        } 
    }
} else {
    $formUsername = "";
}
require_once "_inc/header.php";

// Redirection if not connected
if(!$_SESSION['connect']) {
    header('Location: index.php');
    exit;
}
?>

<h1><?= "Bienvenue " . $formUsername ." !" ?></h1>
<h2>Bibliothèque</h2>
<?php $books->displayBooks(MongoPOO::$dbName, MongoPOO::$collectionBooks); ?>
<h2>Vos emprunts</h2>
<?php $books->displayBooksTaken(MongoPOO::$dbName, MongoPOO::$collectionBooks); ?>

