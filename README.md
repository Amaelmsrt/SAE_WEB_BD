# SAE_WEB_BD

## Demo

### Inscription / Connection

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/6b99e6d2-1685-4e91-8a51-d196d3c4e68c

### Accueil

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/84448f2f-a5f2-4d58-8478-20131bc5eb6b

### Content-player

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/3cda3269-9b09-4c88-9379-621eaa8b3730

### Recherche

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/7d8643c3-d64d-4d28-9550-94e0b05c2442

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/84629dd2-ca60-40ca-a9b6-a2cded0bb57f

### Playlist

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/d540bdc6-90f1-4110-8950-bff0a86e217b

### Responsive

#### Ecrans moyens 

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/0fcc1f4a-7c9a-48bd-9b9a-620dce5d34fe

#### Mobile

https://github.com/Amaelmsrt/SAE_WEB_BD/assets/96087993/dcaf1f83-691c-49e7-bae1-2cfb600610cb

## GitHub

- [Lien du projet](https://github.com/Amaelmsrt/SAE_WEB_BD.git)

## Membre du groupe

- Chédeville Baptiste
- Gratade Sébastien
- Maserati Amael

## Professeur référent

- M. Dalaigre


## Lancement du serveur

Se mettre sur dans le fichier src :

``` bash
php -S localhost:8000
```

Si la base de données n'est pas configurée, voir la partie Configuration de la base de données.

## Configuration de la base de données 

Se mettrre à la racine du projet :=

Ajouter les tables :

``` bash
php src/cli.php sqlite c
```

Ajouter les données :

``` bash
php src/cli.php sqlite i
```

Supprimer les tables :

``` bash
php src/cli.php sqlite d
```

## Fonctionnalités

- Inscription / Login Utilisateur
- Playlist par utilisateur
- Favorie des musiques
- Possibilité de jouer une musique
- Possibilité de jouer un album
- Possibilité de jouer un artiste
- Possibilité d'ajouter une musique à une playlist
- Possibilité de supprimer une musique d'une playlist
- Possibilité d'ajouter une musique en liste d'attente
- Possibilité de mettre en pause une musique/ prochaine musique/ musique précédente
- Affichage des albums
- Détail des albums
- Détail d’un artiste avec ses albums
- Recherche avancée dans les albums/artistes/musiques
- Affichage des artistes

Partie admin :

- CRUD pour un album
- CRUD pour un artiste
- CRUD pour une musique
- CRUD pour un utilisateur
- CRUD pour une playlist


## Documentation

Les diagrammes UML sont dans le dossier "data" à la racine du projet.


Diagremme de classe :

![Diagremme de classe](data/diagrammeClasses.png)


MCD :

![MCD](data/mcd.png)


Diagramme d'activité :

![Diagramme d'activité](data/diagrammeActivite.png)


Diagramme de séquence :

![Diagramme de séquence](data/diagramme%20Sequence.png)
