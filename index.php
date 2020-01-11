<?php 
session_start();

require_once "_inc/header.php"; 

// var_dump($_GET);
// echo "<pre>";
// var_dump($_SERVER);

// if($_GET['disconnect']) {
//     session_destroy();
// }
if(isset($_SESSION['formUsername'])) {
    $formUsername = $_SESSION['formUsername'];
} else {
    $formUsername = "";
}

if(isset($_SESSION['connect']) && $_SESSION['connect']) {
    header('Location: listing.php');
    exit;
} 

$title = "Website";
?>

    <h1>Bienvenue dans votre bibliothèque</h1>
    <p>Identifiez vous pour accéder à votre compte</p>

    <form action="listing.php" method="post" class="listing">
        <label>Utilisateur : 
        <input type="text" name="username" placeholder="Entrez votre prénom" value="<?= $formUsername ?>">
        </label>
        <label>Mot de passe : 
        <input type="password" name="password" placeholder="Entrez votre mot de passe">
        </label>
        <button>Connexion</button>
    </form>

</body>
</html>