<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$userDB = $manager->getUtilisateurDB();
$id = $_POST['id_utilisateur'];
$user = $userDB->find($id);
$user->setNom($_POST['nom_utilisateur']);
$user->setPrenom($_POST['prenom_utilisateur']);
$user->setPseudo($_POST['pseudo_utilisateur']);
$user->setEmail($_POST['email_utilisateur']);
$user->setMdp($_POST['mdp_utilisateur']);
$user->setStatut($_POST['statut_utilisateur']);
$userDB->update($user);
header('Location: index.php?action=admin');
exit();