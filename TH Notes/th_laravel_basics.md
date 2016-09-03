# LARAVEL 4 BASICS

## Getting Started with Laravel

#### Installing VirtualBox, Homestead & Vagrant

1. Download VirtualBox for your OS from their website
2. Download Vagrant for your OS from their website
3. Use a command to install install Homestead

`vagrant box add laravel/homestead`

In a shell, check that you have SSH.

```
cd ~
ls -la
# check for .ssh
```

If not, you can generate a key.

In terminal:

```
ssh-keygen -t rsa -C "youremail@email.com".
```

There is also a great guide on GitHub.

https://help.github.com/articles/generating-an-ssh-key/

** Init the Homestead.yaml file **

```bash init.sh```

In ~/Homestead, alter the Homestead.yaml file.

1. Replace "me" with the User
2. Under "folders" where it has the map and to, change the to direction to have .../Sites if you don't want the default and to follow along with TH.

Sites we can change to anything. Eg. laravel.dev

Ensure sites is okay too and that the Sites/<here>/<here> is laravel-basics/public

Run the Vagrant Up command in terminal `vagrant up`

If there is a host issue, change the Homestead.yaml host.

** Getting into the box **

Connect via SSH

run `vagrant ssh`

#### Install Laravel

Ensure composer is installed on your external SSH OS.

Run `composer global require "laravel/installer"`

** Composer Create-Project **

```
composer create-project --prefer-dist laravel/laravel laravel-basics
```

Alternatively...

```
laravel new laravel-basics
```

**Note** laravel-basics can be swapped for anything.

Run pwd and check this against what you have in ~/.homestead/Homestead.yaml

Then jump to the site (127.0.0.1:8000) to see if it is running successfully.

To get rid of the 127.0.0.1, we can change it to another host.

cd /etc from the Homestead file and adjust the hosts file in a text editor to make the website easier to navigate to.

#### Laravel Folder Structure



***

## Project Setup

***

## Laravel Controllers

***

## Laravel and Databases

***

## Blade and Forms

***

## Validation & Flash Messages

***

## Continuing CRUD

***

## Relating Data
