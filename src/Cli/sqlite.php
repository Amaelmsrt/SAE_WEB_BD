<?php

define('CREATE_GENRE_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS GENRE (
        idGenre INTEGER PRIMARY KEY AUTOINCREMENT,
        titreGenre VARCHAR(255) NOT NULL
    );
SQL);

define('CREATE_ARTISTE_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS ARTISTE (
        idArtiste INTEGER PRIMARY KEY AUTOINCREMENT,
        nomArtiste VARCHAR(255) NOT NULL,
        imageArtiste mediumblob
    );
SQL);

define('CREATE_ALBUM_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS ALBUM (
        idAlbum INTEGER PRIMARY KEY AUTOINCREMENT,
        titreAlbum VARCHAR(255) NOT NULL,
        descriptionAlbum VARCHAR(255) NOT NULL,
        dateAlbum DATE NOT NULL,
        coverAlbum mediumblob NOT NULL,
        idArtiste INTEGER NOT NULL,
        FOREIGN KEY (idArtiste) REFERENCES ARTISTE(idArtiste)
    );
SQL);

define('CREATE_APPARTENIR_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS APPARTENIR (
        idGenre INTEGER NOT NULL,
        idAlbum INTEGER NOT NULL,
        PRIMARY KEY (idGenre, idAlbum),
        FOREIGN KEY (idGenre) REFERENCES GENRE(idGenre),
        FOREIGN KEY (idAlbum) REFERENCES ALBUM(idAlbum)
    );
SQL);

define('CREATE_SON_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS SON (
        idSon INTEGER PRIMARY KEY AUTOINCREMENT,
        titreSon VARCHAR(255) NOT NULL,
        dureeSon TIME NOT NULL,
        fichierMp3 mediumblob,
        nbStream INTEGER DEFAULT 0,
        idAlbum INTEGER NOT NULL,
        FOREIGN KEY (idAlbum) REFERENCES ALBUM(idAlbum)
    );
SQL);

define('CREATE_SORTIR_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS SORTIR (
        idArtiste INTEGER NOT NULL,
        idAlbum INTEGER NOT NULL,
        PRIMARY KEY (idArtiste, idAlbum),
        FOREIGN KEY (idArtiste) REFERENCES ARTISTE(idArtiste),
        FOREIGN KEY (idAlbum) REFERENCES ALBUM(idAlbum)
    );
SQL);

define('CREATE_UTILISATEUR_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS UTILISATEUR (
        idUtilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
        nomUtil VARCHAR(255) NOT NULL,
        prenomUtil VARCHAR(255) NOT NULL,
        pseudoUtil VARCHAR(255) NOT NULL,
        emailUtil VARCHAR(255) NOT NULL,
        mdpUtil VARCHAR(255) NOT NULL,
        statutUser VARCHAR(255) NOT NULL DEFAULT 'User'
    );
SQL);

define('CREATE_LIKERARTISTE_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS LIKERARTISTE (
        idUtilisateur INTEGER NOT NULL,
        idArtiste INTEGER NOT NULL,
        PRIMARY KEY (idUtilisateur, idArtiste),
        FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
        FOREIGN KEY (idArtiste) REFERENCES ARTISTE(idArtiste)
    );
SQL);

define('CREATE_LIKERALBUM_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS LIKERALBUM (
        idUtilisateur INTEGER NOT NULL,
        idAlbum INTEGER NOT NULL,
        PRIMARY KEY (idUtilisateur, idAlbum),
        FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
        FOREIGN KEY (idAlbum) REFERENCES ALBUM(idAlbum)
    );
SQL);

define('CREATE_LIKERSON_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS LIKERSON (
        idUtilisateur INTEGER NOT NULL,
        idSon INTEGER NOT NULL,
        PRIMARY KEY (idUtilisateur, idSon),
        FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
        FOREIGN KEY (idSon) REFERENCES SON(idSon)
    );
SQL);

define('CREATE_PLAYLIST_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS PLAYLIST (
        idPlaylist INTEGER PRIMARY KEY AUTOINCREMENT,
        nomPlaylist VARCHAR(255) NOT NULL,
        idUtilisateur INTEGER NOT NULL,
        FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur)
    );
SQL);

define('CREATE_CONSTITUER_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS CONSTITUER (
        idPlaylist INTEGER NOT NULL,
        idSon INTEGER NOT NULL,
        PRIMARY KEY (idPlaylist, idSon),
        FOREIGN KEY (idPlaylist) REFERENCES PLAYLIST(idPlaylist),
        FOREIGN KEY (idSon) REFERENCES SON(idSon)
    );
