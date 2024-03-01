<div class="register_form">
    <form method="post">
        <fieldset>
            <h2>Регистрация нового пользователя</h2>
            <label>Имя <input type="text" name="name"></label>
            <label>Логин <input type="text" name="login"></label>
            <label>Пароль <input type="password" name="password"></label>
            <label>Ваша роль
                <select hidden="hidden" name="role">
                    <option value="employee">Сотрудник О.К.</option>
                </select>
            </label>
            <button>Зарегистрироваться</button>
        </fieldset>
    </form>
</div>
