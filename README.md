SolarPannelsSimulator
===
Simulateur en ligne d'installation de panneaux photovoltaïques.

## Technologies

|Framework|Moteur de vues|Langage back|Bibliothèque de front|
|---|---|---|---|
|Symfony 6| Twig 3.1.2| PHP 8.2|Bootstrap 5

### Docker
Docker pour conteneuriser l'application lors du développement.

## Installation

1. Installer Docker
2. Créer un répertoire vide nommé "solar"
4. Instancier un container php, mysql, nginx et PHPMyAdmin :
   - Créer un répertoire php (y mettre le Dockerfile)
   - Remonter dans le répertoire initial et y mettre Docker-compose.yml
   - Créer un répertoire nginx et y mettre default.conf
   - Remonter dans le répertoire initial. Dans une console, se placer dans celui-ci et entrer : ``docker compose up -d``
5. S'assurer que le container tourne
6. Créer un répertoire app et se placer dedans
8. ``Git clone lien_du_repo`` ou télécharger le dépôt à l'intérieur
9. Entrer localhost dans un navigateur pour accéder à l'application
