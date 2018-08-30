# Slim Framework 3 Skeleton Application

## Installing the framework and inital test.
This article is not about DevOps so I’m not going to go into any environment setup. I’m going to assume at this point that you have an environment to develope in that is running some version of PHP >= 5.5 and are using Composer to manage your project dependancies. If not then I suggest checking out PHP The Right Way for an overview of modern PHP development techniques. It has a great section at the beginning about setting up development environments on both Mac and Windows.

Now, lets create our project using the slim skeleton, then update to the latest versions of everything. I have Composer installed globally so I can just call **``` $ composer ```** from anywhere. If you do not, and you install things on a per project basis, you will need to call the phar file **``` $ php composer.phar ```**

Open a terminal, change to the directory where you keep your sourcecode and install the skeleton frame work with these commands.

```shell
$ composer create-project slim/slim-skeleton slim-oo
$ cd slim-oo
$ composer update
```

Lets use the command line to move some things around and set up a more maintainable directory structure. From the project root run each of the following commands.

```shell
$ mkdir configuration
$ mkdir configuration/environments
$ touch configuration/environments/environment.env.example
$ mkdir -p configuration/middleware
$ mkdir -p configuration/routes
$ mkdir -p configuration/services
$ mv src/settings.php configuration/settings.php
$ mv src/middleware.php configuration/middleware/middleware.php
$ mv src/routes.php configuration/routes/routes.php
$ mv src/dependencies.php configuration/services/services.php
$ mkdir src/App
$ touch src/bootstrap.php
$ mkdir migrations
$ touch migrations/001.sql
```


You should now have a structure like this. The files that you touched are empty placeholders for now. We will fill those later when we do some refactoring.


```shell

├──project
|    └─configuration
|    |   └─environments
|    |   |   -environment.env.example
|    |   └─middleware
|    |   |   -middleware.php
|    |   └─routes
|    |   |   -routes.php
|    |   └─services
|    |   |   -services.php
|    |   -settings.php
|    └─logs
|    └─migrations
|    |   -001.sql
|    └─public
|    └─src
|    |   └─App
|    |       -Application.php
|    |   bootstrap.php
|    └─templates
|    └─vendors
|    .gitignore

```

Now lets fix the index.php file so it works again. Change your requires in index.php to reflect the new paths, it should look like this.


```php

<?php
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $file = __DIR__ . $_SERVER['REQUEST_URI'];
    if (is_file($file)) {
        return false;
    }
}
 
require __DIR__ . '/../vendor/autoload.php';
 
session_start();
 
// Instantiate the app
$settings = require __DIR__ . '/../configuration/settings.php';
$app = new \Slim\App($settings);
 
// Set up dependencies
require __DIR__ . '/../configuration/services/services.php';
 
// Register middleware
require __DIR__ . '/../configuration/middleware/middleware.php';
 
// Register routes
require __DIR__ . '/../configuration/routes/routes.php';
 
// Run app
$app->run();
 
 ```

The Slim welcome page should now show again in your browser.

### Refactor time. 
Now lets make this project feel more object oriented and move all of the setup into an application object.

First lets wrap our autoloader so we can add manual configurations to the generated autoloader that Composer gives us. Open the recently created src/bootstrap.php and add the following.

>#### src/bootstrap.php

 ```php

 <?php
 // Set the project's base
 if (!defined('APP_ROOT')) {
    $spl = new SplFileInfo(__DIR__ . '/..');
    define('APP_ROOT', $spl->getRealPath());
 }

 $loader = require_once 
 APP_ROOT.'/vendor/autoload.php';
  
 $settings = require 
 APP_ROOT.'/configuration/settings.php';
  
 return new App\Application($settings);
 
 ```


The first thing we do is create an APP_ROOT constant that we can access anywhere to find the root of our application. We then pull in the autoloader that Composer has generated for us. This will let us pull in all of the classes in the vendor directory using PHP’s use statement. No longer will we need to use require to find a class, just call the Fully Qualified Namespace. This is what we do in the last line, returning an instance of our application.



Now remove the lines in your __index.php__ that assign  $settings and $app   and replace them with the   $app  returned to us from  bootstrap.php . We can also remove the require for **vendor/autoloader.php**

>#### public/index.php

```php
 <?php
 session_start();
 
 // Instantiate the app
 $app = require __DIR__ . '/../src/bootstrap.php';
 
 // Set up dependencies
 require __DIR__ . '/../configuration/services/services.php';
 
 ```