#!/bin/sh
apt-get update -y && apt-get upgrade -y && \
apt-get install software-properties-common -y && \
sudo add-apt-repository ppa:ondrej/php -y && \
apt-get update && \
apt-get install git tig mc htop git-flow vim links unzip bash-completion curl ant -y && \
echo mysql-server mysql-server/root_password password 'secret' | debconf-set-selections && \
echo mysql-server mysql-server/root_password_again password 'secret' | debconf-set-selections && \
apt-get -y install mysql-server && \
mysqladmin -u root -p'secret' password '' && \
apt-get install php-fpm php-cli php-curl php-intl php-imagick php-memcached php-pear php-xdebug php-dev php-mysql -y && \
apt-get install nginx -y && \
apt-get install memcached -y && \
wget https://raw.githubusercontent.com/nixilla/php-dev-stack/master/config/nginx/default.conf -O /etc/nginx/sites-available/default > /dev/null 2>&1 && \
sed -i "s/user[ \t]*www-data;/user vagrant;/" /etc/nginx/nginx.conf && \
sed -i "s^user = www-data^user = vagrant^" /etc/php/7.0/fpm/pool.d/www.conf && \
sed -i "s^group = www-data^group = vagrant^" /etc/php/7.0/fpm/pool.d/www.conf && \
sed -i "s^listen = /run/php/php7.0-fpm.sock^listen = 127.0.0.1:9000^" /etc/php/7.0/fpm/pool.d/www.conf && \
sed -i "s^;date.timezone =^date.timezone = Europe/London^" /etc/php/7.0/fpm/php.ini && \
sed -i "s^;date.timezone =^date.timezone = Europe/London^" /etc/php/7.0/cli/php.ini && \
service nginx restart && service php7.0-fpm restart && \
chown vagrant:vagrant /home/vagrant/.ssh/id_rsa && \
chmod 600 /home/vagrant/.ssh/id_rsa && \
chown vagrant:vagrant /home/vagrant/.gitconfig && \
sed -i "s^#force_color_prompt=yes^force_color_prompt=yes^" /home/vagrant/.bashrc

wget https://raw.githubusercontent.com/git/git/master/contrib/completion/git-completion.bash -O /etc/bash_completion.d/git-completion.bash
wget https://raw.githubusercontent.com/KnpLabs/symfony2-autocomplete/master/symfony2-autocomplete.bash -O /etc/bash_completion.d/symfony2-completion.bash
