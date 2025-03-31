<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RolController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/prin', function () {
    return view('components/principal');
});
// Route::get('/roles', function () {
//     return view('roles/roles');
// });

route::get('/roles', [RolController::class, 'index']);
