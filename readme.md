## Installation:


#### Tools:
    $ sudo apt-get install apache2
    $ sudo a2enmod rewrite
    $ sudo apt-get install mysql-server
    $ sudo add-apt-repository ppa:ondrej/php
    $ sudo apt-get install php7.0
    $ sudo apt-get install php7.0-curl
    $ sudo apt-get install php7.0-mbstring
    $ sudo apt-get install php7.0-xml
    $ sudo apt-get install php7.0-zip
    $ sudo apt-get install php7.0-mysql
    $ sudo apt-get install composer

##### Database config:
    $ mysql -u root -p (or $ sudo mysql)  
    mysql> CREATE DATABASE feed;  
    mysql> CREATE USER 'feed'@'localhost' IDENTIFIED BY 'your_password'; (set the same password in your .env and/or config/database.php file)    
    mysql> GRANT ALL PRIVILEGES ON feed.* TO 'feed'@'localhost';  
    mysql> FLUSH PRIVILEGES;`  
    mysql> \q

##### Laravel:
    $ git clone https://github.com/kprzybylowski/feed.git
    $ composer install
    $ php artisan migrate (apply all database migrations)
    $ php artisan db:seed (insert data to users_roles)
    $ php artisan storage:link (create a symbolic link from "public/storage" to "storage/app/public")

##### Create initial admin user:
    $ php artisan tinker
    >>> $user = new App\Models\User();  
    >>> $user->createAdminUser('admin@email.co.uk', 'your_password')  
    >>> exit();
    
    This option can be executed only once. If you want to generate the initial admin user again, first you have to rebuild entire database with:  
    $ php artisan migrate:refresh --seed

## Database structure:


#### Tables:
    audits
    companies
    feed
    feed_item
    images
    live_feed
    live_feed_items
    migrations
    password_resets
    users
    users_roles