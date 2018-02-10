<p align="center">
    <img src="https://speeload.com/uploads/ae1h6SUhhG.png" width="200">
<p>

# What is it ?
This directory contains the API written in PHP to monitor the server of the administrator via Proxmox.
It is used by the front-end interfaces.

The API listens to port **8007**.

# How to configure your server to run the API ?
Go to _Web/config.json_ to change your config :

- **(Mandatory)** Enter your database credentials.
- _(Recommanded)_ Modify the master API key and the hash salt.
- _(Optional)_ Change security settings.

Made with [DirectFramework](https://github.com/flavienbwk/directframework), version : __beta-0.6__
