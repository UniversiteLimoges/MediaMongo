<?php 
    $title = "Website";
    require_once "_inc/header.php" 
?>

    <h1>Bienvenue dans votre bibliothèque</h1>
    <p>Identifiez vous pour accéder à votre compte</p>

    <form action="listing.php" method="post" class="listing">
        <label>Utilisateur : 
        <input type="text" name="username">
        </label>
        <label>Mot de passe : 
        <input type="password" name="password">
        </label>
        <button>Connexion</button>
    </form>

</body>
</html>