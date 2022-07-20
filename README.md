# PHP test

## 1. Installation

  - create an empty database named "phptest" on your MySQL server
  - import the dbdump.sql in the "phptest" database
  - put your MySQL server credentials in the config file
  - you can test the demo script in your shell: "php index.php"

## 2. Folder Structure

### 1. Class

  - In class folder there are three class created.
  - Comment class used for create object of comment.
  - News class used for create object of News.
  - FormatData class used for format fetch database data.

### 2. Database

  - DBBuilder class used for fetch pdo data from database.
  - DBconnection class user for create database connecttion.

### 3. utils

  - This folder used for write logic
  - CommentManeger class contains all logic and method related to comment table. It contains fetch, insert and delete method.
  - NewsManeger class contains all logic and method related to news table. It contains fetch, insert and delete method.
  - Query Class used for create database query

### 4. config file 

  - Config file used for store all variable

### 5. message file 

  - All static message stored in message file. It include in index file.

### Notes 
  
  - I changed comment table schema. Create news_id FOREIGN KEY for CASCADE delete 