SQL);

define('CREATE_ECOUTERRECEMENT_TABLE', <<<SQL
    CREATE TABLE IF NOT EXISTS ECOUTERRECEMENT (
        idUtilisateur INTEGER NOT NULL,
        idSon INTEGER NOT NULL,
        dataHH DATETIME NOT NULL,
        PRIMARY KEY (idUtilisateur, idSon, dataHH),
        FOREIGN KEY (idUtilisateur) REFERENCES UTILISATEUR(idUtilisateur),
        FOREIGN KEY (idSon) REFERENCES SON(idSon)
    );
SQL);


define('CREATE_ARTISTE_FTS', <<<SQL
    CREATE VIRTUAL TABLE IF NOT EXISTS artist_fts USING fts5(
        idArtiste,
        nomArtiste,
        content='ARTISTE',
        tokenize = 'unicode61 remove_diacritics 1'
    );
SQL);

define('CREATE_ALBUM_FTS', <<<SQL
    CREATE VIRTUAL TABLE IF NOT EXISTS album_fts USING fts5(
        idAlbum,
        titreAlbum,
        content='ALBUM',
        tokenize = 'unicode61 remove_diacritics 1'
    );
SQL);

define('CREATE_SON_FTS', <<<SQL
    CREATE VIRTUAL TABLE IF NOT EXISTS son_fts USING fts5(
        idSon,
        titreSon,
        content='SON',
        tokenize = 'unicode61 remove_diacritics 1'
    );
SQL);

$pdo = new PDO('sqlite:' . SQLITE_DB);

