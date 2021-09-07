### laravel dashboard sample website
- autor: Martin Fehér

Online demo preview:
- url: https://laravel-test-dashboard-website.development.martinfeher.com
- username: admin@demo.com
- password: demodemo

### Požiadavky/Requirements
- PHP version/verzia >= 7.2
- Composer dependency manager. Installation: https://getcomposer.org/download/

### Installation
- mkdir repository
- git clone https://github.com/martinfeher/laravel-dashboard-sample-website.git
- cd repository 
- create .env file (or you can send a message to request a sample .env file)
- composer install // install packages
- php artisan cache:clear; php artisan config:cache;

### Description
The website contains a client side area where users can login and manage products and orders.
There are 2 types of roles admin and user.

On the /products page the admin and user can create, edit, delete products. The products are displayed in a table. The displayed table parametres are title, description, price columns.
On the /orders page the admin and the user can add, edit, delete orders.
The order's table contains these columns title, description, related product, where a user can assign a product to the order. The users can upload a file in a jpg format.

On the /register page the admin can add a new user with the both roles admin or user. The user is allowed to create only new users.

The admin can see all orders. The user can see only own orders. 
The admin and user can assign multiple products to the orders.