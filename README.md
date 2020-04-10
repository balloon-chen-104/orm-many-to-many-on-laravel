# Resume Blog - ORM Demo

## One to Many and Many to Many Relationships

This project is an example about a Resume Blog, which is an implementation of one to many and many to many relationships. We use laravel's ORM to build it!

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
orm-many-to-many-on-laravel/laradoc$ docker-compose up -d nginx mysql redis
```

Well done! If you want to shut down the server, run the following command.

```
orm-many-to-many-on-laravel/laradoc$ docker-compose down
```

### Cashe

We use Redis cashe server to improve efficiency. In order to connect to it, you should adjust the environment settings of REDIS in .env file in the root folder. By default, it may work like this.

```
REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Database

In order to connect to database, you should adjust the environment settings of DB in .env file in the root folder. By default, it may work like this.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=default
DB_USERNAME=default
DB_PASSWORD=secret
```

We have provided four tables: users, resumes, tags and resume_tag. To migrate, you should run the following command.

```
orm-many-to-many-on-laravel$ php artisan migrate
```

You might want to have some fake datas. To have some, you could run the following command.

> Notice: If you run the code below, you will have an administrator account which has the highest authority. Here are the datas of the account:

> email: admin@resume.com
> password: admin

> If you don't run the following command. When you manually register the first account, it will be given the highest authority by default.

```
orm-many-to-many-on-laravel$ php artisan db:seed
```

You have done all the things before starting except one. Only adjust DB_HOST=127.0.0.1 to DB_HOST=mysql then you can connect the database in browser.

```
DB_HOST=mysql
```

## Usage

#### Here is our [home page](http://127.0.0.1).

#### We provide three authorities.

1. Administrator
    * Can read and update ALL users' datas (just R & U).
    * Can manipulate ALL resumes (CRUD).
    * Can manipulate ALL tags (CRUD).
2. General User
    * Can read and update THEIR OWN users' datas.
    * Can create resumes and read ALL resumes.
    * Can update and delete THEIR OWN resumes.
    * CANNOT manipulate with tags but CAN bind tags to resume when they create or update one.
3. Guest
    * Can read ALL resumes only.

#### The relationships we build.

1. One to Many
    * One user can have many resumes.
    * One resume can only belongs to one user.
2. Many to Many
    * One resume can belongs to many tags.
    * One tag can also belongs to many resumes.

## Author

* Balloon Chen