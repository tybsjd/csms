# RESTful API with PHP

For RESTful API,This guide will help you run this application on your local machine or follow the steps bellow and use the code in this repository.

## Start from here

  - This project is developed on localhost, using PHP version 8.2. 
  - For localhost paste entire folder to XAMPP/htdocs/ or where you localhost/127.0.0.1 is pointing, otherwise copy files of "csms" to your domain. Remember to change line 20 in "index.php", if there is any change of directory path.
  - Open Postman, [postman](https://www.postman.com/downloads)  (if not installed). 
  - Select POST endpoint, enter api url as http://localhost/csms/rate and Body type will be raw and paste input JSON object. 
  - Send request will show JSON output with 200 OK status.
  - Make sure .htaccess file has Rules.
  ```sh
      RewriteEngine On
      RewriteRule . index.php
  ```
<img width="711" alt="Screenshot 2023-07-05 at 2 16 53 AM" src="https://github.com/tybsjd/csms/assets/19371471/541c31d5-6c5c-4420-8cc6-1ceedfe5310d">

## PHPUnit Test

  - phpUnit 10.2 requires >8 version of PHP, update composer to configure phpUnit.

  - For Test case, navigate to csms folder and run command in terminal 
  ```sh
  ./vendor/bin/phpunit
  ```
  - For Test case, run command on Windows
  ```sh
  php ./vendor/bin/phpunit
  ```
<img width="565" alt="Screenshot 2023-07-05 at 2 22 15 AM" src="https://github.com/tybsjd/csms/assets/19371471/f54bd0f0-af6f-4aa4-8441-5068142715b7">

# Challenge #2

- We can connect this project to DATABASE to add models/entities to this project. This project is expandable, we can add more controllers  and write services.
- We can write a Base controller and implement it for other controllers.
- We can make versions of API, with the evolution of the technology.
- We can expand exceptions.
- We can add authentication to access api.
- We can add more endpoints like GET, PUT etc.
- We can add a config file to save constant values like rate values in this project.
- We can try, catch the code.
Any suggestion or feedback would be helpful.



  
