quore_fun
=========

Installation
------------

Make sure you have composer installed

    curl -sS https://getcomposer.org/installer | php
    mv composer.phar /usr/local/bin/composer

Clone the project and install its dependencies:

    git clone --recursive git@github.com:andrejbranch/quore_fun.git
    cd quore_fun/
    composer install

Create the database config file config/databases.yml that looks like this

    database:
        driver: pdo_mysql
        user: root
        password: ''
        dbname: quore_fun

Replace the user and password if necessary

From the root directory tell doctrine to build the database schema and generate proxies

    php vendor/bin/doctrine orm:schema-tool:create
    php vendor/bin/doctrine orm:generate-proxies

Setup apache server something like this

    <VirtualHost *:80>
        DocumentRoot /var/www/quore_fun/web
        DirectoryIndex index.php
        ServerName dev.quore.com
        <Directory "/var/www/quore_fun/web">
            Options -Indexes FollowSymLinks
            AllowOverride All
            Order allow,deny
            Allow from all

            <IfModule mod_rewrite.c>
                RewriteEngine On
                RewriteRule ^(.*)/$ /$1 [R=301,L]
                RewriteRule ^(.*)/$ /$1 [QSA,L]
                RewriteCond %{REQUEST_FILENAME} !-f
                RewriteRule ^(.*)$ index.php [QSA,L]
            </IfModule>
        </Directory>
    </VirtualHost>
