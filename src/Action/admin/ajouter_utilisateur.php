<?php

use DB\DataBaseManager;
use Model\Utilisateur;

$manager = new DataBaseManager();
$utilisateurDB = $manager->getUtilisateurDB();
$nom = $_POST['nom_utilisateur'];
$prenom = $_POST['prenom_utilisateur'];
$pseudo = $_POST['pseudo_utilisateur'];
$email = $_POST['email_utilisateur'];
$mdp = $_POST['mdp_utilisateur'];
$statut = $_POST['statut_utilisateur'];
if ($statut == "User") {
    $utilisateur = new Utilisateur(null, $nom, $prenom, $pseudo, $email, $mdp);
    $utilisateurDB->insertUser($nom, $prenom, $pseudo, $email, $mdp);
} elseif ($statut == "Admin") {
    $utilisateur = new Utilisateur(null, $nom, $prenom, $pseudo, $email, $mdp);
    $utilisateur->setStatut("Admin");
    $utilisateurDB->insertAdmin($nom, $prenom, $pseudo, $email, $mdp);
}

header('Location: index.php?action=admin');
exit();