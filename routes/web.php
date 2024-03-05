<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add(['GET', 'POST'], '/add_employee', [Controller\Authorised::class, 'addEmployee']);
Route::add(['GET', 'POST'], '/add_department', [Controller\Authorised::class, 'addDepartment']);
Route::add(['GET', 'POST'], '/add_post', [Controller\Authorised::class, 'addPost']);
Route::add(['GET', 'POST'], '/add_structure', [Controller\Authorised::class, 'addStructure']);
Route::add(['GET'], '/add', [Controller\Site::class, 'add']);
Route::add(['GET'], '/show', [Controller\Site::class, 'show']);
Route::add(['GET','POST'], '/employee_show', [Controller\Authorised::class, 'employeeShow']);
Route::add(['GET','POST'], '/search_employee', [Controller\Authorised::class, 'searchEmployee']);
Route::add(['GET','POST'], '/employee_structure', [Controller\Authorised::class, 'employeeStructure']);
Route::add(['GET','POST'], '/admin_add_employee', [Controller\Admin::class, 'adminAddEmployee'])
    ->middleware('auth','admin');
