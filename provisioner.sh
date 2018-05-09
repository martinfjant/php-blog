#!/bin/bash

echo "--- Installing and configuring PHP 7.0 and MySQL ---"

sudo apt-get install python-software-properties -y
sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php -y
sudo apt-get update
sudo apt-get install php7.0 php7.0-fpm php7.0-mysql -y
sudo apt-get --purge autoremove -y
sudo service php7.0-fpm restart

sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo apt-get -y install mysql-server mysql-client
sudo service mysql start

echo "--- What developer codes without errors turned on? Not you, master. ---"

PHP_ERROR_REPORTING=${PHP_ERROR_REPORTING:-"E_ALL"}

sudo sed -ri 's/^display_errors\s*=\s*Off/display_errors = On/g' /etc/php/7.0/fpm/php.ini
sudo sed -ri 's/^display_errors\s*=\s*Off/display_errors = On/g' /etc/php/7.0/cli/php.ini
sudo sed -ri "s/^error_reporting\s*=.*$//g" /etc/php/7.0/fpm/php.ini
sudo sed -ri "s/^error_reporting\s*=.*$//g" /etc/php/7.0/cli/php.ini

echo "error_reporting = $PHP_ERROR_REPORTING" >> /etc/php/7.0/fpm/php.ini
echo "error_reporting = $PHP_ERROR_REPORTING" >> /etc/php/7.0/cli/php.ini

echo "--- Installing and configuring Xdebug ---"
sudo apt-get install -y php-xdebug

sudo cat << EOF | sudo tee -a /etc/php/7.0/mods-available/xdebug.ini
zend_extension=xdebug.so
xdebug.remote_connect_back = 0
xdebug.remote_enable = 1
xdebug.remote_handler = "dbgp"
xdebug.remote_port = 9000
xdebug.remote_host = 192.168.33.1
xdebug.var_display_max_children = 512
xdebug.var_display_max_data = 1024
xdebug.var_display_max_depth = 10
xdebug.remote_log = /var/www/xdebug.log
EOF

if [ ! -f "/etc/php/7.0/fpm/conf.d/20-xdebug.ini" ]; then
    sudo ln -s /etc/php/7.0/mods-available/xdebug.ini /etc/php/7.0/fpm/conf.d/20-xdebug.ini
else
    echo '20-xdebug.ini symlink exists'
fi

sudo service php7.0-fpm restart

echo "--- Installing and configuring Nginx ---"

sudo apt-get install nginx -y
sudo cat > /etc/nginx/sites-available/default <<- EOM
server {
    listen 80 default_server;
    listen [::]:80 default_server ipv6only=on;

    root /vagrant;
    index index.php index.html index.htm;

    server_name server_domain_or_IP;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location ~ \.php\$ {
        try_files \$uri /index.php =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)\$;
        fastcgi_pass unix:/var/run/php/php7.0-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$document_root\$fastcgi_script_name;
        include fastcgi_params;
    }
}
EOM

sed -i 's/sendfile on;/sendfile off;/' /etc/nginx/nginx.conf

sudo service nginx restart