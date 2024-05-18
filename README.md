# Contact List Application Setup

This repository contains a contact list application. Follow the instructions below to set up and run the application.

## Prerequisites

- [PHP 8.1](https://www.php.net/downloads)
- [Composer](https://getcomposer.org/download/)

## Installation

1. Clone the repository:

   ```shell
   git clone https://github.com/hosseini-pouria/beautycode.ir.git

2. Navigate to the project directory:

    ```shell
   cd repository

3. Install the dependencies using Composer:

    ```shell
   composer install

4. This command will start the necessary Docker containers defined in the docker-compose.yml file using Laravel Sail:

    ```shell
   ./vendor/bin/sail up -d

5. Create a copy of the .env.example file and rename it to .env:

    ```shell
   cp .env.example .env

6. Configure the database connection in the .env file:

    ```shell
   php artisan migrate

7. Generate an application key:

    ```shell
   php artisan key:generate

8. Start the development server:

    ```shell
   php artisan serve

9. Install a run nmp

    ```shell
   npm install && npm run dev 
 
10. Access the application:
     - Open your browser and test your app:
    
    ```shell
    http://127.0.0.1:8000/register
    http://127.0.0.1:8000/login
    http://127.0.0.1:8000/contacts
    http://127.0.0.1:8000/contacts/create
    http://127.0.0.1:8000/contacts/61/edit
    
