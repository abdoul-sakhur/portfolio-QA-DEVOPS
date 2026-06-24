Instructions pour déployer avec Docker sur VPS

- Construire et démarrer les conteneurs :

```bash
cd portfolio-QA-DEVOPS
docker compose up -d --build
```

- Ce setup utilise uniquement des ports dans l'intervalle 4000-5000 :
  - Accès web Laravel : `4000`
  - MySQL depuis l'hôte : `4001`

- Le fichier d'environnement Docker est `.env.docker`. Par défaut il contient :

```
APP_URL=http://187.127.232.219:4000
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=portfolio
DB_PASSWORD=secret
```

- Si vous avez une base de données existante à préserver :

1) Exportez la base actuelle :

```bash
mysqldump -u root -p your_database_name > dump.sql
```

2) Copiez le dump vers le conteneur MySQL et importez-le :

```bash
docker cp dump.sql portfolio-qa-db:/dump.sql
docker exec -i portfolio-qa-db sh -c 'mysql -u root -prootpassword portfolio < /dump.sql'
```

- Pour exécuter les migrations ou commandes artisan (après import si besoin) :

```bash
docker exec -it portfolio-qa-app php artisan migrate --force
docker exec -it portfolio-qa-app php artisan config:cache
```

Remarques :
- Ne faites pas `migrate:fresh` si vous souhaitez conserver les données existantes.
- Modifiez `.env.docker` pour définir un mot de passe MySQL plus sûr avant passage en production.
- Vous pouvez démarrer uniquement `app` et `db` avec `docker compose up -d --build`.
