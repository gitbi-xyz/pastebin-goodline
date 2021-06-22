<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Getting started

### Prerequisites

1. You have [Git](https://git-scm.com) installed
2. You have [VirtualBox](https://www.virtualbox.org) and [Vagrant](https://www.vagrantup.com) installed
3. You have [Homestead Vagrant box](https://app.vagrantup.com/laravel/boxes/homestead) installed

### Installation

Before start please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/8.x/installation) [Homestead Documentation](https://laravel.com/docs/8.x/homestead#introduction)

Clone the repository

    git clone git@github.com:ai2cru/pastebin-goodline.git

Switch to the repo folder

    cd pastebin-goodline

Install all the dependencies using composer

    composer install

Make the required configuration changes in the .env file

Generate a new application key

    php artisan key:generate

Add an entry to the Windows `hosts` file

    192.168.10.10 pastebin-goodline.test

Run `Homestead` 

    vagrant up

Run the database migrations

    php artisan migrate

Now you can access the server at http://pastebin-goodline.test/
