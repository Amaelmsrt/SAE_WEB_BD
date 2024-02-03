<?php

declare(strict_types=1);

namespace DB;

use Model\Genre;

class GenreDB {
    private \PDO $pdo;

    public function __construct(\PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function findAll(): array {
        $sql = "SELECT * FROM genre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $genres = $stmt->fetchAll();
        $genresArray = [];
        foreach ($genres as $genre) {
            $genresArray[] = new Genre($genre['idGenre'], $genre['titreGenre']);
        }
        return $genresArray;
    }

    public function find(int $idGenre): Genre {
        $sql = "SELECT * FROM genre WHERE idGenre = :idGenre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':idGenre', $idGenre, \PDO::PARAM_INT);
        $stmt->execute();
        $genre = $stmt->fetch();
        return new Genre($genre['idGenre'], $genre['titreGenre']);
    }

    public function insert(Genre $genre): void {
        $sql = "INSERT INTO genre (idGenre, titreGenre) VALUES (:idGenre, :titreGenre)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idGenre' => $genre->getId(),
            ':titreGenre' => $genre->getTitre()
        ]);
    }

    public function update(Genre $genre): void {
        $sql = "UPDATE genre SET titreGenre = :titreGenre WHERE idGenre = :idGenre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idGenre' => $genre->getId(),
            ':titreGenre' => $genre->getTitre()
        ]);
    }

    public function delete(int $idGenre): void {
        $sql = "DELETE FROM genre WHERE idGenre = :idGenre";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':idGenre' => $idGenre
        ]);
    }
}