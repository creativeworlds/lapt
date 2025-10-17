# Production on Site :-

1. Create build folder command `bun run build`
2. Create a database in production server
3. Create zip <PROJECT_FOLDER>.zip.
4. Create folder <PROJECT_NAME> on production server and inside extract <PROJECT_FOLDER>.zip
5. Installtion project on production server Run Command :-
    - Clone & Install Dependencies
    ```bash
    composer require
    ```

    - Environment Setup
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    update .env with your database credentials:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=rsfgqdfp_laravel.lapt
    DB_USERNAME=rsfgqdfp_pramod
    DB_PASSWORD=06@Sep1997
    ```

    - Run Migrations & Seeders
    ```bash
    php artisan migrate --seed
    ```

    - copy <PUBLIC_FOLDER> into <ROOT_FOLDER> all files and folders.


    - create app storage sort link inside root folder
    ```bash 
    ln -s <PROJECT_FOLDER>/storage/app/public storage
    ```