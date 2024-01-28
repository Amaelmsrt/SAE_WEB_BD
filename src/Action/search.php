<?php   

use DB\DataBaseManager;

$manager = new DataBaseManager();
$artist = $manager->getArtistDB();
$artists = $artist->findAll();

?>

<input type="text" name="search" id="search" placeholder="Chercher un artiste">

<div id="lesArtistes">
<?php foreach ($artists as $artist) : ?>
    <div class="artiste">
        <img src="data:image/jpeg;base64,<?= $artist->getPicture() ?>" alt="Photo de l'artiste">
        <p class="artiste__name"><?= $artist->getName() ?></p>
    </div>
<?php endforeach; ?>
</div>




<div>

    <a href="index.php?action=home">Home</a>
    <a href="index.php?action=search">Search</a>
    <a href="index.php?action=playlist">Playlist</a>

</div>