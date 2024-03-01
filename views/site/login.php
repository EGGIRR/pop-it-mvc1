<div class="login_form">

<h3><?= app()->auth->user()->name ?? ''; ?></h3>
<?php
if (!app()->auth::check()):
   ?>
   <form class="login_form_in" method="post">
       <fieldset>
           <h2>Авторизация</h2>
           <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
       <label>Логин <input type="text" name="login"></label>
       <label>Пароль <input type="password" name="password"></label>
       <button>Войти</button>
       </fieldset>
   </form>
</div>
<?php endif;
