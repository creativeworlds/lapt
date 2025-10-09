# LAPT Application

Today, I production on site :-
1. create build folder command `bun run build`
2. create a database in production server
3. create zip <PROJECT_FOLDER>.zip.
4. create folder <PROJECT_NAME> and inside extract <PROJECT_FOLDER>.zip
5. Installtion Project on Production Server Run Command:
1. **Clone & Install Dependencies**
```bash
composer require
```

2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

update .env with your database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=diagnorx
DB_USERNAME=root
DB_PASSWORD=
```

3. **Run Migrations & Seeders**
```bash
php artisan migrate --seed
```

6. copy <PUBLIC_FOLDER> <ROOT_FOLDER> all files and folders.