<?php

use DB\DataBaseManager;

$message_erreur = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];
    $mdpConfirmation = $_POST['mdpConfirmation'];

    if (strlen($mdp) < 8) {
        $message_erreur = "Le mot de passe doit contenir au moins 8 caractères.";
    }
    if (!preg_match('/\d/', $mdp)) {
        $message_erreur = "Le mot de passe doit contenir au moins un chiffre.";
    } 
    if (!preg_match('/[A-Z]/', $mdp)) {
        $message_erreur = "Le mot de passe doit contenir au moins une lettre majuscule.";
    }
    if ($mdp !== $mdpConfirmation) {
        $message_erreur = "Les mots de passe ne correspondent pas.";
    }

    if ($message_erreur === "") {
        $manager = new DataBaseManager();
        $utilisateurBD = $manager->getUtilisateurDB();
        $utilisateur = $utilisateurBD-> find($pseudo);
        if ($utilisateur === null) {
            $utilisateurBD->insertUser($nom, $prenom, $pseudo, $mdp);
            header('Location: index.php?action=connexion');
        } else {
            $message_erreur = "Ce pseudo est déjà utilisé.";
        }
    }

}

?>

<h1>SPOTIUT'O</h1>

<h3>Inscription</h3>
<div class="inscription">
    <form action="index.php?action=inscription" method="post">
        <div class="champs">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" id="prenom" required>
            <label for="pseudo">Pseudo</label>
            <input type="text" name="pseudo" id="pseudo" required>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp" id="mdp" required>
            <label for="mdpConfirmation">Confirmation du mot de passe</label>
            <input type="password" name="mdpConfirmation" id="mdpConfirmation" required>
        </div>
        <?php
            if (!empty($message_erreur)) {
                echo "<p class='erreur'>$message_erreur</p>";
            }
        ?>
        <div class="boutons">
            <a href="index.php?action=connexion">Connexion</a>
            <button type="submit">M'inscrire</button>
        </div>
    </form>
<div class="inscription">