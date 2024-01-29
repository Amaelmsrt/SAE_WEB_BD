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
    
    <?php if ($isLiked) : ?>
        <button class="liked btn-like" type="submit" id="likeArtiste" data-id-artiste="<?= $artist->getId() ?>" data-id="<?= $_SESSION['user'] ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="27" viewBox="0 0 23 27" fill="none">
            <g clip-path="url(#clip0_73_1533)">
                <path d="M13.5 22.5001C13.5 22.5001 6.43499 17.9101 4.49999 13.5001C1.91249 7.60508 10.125 2.25008 13.5 8.57258C16.875 2.25008 25.0875 7.60508 22.5 13.5001C20.565 17.8988 13.5 22.5001 13.5 22.5001Z" stroke="white" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
                <clipPath id="clip0_73_1533">
                <rect width="27" height="27" fill="white"/>
                </clipPath>
            </defs>
        </svg>
    </button>
    <?php else : ?>
        <button class="btn-like" type="submit" id="likeArtiste" data-id-artiste="<?= $artist->getId() ?>" data-id="<?= $_SESSION['user'] ?>">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="27" viewBox="0 0 23 27" fill="none">
            <g clip-path="url(#clip0_73_1533)">
                <path d="M13.5 22.5001C13.5 22.5001 6.43499 17.9101 4.49999 13.5001C1.91249 7.60508 10.125 2.25008 13.5 8.57258C16.875 2.25008 25.0875 7.60508 22.5 13.5001C20.565 17.8988 13.5 22.5001 13.5 22.5001Z" stroke="white" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round"/>
            </g>
            <defs>
                <clipPath id="clip0_73_1533">
                <rect width="27" height="27" fill="white"/>
                </clipPath>
        </defs>
</svg>
    </button>
    <?php endif; ?>


    
    <p><?= $nbSonLike ?> titres likés</p>
</div>

<div>



</div>

<div>

    <h2>Top titres</h2>

    <?php foreach ($topSon as $son) : 
        $album = $manager->getAlbumDB()->findAlbum($son->getIdAlbum());
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
            <?php if ($albumLike) : ?>
                <button class="liked btn-like" type="submit" id="likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION['user'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="27" viewBox="0 0 23 27" fill="none">
                        <g clip-path="url(#clip0_73_1533)">
                            <path d="M13.5 22.5001C13.5 22.5001 6.43499 17.9101 4.49999 13.5001C1.91249 7.60508 10.125 2.25008 13.5 8.57258C16.875 2.25008 25.0875 7.60508 22.5 13.5001C20.565 17.8988 13.5 22.5001 13.5 22.5001Z" stroke="white" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_73_1533">
                            <rect width="27" height="27" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            <?php else : ?>
                <button class="btn-like" type="submit" id="likeAlbum" data-id-album="<?= $album->getId() ?>" data-id="<?= $_SESSION['user'] ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="23" height="27" viewBox="0 0 23 27" fill="none">
                        <g clip-path="url(#clip0_73_1533)">
                            <path d="M13.5 22.5001C13.5 22.5001 6.43499 17.9101 4.49999 13.5001C1.91249 7.60508 10.125 2.25008 13.5 8.57258C16.875 2.25008 25.0875 7.60508 22.5 13.5001C20.565 17.8988 13.5 22.5001 13.5 22.5001Z" stroke="white" stroke-width="1.63636" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                            <clipPath id="clip0_73_1533">
                            <rect width="27" height="27" fill="white"/>
                            </clipPath>
                        </defs>
                    </svg>
                </button>
            <?php endif; ?>
            <button name="play">Play</button> 
        </div>
    <?php endforeach; ?>

</div>