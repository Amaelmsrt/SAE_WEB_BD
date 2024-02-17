<?php

use DB\DataBaseManager;

$manager = new DataBaseManager();
$userDB = $manager->getUtilisateurDB();
$id = $_POST['id_utilisateur'];
$userDB->delete($id);
header('Location: index.php?action=admin');
exit();