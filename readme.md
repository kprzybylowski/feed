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
    mysql> CREATE USER 'feed'@'localhost' IDENTIFIED BY 'your_pass'; *(set the same password in your .env file)*  
    mysql> GRANT ALL PRIVILEGES ON feed.* TO 'feed'@'localhost';  
    mysql> FLUSH PRIVILEGES;`  
    mysql> \q

##### Laravel:
    $ composer create-project laravel/laravel feed 5.5.*
    $ php artisan migrate

#####Create initial admin user
    $ php artisan tinker
    >>> $user = new App\Models\User();
    >>> $user->createAdminUser('feedadmin@uniled.co.uk', 'your_password')
    >>> exit();

## Database structure:


#### Tables:
    Companies
    Feed
    Feed_item