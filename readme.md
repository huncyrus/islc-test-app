# ISLCollective test task
Test app for a company.

## REQUIREMENTS
 - LAMP STACK
    - PHP 5.6
        - PDO
    - MySQL 5/MariaDB
    - Apache2
        - modrewrite mod required
 - Browser (Chrome, Firefox...)
 - Other Dependencies
    - jQuery
    - Bootstrap 3.3.6
    

## Install
 - Copy all file to the target host
 - Import SQL into your MySQL/MariaDB database host
 - Change settings
    - Edit config.php file (backend/Core/config.php)
    - Edit .htacces file (backend/.htaccess) for baseurl setting (rewrite)
 
 
## Stucture
File sructure:

 - backend
    - Controllers
        - islCollectTestAppController.php ----------------------------- app controller logic
    - Core
        - config.php
    - Libs
        - databaseHelper.php ------------------------------- database handler layer via PDO
        - outputHelper.php --------------------------------- api output formater
        - routeHelper.php ---------------------------------- dummy fake router what handle $_GET 
    - Models
        - islCollectTestAppModel.php ---------------------------------- database related structure 
    - index.php ---------------------------------- api/backend main router app file
    - .htaccess ---------------------------------- apache modrewrite file
 - doc
    - iscollect-test-app.sql --------------------- database file
 - public
    - css
        - bootstrap.min.css ---------------------- boottrap defaiult css
        - islCollectTestAppMain.css ------------------------------- project related css file
    - images ------------------------------------- project related images
    - js
        - jquery.min.js -------------------------- jQuery librar
        - islCollectTestAppMain.js -------------------------------- main js
        - bootstrap.min.js ----------------------- bootstrap init js file
 - index.html ------------------------------------ boilerplate file
 - readme.md


### Tests
 - This project didn't covered by any unit test
 - This project tested only under LAMP stack, PHP 5.3 and Mysql 5. 
 - This project didn't tested on nginx or hhvm


### Sidenote
 - Optimalization
    - Keep in mind this is a small chunk test app
    - For better performance, should put the database into memory based storage (RDS for example)
    - For better performance should add a heap/temp/nosql/dedicated sql table for the query-s what filled up via some 
      media query (ZeroMQ or RabbitMQ) or via some task handler (cron, gulp)
 - Design, UI/UX
    - This project doesn't contain any special design or element, just bootstrap default theme
 - Used techs
    - Original requirements was:
        - Ajax, async, sort, auto filter via JS
            - Allowed libs:
                - Vanilla JS
                - jQuery JS
                - jQuery UI
        - Responsie design via Bootstrap (css + js)
            - Restricted to use any theme
        - SQL
        - Vanilla PHP
            - Restricted to use any famework (!)

### Credits
 - Györk "huncyrus" Bakonyi 2016 (c)
 - Licence: None
