<h1 align="center">SIMS - With Laravel 10 And SBADMIN2</h1>

## Installation
1. Clone this project
    ```bash
    git clone https://github.com/baihaki123/demo_sims
    cd demo_sims
    ```
2. Install dependencies
    ```bash
    composer install
    ```

3. Set up Laravel configurations
    ```bash
    copy .env.example .env
    php artisan key:generate
    ```

4. Set your database in .env

5. Migrate database
    ```bash
    php artisan migrate
    ```
6. Seeding database
     ```bash
    php artisan db:seed --class=UserSeeder
    &&
    php artisan db:seed --class=CategorySeeder
    ```

6. Serve the application
    ```bash
    php artisan serve
    ```

7. Login credentials

**Email:** baihakiaski@gmail.com

**Password:** password
## Contributing
Feel free to contribute and make a pull request.
