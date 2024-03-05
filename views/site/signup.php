<div class="register_form">
    <form method="post">
        <fieldset>
            <h3><?= $message ?? ''; ?></h3>
            <h2>Регистрация нового пользователя</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Имя <input type="text" name="name"></label>
            <label>Логин <input type="text" name="login"></label>
            <label>Пароль <input type="password" name="password"></label>
            <select hidden="hidden" name="role_id">
                <option value="2"
                </option>
            </select>
            <button>Зарегистрироваться</button>
        </fieldset>
    </form>
</div>
