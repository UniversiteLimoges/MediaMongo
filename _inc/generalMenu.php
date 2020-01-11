<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="usersList.php">Utilisateurs</a></li>
        <?php
            if(isset($_SESSION['connect']) && $_SESSION['connect']) {
                echo "<li><a href='logout.php'>Deconnexion</a></li>";
            } 
        ?>
    </ul>
</nav>