<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
         content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Pop it MVC</title>
    <link rel="stylesheet" href="public/style/style.css">
</head>
<body>
<header>
   <nav class="navigation">
       <a style="position: absolute;top: 30px;left: 200px;" href="<?= app()->route->getUrl('/hello') ?>">Главная</a>
       <?php
       if (!app()->auth::check()):
           ?>
           <a style="position: absolute;top: 30px;left: 1500px;" href="<?= app()->route->getUrl('/login') ?>">Вход</a>
           <a style="position: absolute;top: 30px;left: 1700px;" href="<?= app()->route->getUrl('/signup') ?>">Регистрация</a>
       <?php
       else:
           ?>
           <a style="position: absolute;top: 30px;left: 400px;" href="<?= app()->route->getUrl('/add') ?>">Добавление</a>
           <a style="position: absolute;top: 30px;left: 1700px;" href="<?= app()->route->getUrl('/logout') ?>">Выход (<?= app()->auth::user()->name ?>)</a>
       <?php
       endif;
       ?>
   </nav>
</header>
<main>
   <?= $content ?? '' ?>
</main>

</body>
</html>
