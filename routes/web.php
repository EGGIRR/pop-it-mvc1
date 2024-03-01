<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup'])
    ->middleware('auth');;
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login'])
    ->middleware('auth');;
Route::add('GET', '/logout', [Controller\Site::class, 'logout'])
    ->middleware('auth');;
Route::add(['GET', 'POST'], '/add_employee', [Controller\Site::class, 'add_employee'])
    ->middleware('auth');;
Route::add(['GET', 'POST'], '/add_department', [Controller\Site::class, 'add_department'])
    ->middleware('auth');;
Route::add(['GET', 'POST'], '/add_post', [Controller\Site::class, 'add_post'])
    ->middleware('auth');;
Route::add(['GET', 'POST'], '/add_structure', [Controller\Site::class, 'add_structure'])
    ->middleware('auth');;
Route::add(['GET'], '/add', [Controller\Site::class, 'add'])
    ->middleware('auth');;
Route::add(['GET'], '/employee_show', [Controller\Site::class, 'employee_show'])
    ->middleware('auth','admin');
