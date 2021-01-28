# Chemistry web app
Install symfony:

- mysql 
- php >=7.2.5
- symfony
- composer

1. Download project
2. Go to chemistry_webapp directory:
3. Run command:
``` 
composer install 
```
4. Open file: .env and change configuration for database:
```
DATABASE_URL="mysql://user_name:password@address_ip:port/database_name"
```
5. Create database
``` 
Create databse:
php bin/console doctrine:database:create
Crate table:
php bin/console doctrine:migrations:migrate
```

5. Run project
```
symfony server:start
```
