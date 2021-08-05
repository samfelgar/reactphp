<?php

use Samfelgar\Reactphp\Controller\HomeController;
use Samfelgar\Reactphp\Routing\Route;

/**
 * The application's routes
 */

Route::get('/', [HomeController::class, 'index']);

return Route::routes();
