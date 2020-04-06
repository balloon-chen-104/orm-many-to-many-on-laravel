# ORM - Many to Many
## Example: the relationship between resumes and tags

This project is an example about using laravel's ORM to build the relationship between resumes and tags.

## Getting Started



### Prerequisites

This project is build in PHP with laravel framework and run on laradock. To install the project, you need to install PHP, [composer](https://getcomposer.org) and [docker](https://www.docker.com) first.

### Installing

After you clone the project, you need to enter the root folder and install all packages by composer.

```
orm-many-to-many-on-laravel$ composer install
```

Next, copy the .env.example in laravel. Then, generate a key for laravel. By default, we put .env file into .gitignore, so you can put your own environment settings here without leaking your private settings.

```
orm-many-to-many-on-laravel$ cp .env.example .env
orm-many-to-many-on-laravel$ php artisan key:generate
```

Like what you did in laravel, copy the env-example in laradoc. Your laradoc will use the settings in .env file. By default, we put .env file into .gitignore, so you can put your own environment settings here without leaking your private settings.

```
orm-many-to-many-on-laravel$ cd laradock
orm-many-to-many-on-laravel/laradoc$ cp env-example .env
```

To run the server on localhost, you need to open the docker application and run the command below.

```
orm-many-to-many-on-laravel/laradoc$ docker-compose up -d nginx mysql redis workspace
```

Well done! You can now see the default laravel website on 127.0.0.1

If you want to shut down the server, run the following command.

```
orm-many-to-many-on-laravel/laradoc$ docker-compose down
```

### Database

In order to use database, you should adjust the environment settings of DB in .env file. By default, it may work like this.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

We have provided three database: resumes, tags and resume_tags. To migrate, you should run the following command.

```
orm-many-to-many-on-laravel$ php artisan migrate
```

You might want to have some fake datas. To have some, you could run the following command.

```
orm-many-to-many-on-laravel$ php artisan db:seed
```

You have done all the things before starting except one. Only adjust DB_HOST=127.0.0.1 to DB_HOST=mysql then you can connect the database in browser.

```
DB_HOST=mysql
```

## Usage

We have two main entry points. You can do some experiments on them to see the relationship between them.

* http://127.0.0.1/resumes
Which you can see all the resumes.
* http://127.0.0.1/tags
Which you can see all the tags.

## Author

* Balloon Chen