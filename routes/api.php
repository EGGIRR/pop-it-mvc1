<?php

use Src\Route;

Route::add('GET', '/department', [Controller\Api::class, 'department']);
Route::add('GET', '/employee', [Controller\Api::class, 'employee']);
Route::add('POST', '/echo', [Controller\Api::class, 'echo']);
Route::add('POST', '/login', [Controller\Api::class, 'login']);
Route::add('POST', '/apiAddDepartment', [Controller\Api::class, 'addDepartment']);
//    ->middleware('TokenCheckMiddleware');
Route::add('POST', '/apiAddStructure', [Controller\Api::class, 'addStructure']);
//    ->middleware('TokenCheckMiddleware');
Route::add('GET', '/logout', [Controller\Api::class, 'logout']);