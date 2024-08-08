## About Task Management System

### Project Description
This is a api resource built with Laravel

### How to Install
1. Clone the project
2. Go to the project root directory and run `composer install` and `npm install`
3. Create `.env` file and copy content from `.env.example`
4. Run `php artisan key:generate` from terminal
5. Change database information in `.env`
6. Run migrations by executing `php artisan migrate` , Then Run  `php artisan db:seed` to use faker settings in database,
7. Start the project by running `php artisan serve`
8. Run test by running `php artisan test`

### Demo Account
- all task: localhost/api/tasks
- task by status : localhost/api/tasks?status=pending
- task by id : localhost/api/tasks/1
- create task : localhost/api/tasks
- update task : localhost/api/tasks/1
- delete task : localhost/api/tasks/1
-