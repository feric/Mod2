<VirtualHost *:80>
    DocumentRoot /var/www/drupal
    ServerName www.losisaacs.com
    ServerAlias losisaacs.com
        <Directory /var/www/drupal>
                Options -Indexes FollowSymLinks MultiViews
                AllowOverride None
		ErrorDocument 404 /facebook.jpg
                ErrorDocument 403 /flash_gordo.jpg
                Order allow,deny
                allow from all
        </Directory>
</VirtualHost>
