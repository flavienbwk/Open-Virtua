#!/bin/bash
# The procedure is to execute on a Debian 9 server.

# Here are the steps :
## 1. Guided installation for the database.
## 2. Your machine will instance two VMs.
## 3. The first one will be configured for PXE.
## 4. The second one will be configured for NFS.

# Installing the web server.
mysql_skip="n"
mysql_username=""
mysql_password=""
error=false
the_command=""

echo -e "OpenVirtua installation program.\n"
echo -e "Any previous modification will be removed.\n"
echo -e "Please check you are an user with all rights.\n"

read -p "Do you want to do the database installation (y/n) ?" mysql_skip
echo -e "\n"
while [[ -z mysql_skip ]]
do
    read -p "Do you WANT to skip the database installation (y/n) ?" mysql_skip
    echo -e "\n"
done 

echo -e "We are going to setup the database for the web GUI.\n"
if [[ $mysql_skip == "y" ]]; then
    if [[ -z $(dpkg --get-selections | grep mysql-server) ]]; then
        echo -e "Missing MySQL server, installing it...\n"
        sudo apt-get install mysql-server
        echo -e "OK thanks.\n"
    fi

    read -p "Please enter your MySQL user: " mysql_username
    while [[ -z $mysql_username ]]
    do
        read -p "Please ENTER your MySQL user: " mysql_username
        echo -e "\n"
    done
    read -p "Please enter your MySQL password: " mysql_password

    while ! mysql -u "$mysql_username" -p"$mysql_password"  -e ";" ; do
       read -p "Can't connect, please enter the user name : " mysql_username
       read -p "Can't connect, please enter the password : " mysql_password
    done

    echo -e "\nCreating the database... "$mysql_database
    the_command=$(mysql -u "$mysql_user" -p$mysql_password -e "DROP DATABASE IF EXISTS deltaaer_openvirtua; CREATE DATABASE deltaaer_openvirtua;")
    echo -e "OK.\n"
    echo ${the_command} | grep "Access denied"

    if [[ ! $the_command ]] ;then
        echo -e "Importing the database...\n"
        the_command=$(mysql -u "$mysql_user" -p$mysql_password < "./Web/database.sql")
        echo -e "OK.\n"
    fi
fi

if [[ -z $($the_command | grep "No such") ]] ;then
    sudo apt-get install php7.0 php7.0-fpm php7.0-gd php7.0-mysql php7.0-ssh2 -y
    sudo apt-get install nginx -y
    sudo apt-get install ssh -y
    sudo cp "./Web/openvirtua-nginx.conf" "/etc/nginx/sites-available/"
    sudo ln -s "/etc/nginx/sites-available/openvirtua-nginx.conf" "/etc/nginx/sites-enabled/"
    sudo rm -rf "/var/www/openvirtua"
    sudo mkdir "/var/www/openvirtua"
    sudo cp -r ./Web/Website/* /var/www/openvirtua
    sudo iptables -A INPUT -p tcp --dport 8007 -j ACCEPT
    sudo service nginx restart
    echo -e "OK.\n"
fi