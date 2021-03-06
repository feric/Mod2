<VirtualHost *:80>
    DocumentRoot /var/www/drupal
    ServerName www.loserics.com
    ServerAlias loserics.com
        <Directory /var/www/drupal>
                Options -Indexes FollowSymLinks MultiViews
                ErrorDocument 404 /facebook.jpg
                ErrorDocument 403 /flash_gordo.jpg
		AllowOverride None
                Order allow,deny
                allow from all
        </Directory>
</VirtualHost>
