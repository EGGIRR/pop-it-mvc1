<div class="register_form">
    <form method="post">
        <fieldset>
            <pre><?= $message ?? ''; ?></pre>
            <h2>Регистрация нового пользователя</h2>
            <input name="csrf_token" type="hidden" value="<?= app()->auth::generateCSRF() ?>"/>
            <label>Имя <input type="text" name="name"></label>
            <label>Логин <input type="text" name="login"></label>
            <label>Пароль <input type="password" name="password"></label>
            <label>
                <select hidden="hidden" name="role_id">
                    <option value="1">Сотрудник О.К.</option>
                </select>
            </label>
            <button>Зарегистрироваться</button>
        </fieldset>
    </form>
</div>
