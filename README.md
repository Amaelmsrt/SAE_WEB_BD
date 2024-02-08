# SAE_WEB_BD

## Configuration de la base de données 

Se mettrre à la racine du projet :

Création de la base de données :

``` bash
php src/cli.php sqlite db
```

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