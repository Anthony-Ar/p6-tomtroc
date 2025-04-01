# Tomtroc

Site de partage et d'échange de livres

## Setup du projet en local

- Commencer par clôner le projet sur votre machine

### En utilisant Docker

- Utiliser les commandes suivantes :
```bash
  docker compose build
  docker-compose up
```

- Se rendre à l'adresse localhost:8000 et se connecter à PhpMyAdmin (utilisateur: user, mot de passe: test)

- Importer le fichier "p6-tomtroc.sql"

**Vous pouvez maintenant accéder à l'application depuis localhost:8001 !**

Pour les prochains lancement, il suffira de taper :
```bash
  docker-compose up
```
Ou, si MakeFile est disponible sur votre machine :
```bash
  make build
```

### Sans utiliser Docker

Pré-requis : PHP >= 8.4 ainsi qu'une base de données MySQL

- Créer une base de données "p6-tomtroc" et y importer le fichier "p6-tomtroc.sql"

- Utiliser la commande :
```bash
  php -S localhost:8000 -t public/
```
Ou, si NPM est disponible sur votre machine :
```bash
  npm run server
```

**Vous pouvez maintenant accéder à l'application depuis localhost:8000**