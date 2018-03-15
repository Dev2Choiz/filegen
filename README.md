# Filegen - Lecture de fichier par generateur

Filegen permet de lire un fichier par petits bouts.
Cela évite d'avoir à tout charger en mémoire,
limitant ainsi les risques de dépassement.


## Graphique
![alt text](https://raw.githubusercontent.com/Dev2Choiz/filegen/master/graph.png)


## Installation

Installer la dernière version via [Composer] en passant par le fichier composer.json

- Ajouter le repository [https://github.com/dev2choiz/filegen] et la dépendance [dev2choiz/filegen].
```composer.json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/dev2choiz/filegen"
        }
    ],
    "require": {
       "dev2choiz/filegen": "*"
    }
}
```
- Puis en ligne de commande, au niveau du fichier composer.json
```bash
$ composer update dev2choiz/filegen
```

## Usage Basique
- Ligne par ligne
```php
<?php

use FleGen\FileGen;

// ouverture du fichier
$file = \FileGen\FileGen::factory('path/to/your/file.ext');

// lecture du fichier ligne par ligne
$LineGenerator = $file->readLinePerLine();

// parcours du generateur qui fournit une ligne à chaque itération
foreach ($LineGenerator as $numLine => $line) {
    var_dump($numLine, $line);
}
```
- Par bloque
```php
<?php

use FleGen\FileGen;

// ouverture du fichier
$file = \FileGen\FileGen::factory('path/to/your/file.ext');

// lecture du fichier par tranche de 100 caractere
$LineGenerator = $file->readFile(100);

// parcours du generateur
foreach ($LineGenerator as $num => $line) {
    var_dump($num, $line);
}
```
