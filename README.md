### Requirements/Požiadavky
- PHP version/verzia >= 7.2
- Composer dependency manager. Installation: https://getcomposer.org/download/

### Installation
- git clone https://github.com/martinfeher/laravel-dashboard-sample-website.git
- cd repository 


1. Copy `.env.example` to `.env`:

    ```shell
    cp .env.example .env
    ```

2. Install the dependencies:

    ```shell 
    composer install
    ```

3. Generate application key:

    ```shell
    php artisan key:generate
    ```

4. Run database migration with seeder:

    ```shell
    php artisan migrate --seed
    ```

5. Start the local server:

    ```shell
    php artisan serve
    ```

### Description
The website contains a client side area where users can login and manage products and orders.
There are 2 types of roles admin and user.

On the /products page the admin and user can create, edit, delete products. The products are displayed in a table. The displayed table parametres are title, description, price columns.
On the /orders page the admin and the user can add, edit, delete orders.
The order's table contains these columns title, description, related product, where a user can assign a product to the order. The users can upload a file in a jpg format.

On the /register page the admin can add a new user with the both roles admin or user. The user is allowed to create only new users.

The admin can see all orders. The user can see only own orders. 
The admin and user can assign multiple products to the orders.
