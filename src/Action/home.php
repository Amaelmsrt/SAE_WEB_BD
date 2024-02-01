<h1>SPOTIUT'0</h1>

<h2>Ecouté récemment :</h2>

<?php   

use DB\DataBaseManager;

$manager = new DataBaseManager();
$son = $manager->getSonDB();
$sons = $son->findEcouter($_SESSION['user']);

foreach ($sons as $son) : ?>
    <p><?= $son->getTitre() ?></p>
<?php endforeach; ?>

<h2>Découvrir :</h2>



<div>

    <a href="index.php?action=home">Home</a>
    <a href="index.php?action=search">Search</a>
    <a href="index.php?action=playlist">Playlist</a>

</div>

<a href="index.php?action=deconnexion">Déconnexion</a>