
# Discography Project

This application is a simple website to manage the database of Musical records from a discography firm.

In this application, you will be able to manage the following:
- View a report of LPs or artists.
- View a list of artists with their respective information.
- View a list of LPs with their respective information.
- You will be able to add, edit, and delete artists. Note: In the case of deleting an artist, their respective LPs, songs and authors will also be deleted.
- You will be able to add, edit, and delete LPs. Note: In the case of deleting an LP, their respective songs and authors will also be deleted.

Each list (reports, artists, and LPs) is displayed using the Bootstrap DataTable.
For the list of artists and LPs, AJAX requests are used to perform add, edit, and delete operations. This approach provides the advantages of filtering and paginating results, and avoids reloading the web page every time an operation (add, edit, or delete).


## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. 

### Prerequisites

- [PHP >= 8.1](http://php.net/)
- [Composer](https://getcomposer.org/)
- [Git](https://git-scm.com/)
- For the database, SQLite3 has been used.

### Install

1. Clone this repo into your directory:

    ````
    git clone https://github.com/maa5/discography.git
    ````

2. Go into your application:
   
   ````    
   cd <your path>
   ````

3. Create the `.env` file by copying from the example provided (`.env.example`)

   ```
   cp .env.example .env
    
   ```

4. Modify the `.env` file with your desired local environment configuration options
5. Create your Encryption Key:

    ```
    php artisan key:generate
    ```
6. Create your database tables (this will run the migrations located in `/discography/database/migrations/`):
    ```
    php artisan migrate
    ```
7. Populate your database tables (this will populate your tables with fake data coming form `/discography/database/seeds`):
    ````
    php artisan db:seed
    ````
8. Run composer:
    ````
    composer install
    ````
9. Run your server:
   ````
   php artisan serve
   ````


## Built With

- [Visual Studio Code](https://code.visualstudio.com/)
- [PHP >= 8.1](http://php.net/)
- [Laravel 10](https://laravel.com/)
- [jQuery DataTables bootstrap4](https://datatables.net/examples/styling/bootstrap4)
- [Laravel DataTables](https://yajrabox.com/docs/laravel-datatables/10.0)
- [Composer](https://getcomposer.org/)
- [Vite](https://es.vitejs.dev/)
