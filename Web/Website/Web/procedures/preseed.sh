#!/bin/bash

function init {
  MAC=`ip a | grep link/ether | sed -e 's/([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})//g' | cut -d " " -f6 | sed -e 's/[^0-9]//g'`
  MAC=`echo "${MAC: -4}"`
  echo "PS1='\[\033[38;5;11m\]\u\[$(tput sgr0)\]\[\033[38;5;15m\]@\h:\[$(tput sgr0)\]\[\033[38;5;6m\][\w]:\[$(tput sgr0)\]\[\033[38;5;15m\] \[$(tput sgr0)\]'" >> /root/.bashrc && echo "vps-$MAC" > /etc/hostname && apt-get update && apt-get upgrade -y && apt-get install -y linuxlogo curl pwgen sudo vim rsync wget fail2ban && linuxlogo > /etc/motd

}
function creation_client {

        request=`curl --silent -XGET -H 'x-ov-api-key: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' -H "Content-type: application/json" 'https://flavien.berwick.fr/projects/etna/open-virtua/api/random_name'`
        error=`echo $request | cut -d "\"" -f3`
        if [[ $error == ":false," ]]
                then
                NOM_CLIENT=`echo $request | cut -d "\"" -f6`
                PASSWORD=`pwgen 13 1`
                useradd -p "$PASSWORD" -d /home/"$NOM_CLIENT" -m -g users -s /bin/bash "$NOM_CLIENT" 
                echo "$NOM_CLIENT ALL=(ALL:ALL) ALL" >> /etc/sudoers 
                echo "PS1='\[\033[38;5;11m\]\u\[$(tput sgr0)\]\[\033[38;5;15m\]@\h:\[$(tput sgr0)\]\[\033[38;5;6m\][\w]:\[$(tput sgr0)\]\[\033[38;5;15m\] \[$(tput sgr0)\]'" >> /home/$NOM_CLIENT/.bashrc
        fi
        echo $PASSWORD
}
function root_pass {
  PASSWORD=`pwgen 20 1`
  echo "root:$PASSWORD" | chpasswd
  echo "$PASSWORD"
}

function networking {
  IP=`hostname -I`
  echo -e "#Generé par le script d'installation
source /etc/network/interfaces.d/*
auto lo
iface lo inet loopback
allow-hotplug ens36
iface ens36 inet static
  address $IP
  gateway 10.0.0.1
  netmask 255.255.255.0
" > /etc/network/interfaces
      echo $IP

}
function config_ssh {
  echo -e "Port 2242
  PermitRootLogin prohibit-password" >> /etc/ssh/sshd_config
  echo "4442"
}

function config_f2b {
  echo -e "[ssh]
enabled = true
port    = ssh
filter  = sshd
logpath  = /var/log/auth.log
maxretry = 6
[ssh-ddos]
enabled = true
port    = ssh
filter  = sshd-ddos
logpath  = /var/log/auth.log
maxretry = 6" >> /etc/fail2ban/jail.conf
}
init
USER_PASS=$(creation_client)
ROOT_PASS=$(root_pass)
IP=$(networking)
PORT_SSH=$(config_ssh)
config_f2b


echo $USER_PASS 
echo $ROOT_PASS
echo $IP
echo $PORT_SSH
curl --request POST \
  --url https://flavien.berwick.fr/projects/etna/open-virtua/api/bootup/iamalive \
  --header 'x-ov-api-key: xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' \
  --form "password_user"="$USER_PASS" \
  --form "password_root"="$ROOT_PASS" \
  --form "ip"="$IP" \
  --form "ssh_port"="$PORT_SSH" && touch cron  && crontab cron && rm cron && rm $0 && reboot
