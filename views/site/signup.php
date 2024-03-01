<div class="register_form">
<form method="post">
    <fieldset>
        <pre><?= $message ?? ''; ?></pre>
    <h2>Регистрация нового пользователя</h2>
        <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
        <label>Имя <input type="text" name="name"></label>
   <label>Логин <input type="text" name="login"></label>
   <label>Пароль <input type="password" name="password"></label>
    <label>Ваша роль
        <select name="role_id">
            <?php foreach($roles as $role)
            {
                ?>
                <option value="<?php echo $role->id; ?>"><?php echo $role->name; ?></option>
            <?php } ?>
        </select>
    </label>
   <button>Зарегистрироваться</button>
    </fieldset>
</form>
</div>
