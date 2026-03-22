Instructions pour déployer avec Docker

- Construire et démarrer les conteneurs :

```bash
docker-compose up -d --build
```

- Mettre à jour `.env` pour utiliser les identifiants MySQL du `docker-compose.yml` :

```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=portfolio
DB_USERNAME=portfolio
DB_PASSWORD=secret
```

- Si vous avez une base de données existante à préserver :

1) Exportez la base actuelle (sur votre machine source) :

```bash
mysqldump -u root -p your_database_name > dump.sql
```

2) Copiez le dump vers le conteneur MySQL et importez-le :

```bash
docker cp dump.sql portfolio-db:/dump.sql
docker exec -i portfolio-db sh -c 'mysql -u root -prootpassword portfolio < /dump.sql'
```

- Accéder à phpMyAdmin : http://localhost:8080 (user `root`, password `rootpassword`)

- Pour exécuter les migrations ou commandes artisan (après import si besoin) :

```bash
docker exec -it portfolio-app php artisan migrate --force
docker exec -it portfolio-app php artisan config:cache
```

Remarques :
- N'utilisez `migrate:fresh` si vous voulez garder les données existantes.
- Changez les mots de passe dans `docker-compose.yml` avant production.
