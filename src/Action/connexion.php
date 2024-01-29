<?php

use DB\DataBaseManager;

$id = $_GET['id'] ?? null;

if (isset($_SESSION[$id])) {
    header("Location: index.php?action=home");
}

$manager = new DataBaseManager();
$utilisateurDB = $manager->getUtilisateurDB();
$messageErreur = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];

    $user = $utilisateurDB->find($pseudo);

    if ($user === null) {
        header("Location: index.php?action=connexion");
    }

    if (password_verify($mdp, $user->getMdp())) {
        $_SESSION[$id] = $user->getId();
        header("Location: index.php?action=home");
    } else {
        $messageErreur = "Mot de passe ou nom d'utilisateur incorrect";
    }
}

?>

<h1> SPOTIUT'O</h1>

<h3>Inscription</h3>
<div class="inscription">
    <form action="index.php?action=connexion" method="post">
        <div class="champs">
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
        </div>
        <?php
            if (!empty($messageErreur)) {
                echo "<p class='erreur'>$messageErreur</p>";
            }
        ?>
        <div class="boutons">
            <a href="index.php?action=inscription">Inscription</a>
            <button type="submit">Me connecter</button>
        </div>
    </form>
<div class="inscription">