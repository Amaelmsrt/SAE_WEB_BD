<?php   

use DB\DataBaseManager;

$id = $_GET['id'] ?? null;

$manager = new DataBaseManager();
$artistBD = $manager->getArtistDB();
$artist = $artistBD->find($id);
$nbSonLike = $manager->getLikeSonDB()->nbLikeArtist($id, $_SESSION['user']);
$topSon = $manager->getSonDB()->findTop5Artist($id);
$albums = $manager->getAlbumDB()->findAlbumsArtist($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $manager->getLikeArtisteDB()->like($id, $_SESSION['user']);
    unset($_POST['like']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['likeAlbum'])) {
    $manager->getLikeAlbumDB()->like($id, $_SESSION['user']);
    unset($_POST['likeAlbum']);
}
$isLiked = $manager->getLikeArtisteDB()->isLiked($id, $_SESSION['user']);


?>

<a href="index.php?action=search">Retour</a>

<button>Play</button>

<div>
    <img src="data:image/jpeg;base64,<?= $artist->getPicture() ?>" alt="Photo de l'artiste">
    <p><?= $artist->getName() ?></p>
    <form method="post">
        <button type="submit" name="like">Like artiste <?= $isLiked ? "true" : "false" ?></button>
    </form>
    <p><?= $nbSonLike ?> titres likés</p>
</div>

<div>



</div>

<div>

    <h2>Top titres</h2>

    <?php foreach ($topSon as $son) : 
        $album = $manager->getAlbumDB()->find($son->getIdAlbum());
        $artist = $manager->getArtistDB()->find($album->getIdArtiste());
    ?>
        <div class="topSon">
            <img src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="Photo de l'album">
            <p><?= $son->getTitre() ?></p>
            <p><?= $artist->getName() ?></p>
        </div>
    <?php endforeach; ?>

    <h2>Albums</h2>

    <?php foreach ($albums as $album) : 
        $albumLike = $manager->getLikeAlbumDB()->isLiked($album->getId(), $_SESSION['user']);
    ?>
        <div class="album">
            <img src="data:image/jpeg;base64,<?= $album->getCover() ?>" alt="Photo de l'album">
            <p><?= $album->getTitre() ?></p>
            <p><?= $album->getDate() ?></p>
            <p><?= $album->getDescription() ?></p>
            <form method="post">
                <button type="submit" name="likeAlbum">Like album <?= $albumLike ? "true" : "false" ?></button>
            </form>
            <button name="play">Play</button> 
        </div>
    <?php endforeach; ?>

</div>