switch ($argv[2]) {
    case 'db':
        echo 'Création de la base de données' . PHP_EOL;
        shell_exec('sqlite3 ' . SQLITE_DB);
        break;

    case 'c':
        echo 'Création des tables' . PHP_EOL;
        $pdo->exec(CREATE_GENRE_TABLE);
        $pdo->exec(CREATE_ARTISTE_TABLE);
        $pdo->exec(CREATE_ALBUM_TABLE);
        $pdo->exec(CREATE_APPARTENIR_TABLE);
        $pdo->exec(CREATE_SON_TABLE);
        $pdo->exec(CREATE_SORTIR_TABLE);
        $pdo->exec(CREATE_UTILISATEUR_TABLE);
        $pdo->exec(CREATE_LIKERARTISTE_TABLE);
        $pdo->exec(CREATE_LIKERALBUM_TABLE);
        $pdo->exec(CREATE_LIKERSON_TABLE);
        $pdo->exec(CREATE_PLAYLIST_TABLE);
        $pdo->exec(CREATE_CONSTITUER_TABLE);
        $pdo->exec(CREATE_ECOUTERRECEMENT_TABLE);
        $pdo->exec(CREATE_ALBUM_FTS);
        $pdo->exec(CREATE_ARTISTE_FTS);
        $pdo->exec(CREATE_SON_FTS);
        break;

    case 'd':
        echo 'Suppression des tables' . PHP_EOL;
        $pdo->exec('
            DROP TABLE IF EXISTS artist_fts;
            DROP TABLE IF EXISTS album_fts;
            DROP TABLE IF EXISTS son_fts;
            DROP TABLE IF EXISTS ECOUTERRECEMENT;
            DROP TABLE IF EXISTS CONSTITUER;
            DROP TABLE IF EXISTS PLAYLIST;
            DROP TABLE IF EXISTS LIKERSON;
            DROP TABLE IF EXISTS LIKERALBUM;
            DROP TABLE IF EXISTS LIKERARTISTE;
            DROP TABLE IF EXISTS UTILISATEUR;
            DROP TABLE IF EXISTS SORTIR;
            DROP TABLE IF EXISTS SON;
            DROP TABLE IF EXISTS APPARTENIR;
            DROP TABLE IF EXISTS ALBUM;
            DROP TABLE IF EXISTS ARTISTE;
            DROP TABLE IF EXISTS GENRE;
        ');
        break;

    case 'i':
        echo 'Insertion des données' . PHP_EOL;
        require_once __DIR__ . '/../Configuration/Spyc.php';

        // Insertion des genres
        $file = file_get_contents(__DIR__ . '/../Data/genre.yml');
        $genres = Spyc::YAMLLoad($file);
        foreach ($genres as $genre) {
            $stmt = $pdo->prepare('INSERT INTO GENRE (idGenre, titreGenre) VALUES (:idGenre, :titreGenre)');
            $stmt->execute([
                ':idGenre' => $genre['id'],
                ':titreGenre' => $genre['titre']
            ]);
        }

        // Insertion des artistes
        $file = file_get_contents(__DIR__ . '/../Data/artiste.yml');
        $artistes = Spyc::YAMLLoad($file);
        foreach ($artistes as $artiste) {
            $stmt = $pdo->prepare('INSERT INTO ARTISTE (idArtiste, nomArtiste, imageArtiste) VALUES (:idArtiste, :nomArtiste, :imageArtiste)');
            $img = file_get_contents(__DIR__ . '/../Data/ArtisteImg/' . $artiste['img']);
            $stmt->execute([
                ':idArtiste' => $artiste['idArtiste'],
                ':nomArtiste' => $artiste['nom'],
                ':imageArtiste' => $img
            ]);
        }

        // Insertion des albums
        $file = file_get_contents(__DIR__ . '/../Data/album.yml');
        $albums = Spyc::YAMLLoad($file);

        foreach ($albums as $album) {
            $stmt = $pdo->prepare('INSERT INTO ALBUM (idAlbum, titreAlbum, descriptionAlbum, dateAlbum, coverAlbum, idArtiste) VALUES (:idAlbum, :titreAlbum, :descriptionAlbum, :dateAlbum, :coverAlbum, :idArtiste)');
            $img = file_get_contents(__DIR__ . '/../Data/AlbumImg/' . $album['img']);
            $stmt->execute([
                ':idAlbum' => $album['entryId'],
                ':titreAlbum' => $album['title'],
                ':descriptionAlbum' => $album['description'],
                ':dateAlbum' => $album['releaseYear'],
                ':coverAlbum' => $img,
                ':idArtiste' => $album['by']
            ]);
            foreach ($album['genre'] as $genre) {
                $stmt = $pdo->prepare('INSERT INTO APPARTENIR (idGenre, idAlbum) VALUES (:idGenre, :idAlbum)');
                $stmt->execute([
                    ':idGenre' => $genre,
                    ':idAlbum' => $album['entryId']
                ]);
            }
            foreach ($album['songs'] as $song) {
                $stmt = $pdo->prepare('INSERT INTO SON (titreSon, dureeSon, fichierMp3, idAlbum) VALUES (:titreSon, :dureeSon, :fichierMp3, :idAlbum)');
                $mp3 = file_get_contents(__DIR__ . '/../Data/Son/' . $album['title'] . "/" . $song['mp3']);
                $stmt->execute([
                    ':titreSon' => $song['title'],
                    ':dureeSon' => $song['duration'],
                    ':fichierMp3' => $mp3,
                    ':idAlbum' => $album['entryId']
                ]);
            }
        }

        // Insert dans fts
        $stmt = $pdo->prepare('INSERT INTO artist_fts (idArtiste, nomArtiste) VALUES (:idArtiste, :nomArtiste)');
        foreach ($artistes as $artiste) {
            $stmt->execute([
                ':idArtiste' => $artiste['idArtiste'],
                ':nomArtiste' => $artiste['nom']
            ]);
        }

        $stmt = $pdo->prepare('INSERT INTO album_fts (idAlbum, titreAlbum) VALUES (:idAlbum, :nomAlbum)');

        foreach ($albums as $album) {
            $stmt->execute([
                ':idAlbum' => $album['entryId'],
                ':nomAlbum' => $album['title']
            ]);
        }

        $stmt = $pdo->prepare('INSERT INTO son_fts (idSon, titreSon) VALUES (:idSon, :nomSon)');
        foreach ($albums as $album) {
            foreach ($album['songs'] as $song) {
                $stmt->execute([
                    ':idSon' => $song['entryId'],
                    ':nomSon' => $song['title']
                ]);
            }
        }
        break;

    case 'u':
        $stmt = $pdo->prepare("INSERT INTO UTILISATEUR (nomUtil, prenomUtil, pseudoUtil, emailUtil, mdpUtil, statutUser) VALUES (:nomUtil, :prenomUtil, :pseudoUtil, :emailUtil, :mdpUtil, 'User')");
        $stmt->execute([
            ':nomUtil' => 'Chédeville',
            ':prenomUtil' => 'Baptiste',
            ':pseudoUtil' => 'Baptched',
            ':emailUtil' => 'baptched@gmail.com',
            ':mdpUtil' => password_hash('b', PASSWORD_DEFAULT)
        ]);
        break;

    default:
        echo 'Aucune action définie' . PHP_EOL;
        break;
}
