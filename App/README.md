# Getting started - Front install

Installation instructions :

## Edit 'auth-service.ts'

Open the app folder and find **auth-service.ts** under **src/providers/auth-service**
This file contain all the **API LINKS**.
Edit those link with your **API URLS**.

## Install 'node-module'

Open the command line and write : **npm install**

## Build the Open Virtua app

Open the command line, navigate to your app folder, and write :

Input    Description
- **platform**    The platform to build (android, ios)

Option    Description
- **--no-build**    Do not invoke an Ionic build
- **--prod**    Build the application for production
- **--aot**    Perform ahead-of-time compilation for this build
- **--minifyjs**    Minify JS for this build
- **--minifycss**    Minify CSS for this build
- **--optimizejs**    Perform JS optimizations for this build
- **--debug**    Create a Cordova debug build
- **--release**    Create a Cordova release build
- **--device**    Create a Cordova build for a device
- **--emulator**    Create a Cordova build for an emulator
- **--buildConfig**    Use the specified Cordova build configuration

for more information go on **https://ionicframework.com/docs/cli/cordova/build/**