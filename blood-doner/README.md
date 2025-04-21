1. php artisan install:api
2. database table name setup on .env
3. adding phone number to database
4. now -- php artisan migrate


User login, registration and logout

1. adding phone number in user fillable
2. Creating controller for authentication -- php artisan make:controller AuthController
3. Always read what code giving what response. Take a mental note of that
4. Added role to user - php artisan make:migration add_role_column_to_users_table --table=users


Blood Donation Post

1. Create post model, migration, controller - php artisan make:model BloodDonation -mc
2. Create migration filling all data with user as foreign id.
3. In blood donation model all the data make fillable
4. Connect one to many ( One user to many blooddonation) model.
5. migrate the blood donation table - php artisan migrate
6. write data store logic in Blood donation Controller
7. Write the route in api.php

Manage Personal Info

1. Create User Controller - php artisan make:Controller UserController
2. Creating Sanctum route for user view personal Information, and change