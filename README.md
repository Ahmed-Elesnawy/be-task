
# User Task Statistics Task

an application where the admin can create a task and assign it to any non-admin user.

## Prerequisites

- PHP 8.2
- Composer 2
- MySQL
- Redis (optional - you can use database instead) 


## Installation

 1- Clone project files git clone git@github.com:Ahmed-Elesnawy/be-task.git
 
 2- Install dependencies using composer ( composer install )
 
 3- Copy .env.example to .env and add your CACHE_DRIVER and QUEUE_CONNECTION (you can use redis or database)

 4- Run "php artisan key:generate" to create application key.

 5- Run "php artisan optimize:clear".

 6- Create database using command "php artisan db:generate".

 7- "Run php artisan migrate".

 8- Run application seeders using command "php artisan db:seed".

 9- Run "php artisan serve".
 
 10- Run "php artisan queue:work" to consume messages and update user statistices .
 
 11- Run "php artisan test" to run tests 


## The development approach

- I split the task to two branches (main,minimal-stracture)
- main branch that have default laravel stracture without any type of overengineering
- minimal-stracture branch that have repository pattern to deal with access layer and service layer to encapsulate the bussines logic

