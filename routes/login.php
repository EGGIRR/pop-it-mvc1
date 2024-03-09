<?php

use Src\Route;

Route::add('POST', '/apilogin/login', [Controller\Login::class, 'login']);

