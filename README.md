# WebGIS Dinas PUPR Kabupaten Aceh Barat Daya

requirement:
- php 8.0 version
 
How to run this project :
1. put this project inside htdocs file, if you using xampp
2. run "composer install" inside this project
3. run "composer update" to update plugin
4. create new database "db_berkas" for default, or you can make new database, but you need to configure your .env file before migrate
5. run "php spark migrate" to migrate
6. run "php spark serve" to run the project
