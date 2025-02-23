# simple_crud_app
***Simple full-stack blog web-app using PHP, html, css, mySQL, composer.***

## Project-Tree
/simple_crud
├── app/                 # Application code
│   ├── Controllers/
│   ├── Models/
│   └── ...
├── public/             # Publicly accessible files
│   ├── index.php       # app entry point
│   ├── css/            # styles
│   ├── js/             # scripts
│   └── .htaccess      # Apache configuration for public directory
├── database/           # Database files
│   ├── migrations/
│   └── seeds/
├── vendor/             # Composer dependencies
├── .vscode/           # VS Code configuration
│   └── launch.json    # Debug configuration
├── .htaccess          # Main Apache configuration
├── .env               # Environment variables
├── .env.example       # Example environment file (template)
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

// some issues in the past .... I had to do this :
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

    Faili, OOP
[10:05] Jānis Strauts: Pieslēgšanās un Reģistrēšanās formas jums jau ir izveidotas. Tas
bija jau viens no iepriekšējiem uzdevumiem.
[10:06] Jānis Strauts: Jāpievieno funkcionalitāte, ka Reģistrācijas dati glabājās failā.
[10:06] Jānis Strauts: Attiecīgi pieslēdzoties mēs pārbaudam vai tāds lietotājs eksistē
[10:07] Jānis Strauts: failā
[10:07] Jānis Strauts: Izmantojam OOP pieeju
[10:07] Jānis Strauts: Varam veidot vienu klasi vai vairākas
[10:08] Jānis Strauts: Ja veidojam vienu, tad visticamāk jums būs metodes, kas attiecas
uz reģistrāciju un pieslēgšanos, kā arī kļūdu pārbaudēm paredzētas metodes.
[10:09] Jānis Strauts: Ļoti praktisks un vienkārš uzdevums
[10:10] Jānis Strauts: Vai ir kādi jautājumi?
[10:10] Jānis Strauts: Kļūdu paziņojumi jāizvada pie formām
[10:11] Jānis Strauts: Datu saglabāšanai varam izmantot csv failus
[10:12] Jānis Strauts: izmantojot piem. fputcsv() un fgetcsv()
[10:13] Janis: Tas OOP kases mes tassam kā admins/lietotājs ?
[10:14] Jānis Strauts: Šis uzdevums ļoti iespējams vēlāk būs vel jāpapildina un kādā brīdi
varu palūgt atrādīt.
[10:16] Jānis Strauts: To kā klases nosaucam paliek jūsu ziņā
[10:16] Jānis Strauts: Vēlams gan izmantot angļu nosaukumus
[10:18] Jānis Strauts: Kā jau rakstīju visu šo funkcionalitāti varam realizēt vienā klasē,
bet varam veidot arī vairākas. Piem. Register, Login, Validate.
16.12.2024
16.12.2024 (1) - Faili, OOP
[10:06] Jānis Strauts: Šodienas izaicinājums ir papildināt iepriekš izveidoto reģistrēšanās
mehānismu ar iespēju izveidot un dzēst tēmas.
[10:08] Jānis Strauts: Tātad pieslēdzoties jums jāizveido iespēju izveidot jaunu tēmu. Piem. "Kā
pagatavot lasi".
[10:09] Jānis Strauts: Savas tēmas ir jāspēj arī izdzēst, bet nevar izdzēst kāda cita izveidotu tēmu.
[10:09] Jānis Strauts: Visas tēmas var redzēt visi
[10:10] Jānis Strauts: arī tie kas nav pieslēgušies vai reģistrējušies
[10:11] Jānis Strauts: Informāciju glabājam teksta failā
[10:13] Jānis Strauts: Cenšamies protams izmantot OOP pieeju.
[10:13] Janis: tas sanák kautkáds foruma tips cik saprotu
[10:14] Jānis Strauts: Jā, tikai pagaidām bez komentāru pievienošanas
[10:17] Jānis Strauts: Veidojot lietotāju piešķiram tam kaut kādu unikālu identifikātoru, tā pat
daram arī ar tēmu izveidi.
[10:17] Jānis Strauts: failā saglabājam arī izveides datumu

18.12.2024 (3) / 19.12.2024 (4)
Iesākto projektu no 13.12.2024 un 16.12.2024 papildināt ar iespēju pievienot komentāru
izveidotajai tēmai. Komentāra autors komentāru var arī izdzēst. Failus organizējam, ka katrai
tēmai ir savs komentāru failiņš.
18.12.2024 / 19.12.2024
Jāpapildina ar iespēju datus glabāt un nolasīt no MySQL datubāzes izmantojot PDO.
Iepriekšējā funkcionalitāte ir jāsaglabā – jābūt parametram ar kuru būtu viegli pārslēgties no
saglabāšanas/nolasīšanas metodes (faili vai DB).
Visus parametrus glabājam ‘.env’ failiņā. (45 teorijas lekcija) .


// TODO ENV FILE :
    .env 
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
