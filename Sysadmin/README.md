# First !

Please replace `xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx` by the API key you have in `/Web/Website/Web/config.json`.

# Installation VM

Ce readme explique comment les VM sont installés et le fonctionnement du script de demarrage


# PXE - FOG

les VM sont créer depuis une image PXE, cette image contient une clé SSH pour acceder a n'importe quelle machine, depuis le serveur ce serveur PXE. Cette image contient egalement un **install.sh**. Ce script installe toutes les dependances necessaire, met a jour la machine, et prepare sa mise en production.

# Install.sh

Ce fichier Install execute plusieurs fonction, au regard du système d'exploitation et de la preseed qui est lancé.

## init

La fonction *init* change le prompt afin d'avoir quelque chose de plus agréable et plus lisible. Elle met a jour le nom d'hôte de la machine en fonction des 4 derniers chiffres de l'adresse MAC, met a jour les dépots et les paquets disponible. Cette fonction installe egalement les paquets necessaire a la configuration de la machine tel que **linuxlogo curl pwgen sudo vim rsync wget fail2ban** et change le *motd* en fonction de son système d'exploitation.

## creation_client

Cette fonction récupère le nom du client sur l'API, si elle a réussis, elle génère un mot de passe de 13 caractère et créer un utilisateur avec le nom du client, et change son prompt pour qu'il soit le même que celui du **root**.

## root_pass

Cette fonction génère un mot de passe de 20 caractère grâce a **pwgen** et met a jour le mot de passe root avec ce mot de passe généré.

## networking

La fonction *networking* met l'adresse de la machine en tant qu'adresse statique. Elle configure le fichier **/etc/network/interfaces**

## config_ssh

La configuration du serveur ssh est faite grâce a cette fonction, elle écrase le contenu du fichier **/etc/ssh/sshd_config** par des paramètres simple & suffisant a interdir l'accès root, changer le port ssh par le port **4242**

## config_f2b
Cette fonction configure Fail2Ban en ajoutant a la fin du fichier **/etc/fail2ban/jail.conf** les configurations nécessaires a Fail2Ban pour prendre en compte notre service ssh.

# Envois des données
Les données sont envoyé a l'API avec curl, on envois les données. On vide le cron, on supprime le script, et on redemarre la machine. Les infos sont envoyés a l'administrateur par email depuis l'API pour une meilleure gestion SMTP.