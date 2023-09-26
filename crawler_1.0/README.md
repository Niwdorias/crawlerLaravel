Backend for Web Crawler

Introduction

Welcome to the documentation for the Backend of our Web Crawler! This backend service is designed to work seamlessly with a front-end application that sends POST requests. Its primary function is to scrape a given URL for all nested URLs, with a configurable depth level ranging from 0 to 3. Once the scraping process is successful, it stores the results in a database for further analysis or utilization.

Features
Web Scraping: This backend can efficiently scrape web pages, extracting nested URLs within the specified depth range.

Customizable Depth: The depth configuration allows you to control how many levels deep the web crawler should search for nested URLs, making it adaptable for various use cases.

Database Integration: The scraped data is stored in a database, providing a structured and easily accessible repository for the collected URLs.

Getting Started
To set up and run the Web Crawler Backend, follow these steps:

Requerments and Dependencies:
-PHP8.0
-Laravel9
-mongoDB any

Laravel external packages used:

drnxloc/laravel-simple-html-dom:https://github.com/drnxloc/laravel-simple-html-dom
GuzzleHttp/Client 



Setting Up and Running the Backend with Laravel and MongoDB

Welcome to our comprehensive guide on setting up and running a Crawler backend using Laravel, a popular PHP framework, and MongoDB, a powerful NoSQL database. In this tutorial, we will walk you through the installation of MongoDB, the configuration of a Laravel project, and the steps to start the Laravel server.

Prerequisites
Before we dive into the setup, ensure that you have the following prerequisites installed on your system:

PHP: Install PHP 8.0 on your system. You can download it from the official PHP website.

Composer: Composer is a PHP dependency manager. You can download and install it from the official website here.

MongoDB: Install MongoDB on your system. Visit the official MongoDB website to download and follow the installation instructions.

Laravel9: Install Laravel by down loading this project from repositary.

Now that you've ensured your system meets these prerequisites, let's proceed with setting up your Laravel-MongoDB backend.

Step 1: Install and Configure MongoDB
Install MongoDB: Follow the installation instructions provided for your specific operating system on the official MongoDB website.

Start MongoDB Server:

On Linux, you can start MongoDB with the following command:

sudo service mongod start

On Windows, start MongoDB using the MongoDB Compass application or the command-line tool.

Verify MongoDB:
To ensure MongoDB is up and running, open a terminal or command prompt and run:

mongo

This command should open the MongoDB shell.

Create a Database:
In the MongoDB shell, create a new database for your Crawler project. you need to name the database "crawler":

Step 1: Configure Laravel for MongoDB

Install the Laravel MongoDB Package requierments:

https://www.php.net/manual/en/install.pecl.windows.php
https://pecl.php.net/package/mongodb/1.13.0/windows

basicly search for Laravel + mongodb instalation and follow instructions.
https://www.mongodb.com/compatibility/mongodb-laravel-intergration 


Step 2: Start the Laravel Server

Migrate MongoDB Collections(instal Schemas):

cmd/terminal >>> php artisan migrate

Start the Laravel Development Server:

cmd/terminal >>> php artisan serve

Your Laravel development server will start at http://localhost:8000. Open your web browser and access your Laravel application.

Congratulations! You've successfully set up and configured a backend Laravel project with MongoDB as database. You're now ready to build your Laravel application with the power of MongoDB behind it. Happy coding!

for more info or trouble shooting contact me!