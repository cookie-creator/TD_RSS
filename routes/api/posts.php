<?php

use App\Http\Controllers\Posts\PostsController;

Route::apiResource('posts', PostsController::class);

//Route::apiResources([
//    'projects'       => PostsController::class,
//]);

// php artisan make:controller PostsController --api --resource --requests

