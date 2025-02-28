# Simple mvc-pattern CRUD app template using PDO and mysql.


## Project-Tree
/simple_crud
├── app/                 # Application code
│   ├── Controllers/
│   ├── Models/
│   └── Views
├── public/             # Publicly accessible files
│   ├── index.php       # app entry point
│   ├── css/            # styles
│   │   ├── style.css        # Main styles
│   │   └── normalize.css    # CSS reset
│   ├── js/             # scripts
│   │   └── main.js         # JavaScript functionality
│   └── .htaccess      # Apache configuration for public directory
├── database/           # Database files
│   ├── migrations/
│   └── seeds/
├── vendor/             # Composer dependencies
├── .vscode/           # VS Code configuration
│   └── launch.json    # Debug configuration
├── .htaccess          # Main Apache configuration
├── .env.dev               # Development environment variables
├── .gitignore
├── composer.json
└── README.md



# prepare local web server and xdebug

Check if php installed php -v

if not then
`brew install php`

Test php 
`php -S localhost:8080`

then install debugger:
`pecl install xdebug`

then install vs code extensions - "php debug" by xdebug and Php by DevSense


php.ini file content (globally installed php php.ini file ...)
[Xdebug]
zend_extension="xdebug.so"
xdebug.mode=debug
xdebug.start_with_request=yes
xdebug.client_host=127.0.0.1  # Or your local IP address if not on localhost
xdebug.client_port=9003
xdebug.idekey=VSCODE

// PORT conf INFO :
xdebug is spinning on localhost:9003 using Xdebug extension in VS Code.
web server for php is running on localhost:80 using XAMPP + Apache
MySQL is running on localhost:3306 using XAMPP + MySQL
Database management tool: localhost:80/phpMyAdmin


## // Restful API (REST API uses RESTful URLs) - recommended practice

// GET      /api/products       - get all products
// GET      /api/products/1223  - get product (id: 1223)
// POST     /api/products       - create product
// DELETE   /api/products/1223   - delete product (id: 1223)
// PUT      /api/products/1223   - update product with new product (id: 1223)
// PATCH    /api/products/1223   - update product details (id: 1223)


.htaccess
// URL rewrite
// RewriteEngine On                         - Enables the Apache mod_rewrite engine
// RewriteCond %{REQUEST_FILENAME} !-f      - for file
// RewriteCond %{REQUEST_FILENAME} !-d      - for directory
// RewriteCond %{REQUEST_FILENAME} !-l      - for symbolic link (shortcut)
// RewriteRule . index.php [L]              - Redirects all other requests to index.php

// URL rewrite (mini)
// RewriteEngine On
// RewriteRule . index.php                  - Redirects all other requests to index.php


## start local web server on port:8080
// start php built in server
// php -S localhost:8080


// TODO : Have to go through this blob below :
# App requirements :
Iepriekšējais uzdevums, kuru apraksts atrodas šajās lekcijās:
**13.12.2024**

 
// TODO ENV variables :
    .env.dev 
APP_DEBUG=true
BASE_URL=http://localhost/my-project/public

DB_DRIVER=mysql
DB_HOST=your-db-host
DB_PORT=3306
DB_NAME=your-db-name
DB_USER=your-db-user
DB_PASS=your-db-password

STORAGE_USE_JSON=true
JSON_FILE_PATH=storage/posts.json

.env`
### APP_ENV=development
***API_BASE_URL=http://localhost/api***

`.env.production` 
## APP_ENV=production
***API_BASE_URL=https://api.example.com***


1 ) `composer require vlucas/phpdotenv
`

**index.php** *( as app entry point )*
```php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);

// Check the current environment and load the appropriate file
$env = getenv('APP_ENV') ?: 'development'; // Default to 'development' if not set

if ($env === 'production') {
    $dotenv->overload('.env.production');
} else {
    $dotenv->load();  // Default to loading .env for development
}

// Now you can access the environment variables
$baseUri = getenv('API_BASE_URL');

echo $baseUri;
```
