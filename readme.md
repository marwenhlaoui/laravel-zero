# Laravel zero-project

start your code without any problem

### Clone and update from laravel

open your terminal/git bash here:
```git
git clone https://github.com/marwenhlaoui/laravel-zero.git project-name 
```
next open your project folder  
```git
cd project-name 
```
and update your laravel version with composer.json
```git
composer update 
``` 
finally run all related script
```git
composer run-script post-root-package-install 
composer run-script post-create-project-cmd 
composer run-script post-install-cmd 
composer run-script post-update-cmd 
``` 
### Start
add your application environment in `.env` file :
	+ 	[x] database name :fa-database
	+	[x] mailer system :fa-envelope


migrate your database
```git
php artisan migrate
``` 

### License

The Laravel framework is open-sourced software licensed under the MIT license.
	
Code By : [Marwen Hlaoui](https://marwenhlaoui.me)
