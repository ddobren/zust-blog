<?php

// ---------------------------
//  Base Path
// ---------------------------
define('BASE_PATH', realpath(__DIR__));

// ---------------------------
//  Konfiguracije
// ---------------------------
require_once __DIR__ . '/config/Config.php';

// ---------------------------
//  Migracije (automatski pokreni nove ako postoje)
// ---------------------------
require_once __DIR__ . '/database/MigrationRunner.php';
if (isset($_GET['debug'])) {
    runMigrations();
}

// ---------------------------
//  Init funkcije
// ---------------------------
require_once __DIR__ . '/app/Core/Error.php';
require_once __DIR__ . '/app/Core/Session.php';

// ---------------------------
//  View logic
// ---------------------------
require_once __DIR__ . '/app/Core/View.php';

// ---------------------------
//  Controllers
// ---------------------------
require_once __DIR__ . '/app/Controllers/authController.php';
require_once __DIR__ . '/app/Controllers/categoriesController.php';
# require_once __DIR__ . '/app/Controllers/uploadController.php';
require_once __DIR__ . '/app/Controllers/postsController.php';

// ---------------------------
//  Router Logika
// ---------------------------
require_once __DIR__ . '/Router/RouteRegistrar.php';
require_once __DIR__ . '/Router/Router.php';
require_once __DIR__ . '/Router/Route.php';

// ---------------------------
//  Rute
// ---------------------------
require_once __DIR__ . '/app/Routes/web.php';
require_once __DIR__ . '/app/Routes/api.php';

// ---------------------------
//  Pokreni Router
// ---------------------------
use Routing\Router;

$router = new Router();
$router->start();
