# Laravel zero-project

start your code without any problem

### Clone and update from laravel

Open your terminal/git bash here:
```git
git clone https://github.com/marwenhlaoui/laravel-zero.git project-name 
```
Next open your project folder  
```git
cd project-name 
```
And update your laravel version with composer.json
```git
composer update 
``` 
Finally run all related script
```git
composer run-script post-root-package-install 
composer run-script post-create-project-cmd 
composer run-script post-install-cmd 
composer run-script post-update-cmd 
``` 
### License

The Laravel framework is open-sourced software licensed under the MIT license.
	
This code By : [Marwen Hlaoui](https://marwenhlaoui.me)